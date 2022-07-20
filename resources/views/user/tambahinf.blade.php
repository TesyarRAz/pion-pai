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
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Informasi Pembelajaran</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <form action="{{ route('user.posttambahinf') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Nama</label>
                                    <input type="text"  class="form-control" name="name" required>
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
                                    <label>Jumlah JP</label>
                                    <input type="number" name="jp" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>

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
