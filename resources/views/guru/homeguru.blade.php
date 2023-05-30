@extends('appGuru')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Riwayat Kehadiran') }}</h1>

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
                <div class="card-body">
                    <div class="">
                        <div class="form-group">
                            <form class="" action="{{ route('guru.homeguru') }}" id="formFilter" method="get">
                                <select name="kelas" class="form-control mb-2" onchange="$('#formFilter').submit()">
                                    <option value="">Silahkan Pilih Kelas</option>
                                    @foreach ($kelas as $e)
                                        <option value="{{ $e }}" {{ request('kelas') == $e ? 'selected' : '' }}>{{ $e }}</option>
                                    @endforeach
                                </select>
                                <div class="d-flex align-items-center">
                                    <input type="date" name="from" class="form-control col-lg-3 mr-1" value="{{ request('from') }}" onchange="$('#formFilter').submit()" required>
                                    <input type="date" name="to" class="form-control col-lg-3" value="{{ request('to') }}" onchange="$('#formFilter').submit()" required>
                                </div>
                            </form>
                        </div>
                        <table id="myTable" class="table" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Tanggal</th>
                                    <th>Status Absensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->nis }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->kelas }}</td>
                                        <td>{{ $item->waktu_absen }}</td>
                                        <td>{{ $item->status_absen}}</td>
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
            $('#myTable').DataTable({
                buttons: [
                    'print'
                ],
                dom: 'Brftip'
            });
        });
    </script>
@endsection
