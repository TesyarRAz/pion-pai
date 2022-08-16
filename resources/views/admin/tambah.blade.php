@extends('appAdmin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Data Member') }}</h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Member</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <form action="{{ route('admin.posttambah') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Username</label>
                                    <input type="text"  class="form-control" name="username" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>NIS</label>
                                    <input type="text" name="nis" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Kelas</label>
                                    <input type="text" name="kelas" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" class="form-control"  placeholder="Jl. Proklamasi..." required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Role</label>
                                    <select name="role" class="form-control">
                                        @foreach (['admin','sekertaris','osis','siswa','guru'] as $role)
                                            <option value="{{ $role }}">{{ strtoupper($role) }}</option>
                                        @endforeach
                                    </select>
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
