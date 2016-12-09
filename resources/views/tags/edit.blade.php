@extends('main')
@section('title', '| Edit Tags')

@section('content')
    {!! Form::model($tag, [ 'route' => ['tags.update', $tag->id], 'method' => 'PUT' ]) !!}
        {{ Form::label('name','Title:') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        {{ Form::submit('save change', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px;']) }}
    {!! Form::close() !!}
@endsection
