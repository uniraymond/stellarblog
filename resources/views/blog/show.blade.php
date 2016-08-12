
@extends('layouts.app')

@section('content')
    <div class="container container-full" ng-app="blogApp">
        <div class="row" ng-controller="blogController">
            <div class="col-lg-12 col-md-12 col-sm-12 bs-example-bg-classes" >
                @if ( $success = Session::get('status') )
                    <p class="bg-info">
                        {{ $success }}
                    </p>
                @elseif( $failed = Session::get('warning') )
                    <p class="bg-danger">
                        {{ $failed }}
                    </p>
                @endif

            </div>
            <div class="blog col-lg-12 col-md-12 col-sm-12">
                <div class="title">
                    <h1>{{ $blog->title }}</h1>
                    <div class="sub-date-auth col-lg-12 col-md-12 col-sm-12">
                            Posted by <span class="sub-auth">{{ $blog->users->name }}</span> on {{ date('d F, Y H:s', strtotime($blog->published_at)) }}
                    </div>
                </div>
                <div class="body col-lg-12 col-md-12 col-sm-12">
                    {{ $blog->body }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-3">
                {!! Form::open(array('url' => 'blog/'.$blog->id, 'class'=>'form', 'method'=> 'DELETE', 'onsubmit'=>'return confirm("Are you sure to delete this blog?")' )) !!}
                {!! Form::submit('Delete', ['class'=>'btn btn-warning']) !!}
                {!! Form::token() !!}
                {!! Form::close() !!}
            </div>
            <div class="col-lg-1 col-md-1 col-sm-3">
                {!! Form::open(array('url' => 'blog/'.$blog->id.'/remove', 'class'=>'form', 'method'=> 'DELETE', 'onsubmit'=>'return confirm("Are you sure to delete this blog?")' )) !!}
                {!! Form::submit('Remove', ['class'=>'btn btn-warning']) !!}
                {!! Form::token() !!}
                {!! Form::close() !!}
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 pull-right">
                {{ link_to('blog/'.$blog->id.'/edit', 'Edit', ['class'=>'btn btn-default']) }}
                {{ link_to('blog', 'Return') }}
            </div>
        </div>
    </div>
@endsection