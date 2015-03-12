@extends('column1')



@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><h3>Hi Stupid Laravel</h3></div>
        <div class="panel-body">
            {!!
                Insider\iNTable::html(array(
                    'header' => array('Id', 'Name', 'Type'),
                    'columns' => array('id', 'name', 'type'),
                    'datasource' => $meals,
                    'htmlOptions' => array('class'=>'table'),
                    'decorator' => array('name'=>'Insider\Html::link("/meal/update/{$data->id}", $data->name)'),
                ))
            !!}
            
        </div>
    </div>
    
@endsection