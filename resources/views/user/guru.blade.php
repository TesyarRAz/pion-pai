@extends('appSeker')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pemberitahuan Guru Tidak Hadir') }}</h1>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Tugas Guru</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <a href="{{ route('user.tambahinf') }}" class="btn btn-outline-success mb-3">Isi Informasi</a>
                        <table id="myTable" class="table" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>Mapel</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah JP</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inf_guru as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->mapel->nama }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->jp }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('user.editinf',$item->id) }}" class="btn btn-outline-primary">Edit</a>
                                        <a href="{{ route('user.hapusguru',$item->id) }}" class="btn btn-outline-danger"
                                            onclick="return confirm('Yakin ingin hapus')">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
