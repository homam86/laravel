@extends('column2')


@section('portlet')
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Update Meal #{{$id}}</h4></div>
        <div class="panel-body">
            @include('meal.form')
        </div>
    </div>    
@endsection
