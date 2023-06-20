@extends('appAdmin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Kelola User') }}</h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <form action="{{ route('admin.posttambah') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">NIS</label>
                                        <input type="number" name="nis" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Nama</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Role</label>
                                        <select name="role" class="form-control" required>
                                            @foreach (['sekertaris', 'osis', 'siswa', 'guru', 'satpam', 'admin'] as $role)
                                                <option value="{{ $role }}">
                                                    {{ strtoupper($role) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <input type="text" name="kelas" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
