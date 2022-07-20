<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

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
}
