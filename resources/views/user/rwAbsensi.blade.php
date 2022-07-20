@extends('appSeker')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Rekapitulasi Kehadiran') }}</h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Absensi</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <table id="myTable" class="table" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Sakit</th>
                                    <th>Ijin</th>
                                    <th>Alpa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nis }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->total_sakit }}</td>
                                    <td>{{ $item->total_ijin }}</td>
                                    <td>{{ $item->total_alpa }}</td>
                                    <td>
                                        <a href="{{ route('user.rekapabsensi', $item->id) }}" class="btn btn-outline-primary">Ditel</a>
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
            $('#myTable').DataTable({
                buttons: [
                    'print'
                ],
                dom: 'Brftip'
            });
        });
    </script>
@endsection
