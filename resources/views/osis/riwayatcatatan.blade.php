@extends('appOsis')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Data Siswa') }}</h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Riwayat</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <form action="{{ route('osis.riwayatcatatan') }}" id="formFilter" class="mb-2" method="GET">
                            <select name="kelas" class="form-control mb-2" onchange="$('#formFilter').submit()">
                                <option value="">Silahkan Pilih Kelas</option>
                                @foreach ($kelas as $e)
                                    <option value="{{ $e }}" {{ request('kelas') == $e ? 'selected' : '' }}>{{ $e }}</option>
                                @endforeach
                            </select>
                        </form>

                        <table id="myTable" class="table" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Total Point</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nis }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->cat_kesalahan_sum_point }}</td>
                                        <td>
                                            <a href="{{ route('osis.rekapcatatan', $item->id) }}" class="btn btn-outline-danger">Detail</a>
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
