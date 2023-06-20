@extends('appSeker')

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

    <form id="absensiModal" class="modal fade" tabindex="-1" action="{{ route('user.absensi') }}" method="POST">
        @csrf

        <input type="hidden" name="user_id" class="user_id" id="absensiUserId">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atur Absensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="absensi">Absensi</label>
                        <select name="status_absen" id="absensi" class="form-control" required>
                            <option value="alpa">Alpa</option>
                            <option value="sakit">Sakit</option>
                            <option value="ijin">Ijin</option>
                            <option value="hadir">Hadir</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Tugas</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <table id="myTable" class="table" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nis }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>
                                            <button type="button" onclick="showModalAbsensi('{{ $item->id }}')"  class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-fw fa-pencil-alt"></i>
                                                Absensi
                                            </button>
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

        function showModalAbsensi(id) {
            $("#absensiUserId").val(id);
            $("#absensiModal").modal();
        }
    </script>
@endsection
