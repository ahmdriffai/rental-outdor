@extends('layouts.layout-admin')

@section('content')
<div class="card py-2 px-2">
    <div class="row">
        <div class="col-md-6">
            <h5 class="card-header">Edit Kategori</h5>
        </div>
    </div>
    {!! Form::open(array('route' => ['categories.update', $category->id],'method'=>'POST')) !!}
    @method('PUT')
    <div class="row">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label" for="basic-default-email">Kategori <span class="text-danger">*</span></label>
                <div class="input-group input-group-merge">
                    {!! Form::text('name', $category->name, array('placeholder' => 'Nama Kategori','class' => 'form-control')) !!}
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Ubah</button>

        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection
