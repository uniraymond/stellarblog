
@extends('layouts.app')

@section('content')
    <div class="container container-full" ng-app="articleApp">
        <div class="row" ng-controller="articleController">
            {{--<a class="col-md-offset-2 btn btn-default right" href="{{ url('admin/article/create') }}" target="_blank">New Article</a>--}}
            <div class="col-lg-9 col-md-11 col-sm-10" >
                {{ $success = Session::get('status') }}
                {{ $success = Session::get('warning') }}
            </div>
            <div class="blog">
                <div class="title">
                    <h2>{{ $blog->title }}</h2><br />
                    <small>Published at: {{ date('d M, Y H:s', strtotime($blog->published_at)) }}</small>
                </div>
                <div class="body">
                    {{ $blog->body }}
                </div>
                <div>
                    Author: {{ $blog->users->name }}
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                {!! Form::open(array('url' => 'blog/'.$blog->id, 'class'=>'form', 'method'=> 'DELETE', 'onsubmit'=>'return confirm("Are you sure to delete this blog?")' )) !!}
                {!! Form::submit('Delete', ['class'=>'btn btn-default']) !!}
                {!! Form::token() !!}
                {!! Form::close() !!}
            </div>
            <div class="col-lg-2 col-md-2">
                {{ link_to('blog/'.$blog->id.'/edit', 'Edit', ['class'=>'btn btn-default']) }}
                <a href="{{ url('blog') }}">Return</a>
            </div>
        </div>
        <div>
        </div>
    </div>
@endsection