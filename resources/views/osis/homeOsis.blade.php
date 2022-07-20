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


    <form id="catatanModal" class="modal fade" tabindex="-1" action="{{ route('osis.postcatatan') }}" method="POST">
        @csrf

        <input type="hidden" name="user_id" class="user_id" id="catatanUserId">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atur Catatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kesalahan">Kesalahan</label>
                        <input type="text" name="kesalahan" id="kesalahan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="point">Point</label>
                        <input type="number" name="point" id="point" class="form-control" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Kesalahan</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <button type="button" data-toggle="modal" data-target="#catatanModal" class="btn btn-outline-success mb-3">Input Catatan</button>

                        <form action="{{ route('osis.homeOsis') }}" id="formFilter" class="mb-2" method="GET">
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
                                    <th>Kesalahan</th>
                                    <th>Point</th>
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
                                        <td>{{ optional($item->active_cat_kesalahan)->kesalahan }}</td>
                                        <td>{{ optional($item->active_cat_kesalahan)->point }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-success" onclick="showModalCatatan('{{ $item->id }}')">Kesalahan</button>
                                            @if(filled($item->active_cat_kesalahan))
                                            <a href="{{ route('osis.hapuscatatan', $item->active_cat_kesalahan->id) }}" class="btn btn-outline-danger">Hapus</a>
                                            @endif
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
        const data = @json($siswa);

        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        function showModalCatatan(id) {
            const item = data.filter((item) => item.id == id)[0]

            $("#catatanUserId").val(id);
            $("#kesalahan").val(item?.active_cat_kesalahan?.kesalahan);
            $("#keterangan").val(item?.active_cat_kesalahan?.keterangan);
            $("#point").val(item?.active_cat_kesalahan?.point);
            $("#catatanModal").modal();
        }
    
    </script>
@endsection