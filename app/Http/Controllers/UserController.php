<?php

namespace App\Http\Controllers;
use App\Models\user;
use App\Models\absensi;
use App\Models\GuruMapel;
use App\Models\inf_tugas;
use App\Models\inf_guru;
use App\Models\Mapel;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function homeSeker()
    {
        $user = user::where('kelas', auth()->user()->kelas)->get();

        return view('user.homeSeker', compact('user'));
    }

    public function rwAbsensi()
    {
        $user = user::query()->where('kelas', auth()->user()->kelas)
        ->with('absensi')
        ->get();

        foreach ($user as $u)
        {
            $u->total_sakit = $u->absensi->where('status_absen', 'sakit')->count();
            $u->total_alpa = $u->absensi->where('status_absen', 'alpa')->count();
            $u->total_ijin = $u->absensi->where('status_absen', 'ijin')->count();
            $u->total_kabur = $u->absensi->where('status_absen', 'kabur')->count();
        }

        return view('user.rwAbsensi', compact('user'));
    }

    public function informasi(Request $request)
    {
        if ($request->missing('from', 'to'))
        {
            return redirect()->route('user.informasi', [
                'from' => now()->format('Y-m-d'),
                'to' => today()->format('Y-m-d')
            ]);
        }

        $inf_tugas=inf_tugas::where('kelas', auth()->user()->kelas);

        if ($request->has(['from', 'to']))
        {
            $inf_tugas->whereBetween('tanggal', [$request->from, $request->to]);
        }

        $inf_tugas = $inf_tugas->get();

        return view('user.informasi', compact('inf_tugas'));
    }

    public function guru()
    {
        $inf_guru=inf_guru::where('kelas', auth()->user()->kelas)->where('tanggal', today())->get();
        return view('user.guru', compact('inf_guru'));
    }

    public function tambahinf()
    {
        $mapel = Mapel::all();
        $gurumapel = GuruMapel::all();

        return view('user.tambahinf', compact('mapel', 'gurumapel'));
    }

    public function posttambahinf(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'mapel_id'=>'required',
            'keterangan'=>'required',
            'jp'=>'required',
            'status_masuk' => 'bail',
        ]);
        $data['status_masuk'] = $request->filled('status_masuk') ? 'masuk' : 'tidak';
        $data['kelas'] = auth()->user()->kelas;
        $data['tanggal'] = now();
        $data['user_id'] = auth()->id();
        inf_guru::create($data);
        return redirect()->route('user.guru')->with('status', 'Berhasil tambah Informasi Pembelajaran');
    }

    public function hapusguru(inf_guru $inf_guru)
    {
        $inf_guru->delete();
        return redirect()->route('user.guru')->with('status', 'Berhasil hapus data');
    }

    public function editinf(Request $request, inf_guru $inf_guru)
    {
        $mapel = Mapel::all();
        $gurumapel = GuruMapel::all();

        return view('user.editinf', compact('mapel', 'inf_guru', 'gurumapel'));
    }

    public function posteditinf(Request $request, inf_guru $inf_guru)
    {
        $data = $request->validate([
            'name'=>'required',
            'mapel_id'=>'required',
            'keterangan'=>'required',
            'jp'=>'required',
        ]);
        $data['kelas'] = auth()->user()->kelas;
        $data['tanggal'] = now();
        $data['user_id'] = auth()->id();
        $inf_guru->update($data);
        return redirect()->route('user.guru')->with('status', 'Berhasil edit Informasi Pembelajaran');
    }

    public function absensi(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'status_absen' => 'required|in:alpa,sakit,ijin,hadir,kabur',
        ]);

        $absensi = absensi::firstWhere([
            'user_id' => $data['user_id'],
            'waktu_absen' => now()->format('Y-m-d')
        ]);

        if ($absensi)
        {
            if ($data['status_absen'] == 'hadir')
            {
                $absensi->delete();
            }
            else
            {
                $absensi->update([
                    'status_absen' => $data['status_absen']
                ]);
            }
        }
        else
        {
            absensi::create([
                'user_id' => $data['user_id'],
                'status_absen' => $data['status_absen'],
                'waktu_absen' => now()->format('Y-m-d')
            ]);
        }

        return back()->with('status', 'Berhasil absensi');
    }

    public function rekapabsensi(user $user)
    {
        $absensi = $user->absensi;

        return view('user.rekapabsensi', compact('user', 'absensi'));
    }

}
