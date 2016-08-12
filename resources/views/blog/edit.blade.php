@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ isset($blog) ? 'Edit' : 'New' }} Article</div>
                    <div class="panel-body">
                        {!! Form::open( array('url' => isset($blog->id) ? 'blog/'.$blog->id : 'blog', 'class'=>'form', 'method'=> isset($blog) ? 'PUT' : 'POST' )) !!}
                            <div class="form-group col-md-6" >
                                {!! Form::label('title', 'Title', ['class'=>'col-md-12']) !!}
                                {!! Form::input('text', 'title', isset($blog) ? $blog->title : 'Title', ['class'=>'col-md-12 form-control', 'id'=>'title', 'placeholder'=>'Title']) !!}

                                {!! Form::label('body', 'Body', ['class'=>'col-md-12']) !!}
                                {!! Form::textarea('body', isset($blog) ? $blog->body : '', ['class'=>'col-md-12 form-control', 'id'=>'body', 'placeholder'=>'Body']) !!}

                                {!! Form::label('published_at', 'Publish on') !!}
                                {!! Form::input('datetime', 'published_at', isset($blog->published_at) ? date('d-m-Y H:s', strtotime($blog->published_at)) : '', ['class' => 'form-control col-md-12', 'id'=>'published_at', 'placeholder' => 'published at']) !!}

                                {!! Form::label('active', 'Active', ['class'=>'col-md-12']) !!}
                                {!! Form::checkbox('active', isset($blog) && $blog->active ? 1 : 0, isset($blog) && $blog->active ? true : false, ['class'=>'col-md-12 form-control', 'id'=>'active']) !!}
                            </div>

                            {!! Form::token() !!}
                            <div class="col-md-11">
                                <input type="submit" id="submit" value="Submit" />
                            </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection