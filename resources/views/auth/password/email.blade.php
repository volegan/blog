@extends('main')

@section('title', '| Forget Password')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Reset password</div>
                @if(session('status'))
                    <div class="lert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="panel-body">

                    {!! Form::open(['url' =>'password/email', 'method' =>"POST"]) !!}

                        {{ Form::label('email', 'Email') }}
                        {{ Form::email('email', null, ['class' => 'form-control']) }}

                        {{ Form::submit('Reset Password', ['class' => 'btn btn-primary btn-block', 'style' => 'margin-top:20px;']) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
