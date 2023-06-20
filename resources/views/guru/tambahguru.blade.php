@extends('appGuru')

@section('main-content')
    <!-- Page Heading -->

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
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Informasi Tugas dari Guru</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <form action="{{ route('guru.posttambahguru') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Nama</label>
                                    <select name="name" id="name-guru" class="form-control" required>
                                        @foreach ($gurumapel as $e)
                                        <option value="{{ $e->name }}">{{ $e->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mata Pelajaran</label>
                                    <select name="mapel_id" class="form-control">
                                        @foreach ($mapel as $m)
                                        <option value="{{ $m->id }}">{{ $m->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Kelas</label>
                                    <select name="kelas" class="form-control mb-2">
                                        @foreach ($kelas as $e)
                                            <option value="{{ $e }}">{{ $e }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#name-guru").select2();
        });
    </script>
@endsection