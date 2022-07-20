@extends('appSeker')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Informasi Tugas Dari Guru') }}</h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Tugas</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <form action="{{ route('user.informasi') }}" class="row align-items-center mb-4">
                            <div class="col-lg-3">
                                <input type="date" class="form-control" name="from" value="{{ request('from') }}" required>
                            </div>
                            <div class="col-lg-3">
                                <input type="date" class="form-control" name="to" value="{{ request('to') }}" required>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-fw fa-search"></i>
                                </button>
                            </div>
                        </form>
                        <table id="myTable" class="table" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>Mapel</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inf_tugas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->mapel->nama }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->keterangan }}</td>
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
