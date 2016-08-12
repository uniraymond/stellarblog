@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome Stella Blog Test Project</div>

                <div class="panel-body">
                    {{ link_to('/blog', 'Jump to the blogs list page.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
