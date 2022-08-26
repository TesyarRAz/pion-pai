<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use App\Models\User;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->missing('from', 'to'))
        {
            return redirect()->route('guru.izin.index', [
                'from' => now()->format('Y-m-d'),
                'to' => today()->format('Y-m-d')
            ]);
        }

        $data = Izin::query()
        ->when($request->filled('from', 'to'), fn($query) => $query
            ->whereBetween('tanggal', [$request->from, $request->to])
        )
        ->when($request->filled('kelas'), fn($query) => $query
            ->join('users', 'users.id', 'izins.user_id')
            ->where('users.kelas', $request->kelas)
        )
        ->get();

        $siswas = User::query()
        ->where('role', 'siswa')
        ->when($request->filled('kelas'), fn($query) => $query
            ->where('kelas', $request->kelas)
        )
        ->get();

        $kelas = user::query()->whereNotNull('kelas')->groupBy('kelas')->pluck('kelas');

        return view('guru.izin.index', compact('data', 'siswas', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'keterangan' => 'required',
        ]);

        $data['tanggal'] = now();
        $data['guru_id'] = auth()->id();
        $data['guru_name'] = auth()->user()->name;

        Izin::create($data);

        return redirect()->route('guru.izin.index')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function show(Izin $izin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function edit(Izin $izin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Izin $izin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Izin $izin)
    {
        $izin->delete();

        return redirect()->route('guru.izin.index')->with('status', 'Data berhasil dihapus');
    }
}
