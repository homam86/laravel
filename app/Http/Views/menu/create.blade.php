@extends('column2')


@section('portlet')
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Create the Daily Menu</h4></div>
        <div class="panel-body">
            @include('menu.form')
        </div>
    </div>    
@endsection
