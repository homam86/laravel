@extends('column2')


@section('portlet')
    {!! Insider\iNUtil::portlet($portlet) !!}
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Create New Meal</h4></div>
        <div class="panel-body">
            @include('meal.form')
        </div>
    </div>    
@endsection
