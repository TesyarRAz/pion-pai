<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\cat_kesalahan;
use App\Models\GuruMapel;
use App\Models\inf_guru;
use App\Models\inf_tugas;
use App\Models\Izin;
use App\Models\Mapel;
use App\Models\user;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function member()
    {
        if (request()->has('reset'))
        {
            if (request()->reset == 'sekertaris')
            {
                $users = user::where('role', 'sekertaris')->get();
            }
    
            if (request()->reset == 'siswa')
            {
                $users = user::where('role', 'siswa')->get();
            }
    
            absensi::whereIn('user_id', $users->pluck('id'))->delete();
            cat_kesalahan::whereIn('user_id', $users->pluck('id'))->delete();
            inf_guru::whereIn('user_id', $users->pluck('id'))->delete();
            inf_tugas::whereIn('user_id', $users->pluck('id'))->delete();
            Izin::whereIn('user_id', $users->pluck('id'))->delete();

            user::destroy($users->pluck('id'));

            return redirect()->route('admin.member')->with('status', 'Data berhasil direset');
        }

        $user = user::latest()->get();
        
        return view('admin.member', compact('user'));
    }
    public function tambah()
    {
        return view('admin.tambah');
    }
    public function posttambah(Request $request)
    {
        $data = $request->validate([
            'username'=>'required',
            'password'=>'required',
            'nis'=>'bail',
            'name'=>'required',
            'kelas'=>'bail',
            'alamat'=>'required',
            'role' => 'required',
        ]);
        $data['password'] = bcrypt($request->password);
        user::create($data);
        return redirect()->route('admin.member')->with('status', 'Berhasil tambah data');

    }
    public function edit(user $user)
    {
        return view('admin.edit', compact('user'));
    }
    public function postedit(Request $request, user $user)
    {
        $data = $request->validate([
            'username'=>'required',
            'password'=>'bail',
            'nis'=>'bail',
            'name'=>'required',
            'kelas'=>'bail',
            'alamat'=>'required',
            'role' => 'required',
        ]);
        
        if (filled($data['password']))
        {
            $data['password'] = bcrypt($request->password);
        }
        else
        {
            unset($data['password']);
        }
        
        $user->update($data);

        return redirect()->route('admin.member')->with('status', 'Berhasil merubah data');

    }
    public function hapus(user $user)
    {
        inf_guru::where('user_id', $user->id)->delete();
        inf_tugas::where('user_id', $user->id)->delete();
        absensi::where('user_id', $user->id)->delete();
        cat_kesalahan::where('user_id', $user->id)->delete();
        
        $user->delete();

        return redirect()->route('admin.member')->with('status', 'Berhasil hapus data');
    }

    public function absensi()
    {
        return view('admin.absensi');
    }

    public function resetabsensi()
    {
        absensi::query()->delete();

        return redirect()->route('admin.absensi')->with('status', 'Berhasil reset absensi');
    }

    public function harga()
    {
        return view('admin.harga', compact('setharga'));
    }

    public function importsiswa(Request $request)
    {
        $request->validate([
            'delimiter' => 'required',
            'berkas' => 'required|file|mimes:csv,txt'
        ]);

        $data = $request->berkas->get();

        $rows = explode(PHP_EOL, trim($data));

        $result = [];

        foreach ($rows as $row)
        {
            if (empty(trim($row))) continue;
            $cells = explode($request->delimiter, trim($row));

            if (count($cells) < 3)
            {
                return back()->with('status', 'Cell CSV minimal 3, untuk nama, nis, dan kelas');
            }

            // Filter Jika Rows Kosong, Bisa diskip
            $empty_cells = false;
            for ($i=0; $i<3; $i++)
            {
                if (empty($cells[$i]))
                {
                    $empty_cells = true;
                }
            }

            if ($empty_cells) continue;
            // end

            $result[] = [
                'name' => trim($cells[0]),
                'nis' => trim($cells[1]),
                'kelas' => trim($cells[2]),
                'opsional' => [
                    'alamat' => isset($cells[3]) && !empty($cells[3]) ? $cells[3] : null,
                    'role' => isset($cells[4]) && !empty($cells[4]) ? $cells[4] : null,
                    'username' => isset($cells[5]) && !empty($cells[5]) ? $cells[5] : null,
                    'password' => isset($cells[6]) && !empty($cells[6]) ? $cells[6] : null,
                ],
            ];
        }

        DB::transaction(function() use ($result) {
            foreach ($result as $d)
            {
                User::create([
                    'name' => $d['name'],
                    'alamat' => $d['opsional']['alamat'] ?? '',
                    'role' => $d['opsional']['role'] ?? 'siswa',
                    'kelas' => $d['kelas'],
                    'nis' => $d['nis'],
                    'username' => $d['opsional']['username'] ?? '',
                    'password' => $d['opsional']['password'] ? Hash::make($d['opsional']['password']) : '',
                ]);
            }
        });

        return back()->with('status', 'Berhasil import siswa');
    }
    
    public function informasi(Request $request)
    {
        if ($request->missing('from', 'to')) {
            return redirect()->route('admin.informasi.index', [
                'from' => now()->format('Y-m-d'),
                'to' => today()->format('Y-m-d')
            ]);
        }

        $inf_guru = inf_guru::select('inf_gurus.*')->with('mapel', 'user');

        if ($request->has(['from', 'to'])) {
            $inf_guru->whereBetween('tanggal', [$request->from, $request->to]);
        }

        if ($request->filled('kelas')) {
            $inf_guru->where('kelas', $request->kelas);
        }

        $inf_guru = $inf_guru->get();
        $kelas = user::query()->whereNotNull('kelas')->groupBy('kelas')->pluck('kelas');

        if ($request->type == 'Download') {
            return Excel::download(new class($inf_guru) implements FromArray
            {
                function __construct($inf_guru)
                {
                    $this->inf_guru = $inf_guru;
                }

                public function array(): array
                {
                    return [
                        ['Nama Guru', 'Mapel', 'Tanggal', 'Kelas', 'JP', 'Keterangan'],
                        ...($this->inf_guru->map(fn ($e) => [
                            $e->name,
                            $e->mapel->nama,
                            $e->tanggal,
                            $e->kelas,
                            $e->jp,
                            $e->keterangan,
                        ])->toArray())
                    ];
                }
            }, 'rekap-guru-' . $request->from . '-' . $request->to . '-' . '-kelas-' . ($request->kelas ?? 'all') . '-.xlsx');
        }

        return view('admin.informasi', compact('inf_guru', 'kelas'));
    }

    public function destroyinformasi(inf_guru $inf_guru)
    {
        $inf_guru->delete();
        return redirect()->route('admin.informasi.index')->with('status', 'Berhasil hapus data');
    }

    public function editinformasi(Request $request, inf_guru $inf_guru)
    {
        $mapel = Mapel::all();
        $gurumapel = GuruMapel::all();

        return view('admin.informasiedit', compact('mapel', 'inf_guru', 'gurumapel'));
    }

    public function updateinformasi(Request $request, inf_guru $inf_guru)
    {
        $data = $request->validate([
            'name'=>'required',
            'mapel_id'=>'required',
            'keterangan'=>'required',
            'jp'=>'required',
        ]);
        $data['tanggal'] = now();
        $inf_guru->update($data);
        return redirect()->route('admin.informasi.index')->with('status', 'Berhasil edit Informasi Pembelajaran');
    }

}
