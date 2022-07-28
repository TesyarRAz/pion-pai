<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function member()
    {
        $user = user::all();
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
            'nis'=>'required',
            'name'=>'required',
            'kelas'=>'required',
            'alamat'=>'required',
        ]);
        $data['password'] = bcrypt($request->password);
        $data['role'] = 'customer';
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
            'password'=>'required',
            'nis'=>'required',
            'name'=>'required',
            'kelas'=>'required',
            'alamat'=>'required',
        ]);
        $data['password'] = bcrypt($request->password);
        $data['role'] = 'customer';
        $user->update($data);
        return redirect()->route('admin.member')->with('status', 'Berhasil merubah data');

    }
    public function hapus(user $user)
    {
        $user->delete();
        return redirect()->route('admin.member')->with('status', 'Berhasil hapus data');
    }

    public function absensi()
    {
        return view('admin.absensi');
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
                    'role' => in_array($d['opsional']['role'], ['siswa', 'sekertaris', 'guru']) ? $d['opsional']['role'] : 'siswa',
                    'kelas' => $d['kelas'],
                    'nis' => $d['nis'],
                    'username' => $d['opsional']['username'] ?? '',
                    'password' => $d['opsional']['password'] ?? '',
                ]);
            }
        });

        return back()->with('status', 'Berhasil import siswa');
    }
}
