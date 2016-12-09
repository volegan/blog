@extends('main')
@section('title', '| Register')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            {{ Form::open() }}
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}

                {{ Form::label('email', 'Email:') }}
                {{ Form::email('email', null, ['class' => 'form-control']) }}

                {{ Form::label('password', 'Password:') }}
                {{ Form::password('password', ['class' => 'form-control']) }}

                {{ Form::label('password_confirmation', 'Password:') }}
                {{ Form::password('password_confirmation', ['class' => 'form-control']) }}

                {{ Form::submit('Login', ['class' => 'btn btn-primary btn-block', 'style' => 'margin-top:20px;']) }}
            {{ Form::close() }}

        </div>
    </div>
@endsection
