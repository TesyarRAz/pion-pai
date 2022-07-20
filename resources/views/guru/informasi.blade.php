@extends('appGuru')

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
                        <form action="{{ route('guru.informasi') }}" id="formFilter" class="mb-2" method="GET">
                            <select name="kelas" class="form-control mb-2" onchange="$('#formFilter').submit()">
                                <option value="">Silahkan Pilih Kelas</option>
                                @foreach ($kelas as $e)
                                    <option value="{{ $e }}" {{ request('kelas') == $e ? 'selected' : '' }}>{{ $e }}</option>
                                @endforeach
                            </select>
                            <div class="row align-items-center mb-2">
                                <div class="col-lg-3">
                                    <input type="date" class="form-control mb-1" name="from" value="{{ request('from') }}"  onchange="$('#formFilter').submit()">
                                </div>
                                <div class="col-lg-3">
                                    <input type="date" class="form-control" name="to" value="{{ request('to') }}"  onchange="$('#formFilter').submit()">
                                </div>
                                <div class="col">
                                    <input class="btn btn-outline-primary mt-1" type="submit" name="type" value="Download"/>
                                </div>
                            </div>
                        </form>
                        <table id="myTable" class="table" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>Mapel</th>
                                    <th>Tanggal</th>
                                    <th>Kelas</th>
                                    <th>JP</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inf_guru as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->mapel->nama }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->jp }}</td>
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
