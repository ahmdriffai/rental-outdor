@extends('layouts.layout-admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Peralatan Rental</h6>
        </div>
        <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
                {!! Form::open(['class' => 'navbar-search', 'method' => 'get']) !!}
                <div class="input-group">
                    {!! Form::text('key', $_GET['key'] ?? '', ['class' => ['form-control', 'bg-light', 'border-0', 'small'], 'placeholder' => 'Search for...']) !!}
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori Peralatan</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $value)
                        <tr>
                            <td>#</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->category->name }}</td>
                            <td>Rp. {{ number_format($value->price) }}</td>
                            <td class="text-center">
                                <img src="{{ $value->image_url ?? '' }}" class="img-fluid" width="100px">
                            </td>
                            <td class="d-flex justify-content-center">
                                <a class="btn btn-primary btn-sm mx-1" href="{{ route('equipment.edit', $value->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <div>
                                    {!! Form::open(['route' => ['equipment.destroy', $value->id], 'method' => 'DELETE']) !!}
                                    <button type="submit" class="btn btn-sm btn-danger delete-confirm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection
