@extends('appSatpam')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Kelola Izin') }}</h1>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Izin</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="form-group">
                            <form class="" action="{{ route('satpam.izin.index') }}" id="formFilter" method="get">
                                <div class="d-flex align-items-center">
                                    <input type="date" name="tanggal" class="form-control col-lg-3" value="{{ request('tanggal') }}" onchange="$('#formFilter').submit()" required>
                                </div>
                            </form>
                        </div>
                        <table id="myTable" class="table" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->kelas }}</td>
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