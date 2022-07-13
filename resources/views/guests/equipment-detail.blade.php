@extends('layouts.layout-guest')
@section('content')
    <nav class="mt-5" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('guest.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $equipment->name }}</li>
        </ol>
    </nav>
    <div class="row g-5">
        <div class="col-md-6">
            <div>
                <img src="{{ $equipment->image_url ?? asset('sb-admin/img/banner.jpg') }}" class="img-fluid">
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-evenly flex-column">
            <div class="row">
                <h2 class="text-uppercase fw-light">{{ $equipment->name }}</h2>
            </div>
            <div class="row">
                <h6 class="text-uppercase fw-bold">Ketersediaan Stok :</h6>
            </div>
            <div class="row">
                <h3 class="text-uppercase fw-bold">Rp. {{ number_format($equipment->price) }}</h3>
            </div>
            <div class="row">
                {!! Form::open(['url' => route('carts.store'), 'method' => 'post', 'class' => ['d-flex']]) !!}
                {!! Form::hidden('equipment_id', $equipment->id) !!}
                {!! Form::number('quantity', 0, ['class' => ['form-control'], 'min' => 0]) !!}
                {!! Form::submit('Tambah Keranjang', ['class' => ['btn', 'btn-danger', 'rounded-0', 'ms-5']]) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
