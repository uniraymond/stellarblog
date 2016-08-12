
@extends('layouts.app')

@section('content')
    <div class="container container-full" ng-app="articleApp">
        <div class="row" ng-controller="articleController">
            {{--<a class="col-md-offset-2 btn btn-default right" href="{{ url('admin/article/create') }}" target="_blank">New Article</a>--}}
            <div class="col-lg-9 col-md-11 col-sm-10" >
                {{ $success = Session::get('status') }}
            </div>
            @if($blogs)
            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Published Time</th>
                    <th>Author Name</th>
                </tr>
                </thead>
                    <tbody>
                    @foreach($blogs as $blog)
                        <tr>
                            <td><a href="{{ url('blog/'.$blog->id) }}">{{ $blog->title }}</a></td>
                            <td>{{ $blog->body }}</td>
                            <td>{{ $blog->published_at }}</td>
                            <td>{{ $blog->users->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
            @else
                <div>
                    No blogs are available.
                </div>
            @endif
        </div>
        <div>
            {!! $blogs->links() !!}
        </div>
    </div>
@endsection