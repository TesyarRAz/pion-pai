<?php

namespace App\Http\Controllers;

use App\Models\cat_kesalahan;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class OsisController extends Controller
{
    public function homeOsis(Request $request)
    {
        $siswa = user::where('role', 'siswa')->with([
            'active_cat_kesalahan' => fn($query) => $query->whereDate('tanggal', now())
        ]);

        if ($request->filled('kelas'))
        {
            $siswa->where('kelas', $request->kelas);
        }

        $siswa = $siswa->get();
        $kelas = user::query()->whereNotNull('kelas')->groupBy('kelas')->pluck('kelas');

        return view('osis.homeOsis', compact('siswa', 'kelas'));
    }

    public function postcatatan(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'kesalahan' => 'required',
            'keterangan' => 'required',
            'point' => 'required|numeric',
        ]);

        $data['tanggal'] = now();

        cat_kesalahan::updateOrCreate(
            Arr::only($data, ['user_id', 'tanggal']),
            Arr::only($data, ['kesalahan', 'keterangan', 'point'])
        );

        return redirect()->route('osis.homeOsis')->with('status', 'Berhasil post catatan');
    }

    public function hapuscatatan(cat_kesalahan $cat_kesalahan)
    {
        $cat_kesalahan->delete();

        return redirect()->route('osis.homeOsis')->with('status', 'Berhasil hapus catatan');
    }

    public function riwayatcatatan(Request $request)
    {
        $siswa = user::where('role', 'siswa')->whereHas('cat_kesalahan')->withSum('cat_kesalahan', 'point');

        if ($request->filled('kelas')) {
            $siswa->where('kelas', $request->kelas);
        }

        $siswa = $siswa->get();
        $kelas = user::query()->whereNotNull('kelas')->groupBy('kelas')->pluck('kelas');

        return view('osis.riwayatcatatan', compact('siswa', 'kelas'));
    }

    public function rekapcatatan(Request $request, user $user)
    {
        $cat_kesalahan = $user->cat_kesalahan;

        return view('osis.rekapcatatan', compact('cat_kesalahan'));
    }
}
