@extends('layouts.layout-admin')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <a href="{{ route('equipment.index') }}" class="btn btn-primary btn-icon-split mb-3">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-alt-circle-left"></i>
                        </span>
                        <span class="text">Kembali</span>
                    </a>
                    {!! Form::open(['url' => route('equipment.store'), 'method' => 'post', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Nama Peralatan', ['class' => 'font-weight-bold']) !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', 'Harga', ['class' => 'font-weight-bold']) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp. </div>
                                </div>
                                {!! Form::number('price', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="mb-3">
                            {!! Form::label('description', 'Keterangan', ['class' => 'font-weight-bold']); !!}
                            <div class="input-group input-group-merge">
                                {!! Form::textarea('description', null, array('class' => 'form-control', 'id' => 'body', 'width' => '100%')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('image', 'Foto', ['class' => 'font-weight-bold']) !!}
                            {!! Form::file('image', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('category_id', 'Kategori', ['class' => 'font-weight-bold']) !!}
                            {!! Form::select('category_id', $category ,null, array('class' => ['form-control', 'select2'], 'placeholder' => 'Pilih Dosen')) !!}
                        </div>

                        {!! Form::submit('Tambah', ['class' => ['btn', 'btn-primary']]) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

    <script>
        var konten = document.getElementById("body");
        CKEDITOR.replace(konten,{
            language:'en-gb'
        });
        CKEDITOR.config.allowedContent = true;
        CKEDITOR.config.width = '100%';
    </script>

    <!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
