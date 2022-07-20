<?php

namespace Database\Seeders;

use App\Models\absensi;
use App\Models\inf_guru;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\inf_tugas;
use App\Models\Mapel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'admin',
            'username' => '000',
            'password' => bcrypt('1'),
            'role' => 'admin',
            'nis' => '000',
            'alamat' => 'Block 5a'
        ]);
        User::create([
            'name' => 'Guru 2',
            'username' => '111',
            'password' => bcrypt('1'),
            'role' => 'guru',
            'nis' => '111',
            'alamat' => 'Block 5a'
        ]);
        User::create([
            'name' => 'Guru',
            'username' => '999',
            'password' => bcrypt('1'),
            'role' => 'guru',
            'nis' => '999',
            'alamat' => 'Block 5a'
        ]);
        User::create([
            'name' => 'Budi Sudarsono',
            'username' => '222',
            'password' => bcrypt('1'),
            'role' => 'sekertaris',
            'nis' => '222',
            'kelas' => 'XI RPL 1',
            'alamat' => 'Block 4a'
        ]);
        User::create([
            'name' => 'Asep Batman',
            'username' => '444',
            'password' => bcrypt('1'),
            'role' => 'siswa',
            'nis' => '444',
            'kelas' => 'XI RPL 1',
            'alamat' => 'Block 3a'
        ]);
        User::create([
            'name' => 'Toni stark',
            'username' => '333',
            'password' => bcrypt('1'),
            'role' => 'sekertaris',
            'nis' => '333',
            'kelas' => 'X RPL 1',
            'alamat' => 'Block 4a'
        ]);
        User::create([
            'name' => 'Rina Nose',
            'username' => '555',
            'password' => bcrypt('1'),
            'role' => 'osis',
            'nis' => '555',
            'kelas' => 'XI RPL 1',
            'alamat' => 'Block 3a'
        ]);
        User::create([
            'name' => 'Captain Amerika',
            'username' => '777',
            'password' => bcrypt('1'),
            'role' => 'siswa',
            'nis' => '777',
            'kelas' => 'X RPL 1',
            'alamat' => 'Block 3a'
        ]);
        User::create([
            'name' => 'Thor Sipetir',
            'username' => '888',
            'password' => bcrypt('1'),
            'role' => 'osis',
            'nis' => '888',
            'kelas' => 'XII RPL 1',
            'alamat' => 'Block 3a'
        ]);

        $mapel_basdat = Mapel::create([
            'nama' => 'Basis Data',
        ]);
        $mapel_web = Mapel::create([
            'nama' => 'Web',
        ]);
        $mapel_pemdas = Mapel::create([
            'nama' => 'Pemdas',
        ]);
        $mapel_jardas = Mapel::create([
            'nama' => 'Jardas',
        ]);

        inf_tugas::create([
            'user_id' => '2',
            'tanggal' => now(),
            'keterangan' => 'silahkan kerjakan Tugas 3 di SL',
            'kelas' => 'X RPL 1',
            'mapel_id' => $mapel_basdat->id,
        ]);
        inf_tugas::create([
            'user_id' => '2',
            'tanggal' => now(),
            'keterangan' => 'HTML Dasar',
            'kelas' => 'X RPL 1',
            'mapel_id' => $mapel_web->id,
        ]);
        inf_tugas::create([
            'user_id' => '3',
            'tanggal' => now(),
            'keterangan' => 'silahkan ',
            'kelas' => 'XI RPL 1',
            'mapel_id' => $mapel_pemdas->id,
        ]);
        inf_tugas::create([
            'user_id' => '3',
            'tanggal' => now(),
            'keterangan' => 'HTML Dasar',
            'kelas' => 'XI RPL 1',
            'mapel_id' => $mapel_jardas->id,
        ]);
        inf_guru::create([
            'user_id' => '4',
            'tanggal' => now(),
            'keterangan' => 'Tidak hadir karena sakit',
            'kelas' => 'X RPL 1',
            'mapel_id' => $mapel_jardas->id,
            'name' => 'Guru',
            'jp' => 8
        ]);
        absensi::create([
            'user_id' => '5',
            'waktu_absen' => now(),
            'keterangan' => 'Tidak hadir karena sakit',
            'status_absen' => 'sakit',
        ]);

        absensi::create([
            'user_id' => '6',
            'waktu_absen' => now(),
            'keterangan' => 'Tidak hadir karena alpa',
            'status_absen' => 'alpa',
        ]);
    }
}
