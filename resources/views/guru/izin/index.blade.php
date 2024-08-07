@extends('appGuru')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Kelola Izin') }}</h1>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif


    <form id="create-modal" class="modal fade" tabindex="-1" action="{{ route('guru.izin.store') }}" method="POST">
        @csrf

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atur Izin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_id">Siswa</label>
                        <select name="user_id" id="user_id" class="form-control">
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="guru_name">Nama Guru</label>
                        <input type="text" class="form-control" id="guru_name" name="guru_name" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_surat">No Surat</label>
                        <input type="text" class="form-control" id="no_surat" name="no_surat" required>
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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Izin</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button data-toggle="modal" data-target="#create-modal" class="btn btn-sm btn-outline-success mb-3"><i class="fas fa-fw fa-plus"></i>Isi
                                Data</button>
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <form class="" action="{{ route('guru.izin.index') }}" id="formFilter" method="get">
                                <select name="kelas" class="form-control mb-2" onchange="$('#formFilter').submit()">
                                    <option value="">Silahkan Pilih Kelas</option>
                                    @foreach ($kelas as $e)
                                        <option value="{{ $e }}" {{ request('kelas') == $e ? 'selected' : '' }}>
                                            {{ $e }}</option>
                                    @endforeach
                                </select>
                                <div class="row align-items-center">
                                    <div class="col-lg-3">
                                        <input type="date" name="from" class="form-control mb-1"
                                            value="{{ request('from') }}" onchange="$('#formFilter').submit()">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="date" name="to" class="form-control"
                                            value="{{ request('to') }}" onchange="$('#formFilter').submit()">
                                    </div>
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
                                    <th>Pengizin</th>
                                    <th>Keterangan</th>
                                    <th>No Surat</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->kelas }}</td>
                                        <td>{{ $item->guru_name }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->no_surat }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            @if ($item->status == 'keluar')
                                            <button type="button"
                                            class="btn btn-outline-primary"
                                            onclick="$('#form-verification-{{ $item->id }}').submit()">Verifikasi</button>
                                            @endif
                                            <a href="{{ route('guru.izin.destroy', $item->id) }}"
                                                class="btn btn-outline-danger"
                                                onclick="return confirm('Yakin ingin dihapus ?')">Hapus</a>

                                            <form action="{{ route('guru.izin.update', $item->id) }}" class="d-none" method="POST" id="form-verification-{{ $item->id }}" onsubmit="return confirm('Yakin ingin diverifikasi ?')">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="status" value="kembali">
                                            </form>
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
