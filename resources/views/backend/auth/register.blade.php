{{-- @extends('backend.auth.layouts.master') --}}

@section('page_title', 'Register')
@section('content')

    {{-- {!! Form::open([]) !!} --}}
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control form-control-sm']) !!}

    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, ['class' => 'form-control form-control-sm']) !!}

    {!! Form::label('password', 'Password', ['class' => 'mt-2']) !!}
    {!! Form::password('password', ['class' => 'form-control form-control-sm']) !!}

    {{-- {!! Form::label('confirm_password', 'Confirm password',['class'=>'mt-2']) !!}
    {!! Form::password('confirm_password', ['class'=>'form-control form-control-sm']) !!} --}}

    {{-- <div class="d-grid">
        {!! Form::button('Register', ['type' => 'submit', 'class' => 'btn btn-info btn-sm mt-2']) !!}
    </div> --}}

    {!! Form::close() !!}
    <div class="mt-2">
        <p>Already Register? <a href="{{ route('login') }}">Login</a></p>
    </div>
@endsection
