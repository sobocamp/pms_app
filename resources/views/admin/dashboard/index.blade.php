{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3>Dashboard</h3>
    </div>

    {{-- <div class="col-auto ms-auto text-end mt-n1">
        <a href="#" class="btn btn-light bg-white me-2">Invite a Friend</a>
        <a href="#" class="btn btn-primary">New Project</a>
    </div> --}}
</div>

<div class="row">
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Produk</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-white bg-success">
                            <i class="align-middle" data-feather="box"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $products }}</h1>
                <div class="mb-0">
                    <a href="{{ url('admin/produk') }}">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Pembelian</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-white bg-danger">
                            <i class="align-middle" data-feather="dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ number_format($pembelian, 0) }}</h1>
                <div class="mb-0">
                    <a href="{{ url('admin/pembelian') }}">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Penjualan</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-white bg-info">
                            <i class="align-middle" data-feather="dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ number_format($penjualan, 0) }}</h1>
                <div class="mb-0">
                    <a href="{{ url('#') }}">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
