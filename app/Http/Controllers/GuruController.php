<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\GuruMapel;
use App\Models\inf_guru;
use App\Models\inf_tugas;
use App\Models\Mapel;
use App\Models\user;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    public function homeguru(Request $request)
    {
        if ($request->missing(['from', 'to'])) {
            return redirect()->route('guru.homeguru', [
                'from' => today()->format('Y-m-d'),
                'to' => today()->addDays(1)->format('Y-m-d'),
            ]);
        }

        $absensi = absensi::select('absensis.*');

        if ($request->filled('kelas')) {
            $absensi->join('users', 'users.id', 'absensis.user_id')
                ->where('users.kelas', $request->kelas);
        }

        if ($request->filled(['from', 'to'])) {
            $absensi->whereBetween('waktu_absen', [$request->from, $request->to]);
        }

        $absensi = $absensi->get();

        $kelas = user::query()->whereNotNull('kelas')->groupBy('kelas')->pluck('kelas');
        $general_settings = resolve(GeneralSettings::class);

        return view('guru.homeguru', compact('absensi', 'kelas', 'general_settings'));
    }

    public function guru(Request $request)
    {
        if ($request->missing('from', 'to')) {
            return redirect()->route('guru.guru', [
                'from' => now()->format('Y-m-d'),
                'to' => today()->format('Y-m-d')
            ]);
        }

        $inf_tugas = inf_tugas::with('mapel');

        if ($request->has(['from', 'to'])) {
            $inf_tugas->whereBetween('tanggal', [$request->from, $request->to]);
        }

        if ($request->filled('kelas')) {
            $inf_tugas->where('kelas', $request->kelas);
        }

        $inf_tugas = $inf_tugas->get();
        $kelas = user::query()->whereNotNull('kelas')->groupBy('kelas')->pluck('kelas');

        if ($request->type == 'Download') {
            return Excel::download(new class($inf_tugas) implements FromArray
            {
                function __construct($inf_tugas)
                {
                    $this->inf_tugas = $inf_tugas;
                }

                public function array(): array
                {
                    return [
                        ['Nama Guru', 'Mapel', 'Tanggal', 'Kelas', 'Keterangan'],
                        ...($this->inf_tugas->map(fn ($e) => [
                            $e->user->name,
                            $e->mapel->nama,
                            $e->tanggal,
                            $e->kelas,
                            $e->keterangan,
                        ])->toArray())
                    ];
                }
            }, 'rekap-tugas-' . $request->from . '-' . $request->to . '-' . '-kelas-' . ($request->kelas ?? 'all') . '-.xlsx');
        }

        return view('guru.guru', compact('inf_tugas', 'kelas'));
    }

    public function tambahguru()
    {
        $mapel = Mapel::all();
        $kelas = user::query()->whereNotNull('kelas')->groupBy('kelas')->pluck('kelas');
        $gurumapel = GuruMapel::all();

        return view('guru.tambahguru', compact('mapel', 'kelas', 'gurumapel'));
    }

    public function posttambahguru(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'mapel_id' => 'required',
            'keterangan' => 'required',
            'kelas' => 'required',
        ]);
        $data['tanggal'] = now();
        $data['user_id'] = auth()->id();
        inf_tugas::create($data);
        return redirect()->route('guru.guru')->with('status', 'Berhasil tambah Informasi Pembelajaran');
    }

    public function hapusguru(inf_tugas $inf_tugas)
    {
        $inf_tugas->delete();

        return redirect()->route('guru.guru')->with('status', 'Berhasil hapus Informasi Pembelajaran');
    }

    public function informasi(Request $request)
    {
        if ($request->missing('from', 'to')) {
            return redirect()->route('guru.informasi', [
                'from' => now()->format('Y-m-d'),
                'to' => today()->format('Y-m-d')
            ]);
        }

        $inf_guru = inf_guru::with('mapel');

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
                            $e->user->name,
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

        return view('guru.informasi', compact('inf_guru', 'kelas'));
    }
}
