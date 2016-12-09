@extends('main')
@section('title', '| create new post')

@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
    {!! Html::style('css/select2.min.css') !!}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist link',
            menubar: false
        });
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Create New Post</h1><hr>

            {!! Form::open([ 'route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true]) !!}
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', null, [ 'class' => 'form-control', 'required' => '', 'maxlength' => '255' ]) }}

                {{ Form::label('slug', 'Slug:') }}
                {{ Form::text('slug', null, [ 'class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255' ]) }}

                {{ Form::label('category_id', 'Category:') }}
                <select class="form-control" name="category_id">
                    @foreach( $categories as $category )
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                {{ Form::label('tags', 'Tags:') }}
                <select class="form-control select2-multi" name="tags[]" multiple="multiple">
                    @foreach( $tags as $tag )
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>

                {{ Form::label('featured_image', 'upload featured image:') }}
                {{ Form::file('featured_image', ['class' => 'form-control']) }}

                {{ Form::label('body', 'Body:') }}
                {{ Form::textarea('body', null, [ 'class' => 'form-control' ]) }}

                {{ Form::submit('Create Post', [ 'class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px;' ]) }}
            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
    {!! Html::script('js/select2.min.js') !!}
    <script>
        $('.select2-multi').select2();
    </script>
@endsection
