
@extends('layouts.app')

@section('content')
    <div class="container container-full" ng-app="blogApp">
        <div class="row" ng-controller="blogController">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h1>Blogs</h1>
            </div>

            {{--new blog link--}}
            @if (Auth::user())
                <div class="col-lg-2 col-md-2 col-sm-2 pull-right clearfix">
                    {{ link_to('blog/create', 'New Blog', ['class'=>'btn btn-default', 'target'=>'_blank']) }}
                </div>
            @endif
            {{--flash alert--}}
            @if ($success = Session::get('status'))
                <div class="col-lg-12 col-md-12 col-sm-12 bs-example-bg-classes" >
                    <p class="bg-success">
                        {{ $success }}
                    </p>
                </div>
            @endif

            @if($blogs)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Published Time</th>
                        <th>Author Name</th>
                        @if (Auth::user())
                            <th>Edit</th>
                        @endif
                    </tr>
                    </thead>
                        <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td><a href="{{ url('blog/'.$blog->id) }}">{{ $blog->title }}</a></td>
                                <td>{{ substr($blog->body, 0, 50).'...' }}</td>
                                <td>{{ $blog->published_at }}</td>
                                <td>{{ $blog->users->name }}</td>
                                @if (Auth::user())
                                    <td>{{ link_to('blog/'.$blog->id.'/edit', 'Edit', ['class'=>'btn btn-default btn-xs']) }}</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                </table>
            @else
                <div class="col-lg-12 col-md-12 col-sm-12 clearfix">
                    <h4>No blogs are available.</h4>
                </div>
            @endif
        </div>
        @if ($blogs)
            <div class="col-lg-12 col-md-12 col-sm-12 clearfix">
                {!! $blogs->links() !!}
            </div>
        @endif
    </div>
@endsection