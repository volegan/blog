@extends('main')
@section('title', 'Edit Post')

@section('stylesheets')
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
        {{-- model form binding --}}
        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!}
        <div class="col-md-8">
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title', null, ['class' => 'form-control input-lg', 'style' => 'margin-bottom:10px;']) }}

            {{ Form::label('slug', 'Slug:') }}
            {{ Form::text('slug', null, ['class' => 'form-control input-lg']) }}

            {{ Form::label('category_id', 'Category:') }}
            {{ Form::select('category_id', $categories, null, ['class' => 'form-control' ]) }}

            {{ Form::label('tags' , 'Tags:') }}
            {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}

            {{ Form::label('featured_image', 'update featured image:') }}
            {{ Form::file('featured_image', ['class' => 'form-control']) }}

            {{ Form::label('body', 'Body:') }}
            {{ Form::textarea('body', null, ['class' => 'form-control input-lg']) }}
        </div>

        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created at:</dt>
                    <dd>{{ date('M-j-Y g:ia', strtotime($post->created_at)) }}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Last Update:</dt>
                    <dd>{{ date('M-j-Y g:ia', strtotime($post->updated_at)) }}</dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        {{ Html::linkRoute('posts.show', 'Cancel', [$post->id], ['class' => 'btn btn-danger btn-block']) }}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::submit('Save', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop

@section('scripts')
    {!! Html::script('js/select2.min.js') !!}
    <script>
        $('.select2-multi').select2();
        $('.select2-multi').select2().val( {!! json_encode( $post->tags()->getRelatedIds() ) !!} ).trigger('change');
    </script>
@endsection
