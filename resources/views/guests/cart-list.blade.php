@extends('layouts.layout-guest')

@section('content')
    <nav class="mt-5" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('guest.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
        </ol>
    </nav>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl-10">
            <div class="card mb-4">
                <div class="card-body">
                    {!! Form::open(array('route' => 'orders.store','method'=>'POST')) !!}

                    <div class="form-group">
                        {!! Form::label('rental_start', 'Mulai Rental', ['class' => 'font-weight-bold']) !!}
                        {!! Form::date('rental_start',null ,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('rental_end', 'Sampai', ['class' => 'font-weight-bold']) !!}
                        {!! Form::date('rental_end', null,['class' => 'form-control']) !!}
                    </div>


                    <div class="col-lg-12 mb-4 mb-xl-0 mb-3">
                        <label class="form-label" for="basic-default-fullname">Keranjang Rental</label>
                        <ul class="list-group">
                            @php
                                $jumlahBayar = 0;
                            @endphp
                            @foreach($carts as $value)
                                <input type="hidden" name="equipment_id[]" value="{{ $value->equipment->id }}">
                                <input type="hidden" name="quantity[]" value="{{ $value->quantity }}">
                                @php
                                    $jumlah = $value->quantity * $value->equipment->price;
                                    $jumlahBayar += $jumlah;
                                @endphp
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="{{ route('carts.delete', $value->id) }}" class="btn btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <img src="{{ $value->equipment->image_url ?? asset('sb-admin/img/banner.jpg') }}" class="img-fluid rounded-1 me-2" width="80px" height="80px">
                                        <div class="">
                                            {{ $value->equipment->name }}
                                            <br>
                                            x {{ $value->quantity }}
                                        </div>
                                    </div>
                                    Rp. {{ number_format($value->equipment->price) }}
                                </li>
                            @endforeach
                            <li class="d-flex justify-content-between align-items-center px-3 mt-3">
                                <strong> Total Pesanan </strong>
                                <strong> {{ $carts->sum('quantity') }} item</strong>
                            </li>
                            <li class="d-flex justify-content-between align-items-center px-3 mt-3">
                                <strong> Jumlah Bayar </strong>
                                <strong> Rp. {{ number_format($jumlahBayar) }}</strong>
                            </li>
                        </ul>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Checkout</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@endsection
