@extends('column2')


@section('portlet')
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h4>The Daily Menus</h4></div>
        <div class="panel-body yemek options">
            @foreach($datasource as $menu)
                <span class="opt-wrap center">{!! Html::link('/menu/view/'.$menu->id, $menu->date) !!}</span>
            @endforeach
        </div>
    </div>    
@endsection
