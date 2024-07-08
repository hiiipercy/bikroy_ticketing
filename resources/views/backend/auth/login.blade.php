@extends('backend.auth.layouts.master')
@section('page_title', 'Login')
@section('content')
    {!! Form::open(['method'=>'post', 'route'=>'login']) !!}
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, ['class' => $errors->has('email') ? 'invalide form-control form-control-sm' : 'form-control form-control-sm']) !!}
    @error('email')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    {!! Form::label('password', 'Password', ['class' => 'mt-2']) !!}
    {!! Form::password('password', ['class' => $errors->has('password') ? 'invalide form-control form-control-sm' : 'form-control form-control-sm']) !!}
    @error('password')
    <p class="text-danger">{{ $message }}</p>
@enderror
    <div class="d-grid">
        {!! Form::button('Login', ['type' => 'submit', 'class' => 'btn btn-info btn-sm mt-2']) !!}
    </div>
    {!! Form::close() !!}
    <div class="mt-2">
        {{-- <p>Forget password? <a href="{{ route('password.request') }}" target="_blank">Click here</a></p> --}}
        {{-- <p>New here? <a href="{{ route('register') }}" target="_blank">Register here</a></p> --}}
    </div>
@endsection
