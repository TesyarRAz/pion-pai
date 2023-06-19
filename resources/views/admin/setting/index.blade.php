@extends('appAdmin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pengaturan') }}</h1>

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

    @include('admin.setting.file_modal', ['id' => 'modal-logo-app', 'name' => 'logo_app', 'accept' => 'image/*'])
    @include('admin.setting.combobox_modal', ['id' => 'modal-background-type', 'name' => 'background_type', 'items' => ['warna' => 'Warna', 'gambar' => 'Gambar']])

    @includeWhen($general_settings->background_type == 'gambar', 'admin.setting.file_modal', ['id' => 'modal-background-app', 'name' => 'background_app', 'accept' => 'image/*'])
    @includeWhen($general_settings->background_type == 'warna', 'admin.setting.color_modal', ['id' => 'modal-background-app', 'name' => 'background_app'])

    <div class="row mb-5">
        <div class="col-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-chart-bar fa-fw mr-2"></i> {{ __('General') }}</h5>
                </div>
                <div class="card-body">
                    <div class="form-row form-group justify-content-between">
                        <div class="col-4">
                            <label class="font-weight-bold">Logo App</label>
                            <img src="{{ filled($general_settings->logo_app) ? $general_settings->logo_app : asset('empty-image.webp') }}" class="img-fluid" width="300px" height="300px" alt="">
                        </div>
                        <div class="col-5">
                            <button class="btn-block btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-logo-app">
                                <i class="fas fa-fw fa-pencil-alt"></i>
                                Edit
                            </button>
                        </div>
                    </div>
                    <div class="form-row form-group justify-content-between">
                        <div class="col-4">
                            <label class="font-weight-bold">Background Type</label>
                            <span>{{ $general_settings->background_type }}</span>
                        </div>
                        <div class="col-5">
                            <button class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal-background-type">
                                <i class="fas fa-fw fa-pencil-alt"></i>
                                Edit
                            </button>
                        </div>
                    </div>
                    <div class="form-row form-group justify-content-between">
                        <div class="col-4">
                            <label class="font-weight-bold">Background App</label>
                            @if ($general_settings->background_type == 'warna')
                            <div style="width: 100px; height: 100px; background-color: {{ $general_settings->background_app }}"></div>
                            @elseif ($general_settings->background_type == 'gambar')
                            <img src="{{ filled($general_settings->background_app) ? $general_settings->background_app : asset('empty-image.webp') }}" class="img-fluid" width="300px" height="300px" alt="">
                            @endif
                        </div>
                        <div class="col-5">
                            <button class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal-background-app">
                                <i class="fas fa-fw fa-pencil-alt"></i>
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
