<?php

namespace App\Http\Controllers;

use App\Models\inf_guru;
use App\Models\inf_tugas;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mapel::all();

        return view('admin.mapel.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mapel.create');
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
            'nama' => 'required',
        ]);
        Mapel::create($data);
        return redirect()->route('admin.mapel.index')->with('status', 'Berhasil tambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        return view('admin.mapel.edit', compact('mapel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapel $mapel)
    {
        $data = $request->validate([
            'nama' => 'required',
        ]);
        $mapel->update($data);
        return redirect()->route('admin.mapel.index')->with('status', 'Berhasil merubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        inf_guru::where('mapel_id', $mapel->id)->delete();
        inf_tugas::where('mapel_id', $mapel->id)->delete();
        $mapel->delete();
        return redirect()->route('admin.mapel.index')->with('status', 'Berhasil hapus data');
    }


    public function import(Request $request)
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

            if (count($cells) < 1)
            {
                return back()->with('status', 'Cell CSV minimal 1, untuk nama');
            }

            // Filter Jika Rows Kosong, Bisa diskip
            $empty_cells = false;
            for ($i=0; $i<1; $i++)
            {
                if (empty($cells[$i]))
                {
                    $empty_cells = true;
                }
            }

            if ($empty_cells) continue;
            // end

            $result[] = [
                'nama' => trim($cells[0]),
            ];
        }

        DB::transaction(function() use ($result) {
            foreach ($result as $d)
            {
                Mapel::create([
                    'nama' => $d['nama'],
                ]);
            }
        });

        return back()->with('status', 'Berhasil import mapel');
    }
}
