@extends('column2')


@section('portlet')
@endsection

@section('content')
    
    <h1>Daily Menu <em class="noi">{!! $model->date !!}</em></h1>
        
    <h4>Main Dish</h4>
    <div class="panel-body yemek options">
        @foreach($model->lunch() as $meal)
            <span class="opt-wrap center">{!! $meal->name !!}</span>
        @endforeach
    </div>
    
    <h4>Snack</h4>
    <div class="panel-body yemek options">
        @foreach($model->snack() as $meal)
            <span class="opt-wrap center">{!! $meal->name !!}</span>
        @endforeach
    </div>
    
    <h4>Dinner</h4>
    <div class="panel-body yemek options">
        @foreach($model->dinner() as $meal)
            <span class="opt-wrap center">{!! $meal->name !!}</span>
        @endforeach
    </div>

@endsection