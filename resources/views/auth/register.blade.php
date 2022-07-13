@extends('layouts.layout-auth')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Daftar Akun!</h1>
                </div>
                {!! Form::open(['url' => route('register'), 'method' => 'post', 'class' => 'user']) !!}
                <div class="form-group">
                    {!! Form::text('email', null, ['class' => ['form-control', 'form-control-user', $errors->has("email") > 0 ? 'is-invalid' : ''], 'placeholder' => 'Enter Email Address..']) !!}
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::password('password', ['class' => ['form-control', 'form-control-user', $errors->has("password") > 0 ? 'is-invalid' : ''], 'placeholder' => 'Password']) !!}
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::password('password_confirmation', ['class' => ['form-control', 'form-control-user'], 'placeholder' => 'Password']) !!}
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <hr>
                {!! Form::submit('Daftar', ['class' => ['btn', 'btn-primary', 'btn-user', 'btn-block']]) !!}

                <a href="index.html" class="btn btn-google btn-user btn-block">
                    <i class="fab fa-google fa-fw"></i> Daftar dengan Google
                </a>
                {!! Form::close() !!}
                <hr>
                <div class="text-center">
                    <a class="small" href="{{ route('register') }}">Create an Account!</a>
                </div>
            </div>
        </div>
    </div>

@endsection
