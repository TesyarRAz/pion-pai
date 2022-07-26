@extends('appAdmin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Data Mapel') }}</h1>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form class="modal fade" id="modal-import" method="POST" action="{{ route('admin.mapel.import') }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
    
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        Import Mapel
                    </div>
                    <button class="close" data-dismiss="modal" type="button">x</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Delimiter CSV</label>
                        <input type="text" name="delimiter" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Berkas CSV</label>
                        <input type="file" name="berkas" class="form-control-file" accept=".csv" required>
                        <span>Format : <br>(Nama Mapel) 1 Column</span>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                </div>
            </div>
        </div>
    </form>

    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Mapel</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('admin.mapel.create') }}" class="btn btn-outline-success mb-3">Isi Data</a>
                            </div>
                            <div>
                                <button type="button" data-target="#modal-import" data-toggle="modal" class="btn btn-outline-primary">
                                    Import
                                </button>
                            </div>
                        </div>
                        <table id="myTable" class="table" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <a href="{{ route('admin.mapel.edit',$item->id) }}" class="btn btn-outline-primary">Edit</a>
                                        <a href="{{ route('admin.mapel.destroy',$item->id) }}" class="btn btn-outline-danger"
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
