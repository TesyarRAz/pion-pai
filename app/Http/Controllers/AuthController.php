<?php

namespace App\Http\Controllers;

use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\ElseIf_;

class AuthController extends Controller
{
    public function login()
    {
        $general_settings = resolve(GeneralSettings::class);

        return view('auth.login', compact('general_settings'));
    }

    public function postlogin(Request $request)
    {
        $cek = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($cek)) {
            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect()->route('admin.member')->with('status', 'Selamat datang : ' . $user->name);
            } else if ($user->role == 'sekertaris') {
                return redirect()->route('user.homeSeker')->with('status', 'Selamat datang : ' . $user->name);
            } else if ($user->role == 'guru') {
                return redirect()->route('guru.homeguru')->with('status', 'Selamat datang : ' . $user->name);
            } else if ($user->role == 'osis') {
                return redirect()->route('osis.homeOsis')->with('status', 'Selamat datang : ' . $user->name);
            } else if ($user->role == 'satpam') {
                return redirect()->route('satpam.izin.index')->with('status', 'Selamat datang : ' . $user->name);
            } else if ($user->role == 'siswaspy') {
                return redirect()->route('user.guru')->with('status', 'Selamat datang : ' . $user->name);
            } else if ($user->role == 'guruspy') {
                return redirect()->route('guru.informasi')->with('status', 'Selamat datang : ' . $user->name);
            }

            auth()->logout();
        }
        return back()->with('status', 'Email atau password salah');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
