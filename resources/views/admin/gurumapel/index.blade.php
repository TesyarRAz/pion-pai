@extends('appAdmin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Kelola Guru Mapel') }}</h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Guru Mapel</h6>
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('admin.gurumapel.create') }}"
                                    class="btn btn-sm btn-outline-success mb-3"><i class="fas fa-fw fa-plus"></i>Isi
                                    Data</a>
                            </div>
                        </div>
                        <table id="myTable" class="table" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nip }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.gurumapel.edit', $item->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-fw fa-pencil-alt"></i>
                                                Edit
                                            </a>
                                            <button onclick="$('#form-delete-{{$id}}').submit()" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-fw fa-trash-alt"></i>
                                                Hapus
                                            </button>

                                            <form action="{{ route('admin.gurumapel.destroy', $item->id) }}"
                                                id="form-delete-{{ $id }}" class="d-none" method="POST" onsubmit="return confirm('Yakin ingin hapus')">
                                                @csrf
                                                @method('DELETE')

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
