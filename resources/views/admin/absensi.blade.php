@extends('appAdmin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Kelola Absensi') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-chart-bar fa-fw mr-2"></i> {{ __('Peralatan') }}</h5>
                </div>
                <div class="card-body">
                    <form class="d-flex justify-content-between" action="{{ route('admin.resetabsensi') }}" method="POST"
                        onsubmit="return confirm('Yakin ingin direset?') && confirm('Serius ingin di reset') && prompt('Ketik ya jika ingin di reset') === 'ya'">
                        @csrf
                        <span class="card-text font-weight-bold">Reset Absensi ( semua )</span>
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-fw fa-circle"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
