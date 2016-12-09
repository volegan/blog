@extends('main')
@section('title', '| Categories')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>categories</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $categories as $category )
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- End of col-8-->

        <div class="col-md-3">
            <div class="well">
                {!! Form::open(['route' => 'categories.store']) !!}
                    <h2>New Category</h2>
                    {{ Form::label('name', 'Name:') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}

                    {{ Form::submit('Create new Category', ['class' => 'btn btn-primary btn-block', 'style' => 'margin-top:10px;']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
