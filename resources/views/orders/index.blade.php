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
            <div class="table-responsive mt-5">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>Peralatan</th>
                        <th>Mulai Rental</th>
                        <th>Sampai</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $value)
                        <tr>
                            <td>#</td>
                            <td>{{ $value->user->email }}</td>
                            <td><strong>
                                    @foreach($value->equipment as $peralatan)
                                        {{$peralatan->name}},
                                    @endforeach
                                </strong>
                            </td>
                            <td>{{ $value->rental_start }}</td>
                            <td>{{ $value->rental_start }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection
