@extends('layouts.layout-admin')

@section('content')
    <div class="row">
        <div class="col-md-6">
            @include('categories.list')
        </div>
        <div class="col-md-6">
            @include('categories.create')
        </div>
    </div>
@endsection
