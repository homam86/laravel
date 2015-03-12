<div class="form inline lable10">
    {!! ActiveForm::begin($model) !!}
        {!! Html::csrfField() !!}
        
        <div class="row">
            {!! ActiveForm::label($model, 'name', array('required'=>true)) !!}
            {!! ActiveForm::textField($model, 'name') !!}
        </div>
            
        <div class="row">
            {!! ActiveForm::label($model, 'type', array('required'=>true)) !!}
            {!! ActiveForm::dropList($model, 'type', array(
                'Lunch' => 'Lunch',
                'Dinner' => 'Dinner',
                'Snack' => 'Snack',
            )) !!}
        </div>
            
        <div class="row">
            {!! ActiveForm::label($model, 'enabled', array('required'=>true)) !!}
            {!! ActiveForm::radioList($model, 'enabled', array(
                1 => 'Yes',
                0 => 'No',
            )) !!}
        </div>
            
        <div class="row">
            {!! ActiveForm::submit('Save', array('class'=>'btn btn-default')) !!}
        </div>
        
    {!! ActiveForm::end() !!}
</div>