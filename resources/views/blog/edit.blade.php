@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ isset($blog) ? 'Edit' : 'New' }} Blog
                    </div>
                    @if ($fail = Session::get('warning'))
                    <div class=" col-lg-12 col-md-12 col-sm-12  bs-example-bg-classes" >
                        <p class="bg-danger">
                            {{ $fail }}
                        </p>
                    </div>
                    @endif

                    <div class="panel-body">
                        {{--@if (isset($errors) && count($errors) > 0)--}}
                            {{--@foreach ($errors->all() as $message => $error)--}}
                                {{--{{ $error }}--}}
                            {{--@endforeach--}}
                        {{--@endif--}}

                        {!! Form::open( array('url' => isset($blog->id) ? 'blog/'.$blog->id : 'blog', 'class'=>'form', 'method'=> isset($blog) ? 'PUT' : 'POST' )) !!}
                            <div class="form-group  col-lg-12 col-md-12 col-sm-12" >
                                <div class="{{ isset($errors) && $errors->has('title') ? 'has-error' : '' }}">
                                    {!! Form::label('title', 'Title', ['class'=>' col-lg-12 col-md-12 col-sm-12']) !!}
                                    {!! Form::input('text', 'title', isset($blog->title) ? $blog->title : '', ['class'=>' col-lg-12 col-md-12 col-sm-12 form-control', 'id'=>'title', 'placeholder'=>'Title', 'required']) !!}
                                    <span id="helpBlock2" class="help-block">{{ $errors->first('title')}}</span>
                                </div>
                                <div class="{{ isset($errors) && $errors->has('body') ? 'has-error' : '' }}"
                                    {!! Form::label('body', 'Body', ['class'=>' col-lg-12 col-md-12 col-sm-12']) !!}
                                    {!! Form::textarea('body', isset($blog) ? $blog->body : '', ['class'=>' col-lg-12 col-md-12 col-sm-12 form-control', 'id'=>'body', 'placeholder'=>'Body', 'required']) !!}
                                    <span id="helpBlock2" class="help-block">{{ $errors->first('body')}}</span>
                                </div>
                                <div class="{{ isset($errors) && $errors->has('published_at') ? 'has-error' : '' }}"
                                    {!! Form::label('published_at', 'Publish on', ['class'=>'col-lg-12 col-md-12 col-sm-12']) !!}
                                    {!! Form::input('datetime', 'published_at', isset($blog->published_at) ? date('d-m-Y H:s', strtotime($blog->published_at)) : '', ['class' => 'col-lg-12 col-md-12 col-sm-12 form-control', 'id'=>'published_at', 'placeholder' => 'published at', 'required']) !!}
                                    <span id="helpBlock2" class="help-block">{{ $errors->first('published_at')}}</span>
                                </div>
                                {!! Form::label('active', 'Active', ['class'=>'col-lg-1 col-md-1 col-sm-1 pull-left']) !!}
                                {!! Form::checkbox('active', 'value', isset($blog) && $blog->active ? 'checked' : '', ['class'=>'col-lg-1 col-md-1 col-sm-1 pull-left', 'id'=>'active']) !!}
                                {!! Form::input('text', 'user_id', isset($blog->user_id) ? $blog->user_id : '', ['hidden', 'readonly'] ) !!}
                            </div>

                            {!! Form::token() !!}
                            <div class=" col-lg-12 col-md-12 col-sm-12">
                                {!! Form::submit('Submit', ['id'=>'submit']) !!}
                                @if (isset($blog))
                                    {{ link_to('/blog/'.$blog->id, 'Return', ['class'=>'btn btn-defult']) }}
                                @else
                                    {{ link_to('/blog', 'Return', ['class'=>'btn btn-defult'] ) }}
                                @endif

                            </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
