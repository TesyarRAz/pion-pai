@extends('appSeker')

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
                    <h6 class="m-0 font-weight-bold text-primary">Edit Informasi Pembelajaran</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <form action="{{ route('user.posteditinf', $inf_guru->id) }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Nama</label>
                                    
                                    <select name="name" id="name-guru" class="form-control" required>
                                        @foreach ($gurumapel as $e)
                                        <option value="{{ $e->name }}" @if($e->name == $inf_guru->name) selected @endif>{{ $e->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mata Pelajaran</label>
                                    <select name="mapel_id" class="form-control">
                                        @foreach ($mapel as $m)
                                        <option value="{{ $m->id }}" @if($inf_guru->mapel_id == $m->id) selected @endif>{{ $m->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Jumlah JP</label>
                                    <input type="number" name="jp" class="form-control" value="{{ $inf_guru->jp }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" value="{{ $inf_guru->keterangan }}" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" value="{{ $inf_guru->tanggal }}" required>
                                </div>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="checkStatusMasuk" name="status_masuk" {{ $inf_guru->status_masuk == 'masuk' ? 'checked' : '' }}>
                                <label class="form-check-label" for="checkStatusMasuk" checked>Masuk</label>
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
            $('#name-guru').select2();
        });
    </script>
@endsection
