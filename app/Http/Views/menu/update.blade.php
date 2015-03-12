@extends('column2')


@section('portlet')
@endsection

@section('content')
    <pre>{!! print_r($model->getMealsId('Lunch')) !!}</pre>
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Update the Daily Menu</h4></div>
        <div class="panel-body">
            @include('menu.form')
        </div>
    </div>    
@endsection
