<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuruMapel;
use Illuminate\Http\Request;

class GuruMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = GuruMapel::latest()->get();

        return view('admin.gurumapel.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gurumapel.create');
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
            'nip' => 'bail',
            'name' => 'required',
        ]);

        GuruMapel::create($data);

        return redirect()->route('admin.gurumapel.index')->with('status', 'Berhasil tambah guru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GuruMapel  $guru_mapel
     * @return \Illuminate\Http\Response
     */
    public function show(GuruMapel $guru_mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GuruMapel  $guru_mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(GuruMapel $guru_mapel)
    {
        return view('admin.gurumapel.edit', compact('guru_mapel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GuruMapel  $guru_mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GuruMapel $guru_mapel)
    {
        $data = $request->validate([
            'nip' => 'bail',
            'name' => 'required',
        ]);

        $guru_mapel->update($data);

        return redirect()->route('admin.gurumapel.index')->with('status', 'Berhasil edit guru');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GuruMapel  $guru_mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuruMapel $guru_mapel)
    {
        $guru_mapel->delete();

        return redirect()->route('admin.gurumapel.index')->with('status', 'Berhasil hapus guru');
    }
}
