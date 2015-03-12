<div class="form inline lable10">
    {!! ActiveForm::begin($model) !!}
        {!! Html::csrfField() !!}
        
        <div class="row">
            {!! ActiveForm::label($model, 'date', array('required'=>true)) !!}
            {!! ActiveForm::datepicker($model, 'date', ['options'=>['dateFormat'=>'yy-mm-dd']]) !!}
        </div>
            
        <div class="row">
            {!! ActiveForm::label($model, 'note') !!}
            {!! ActiveForm::textField($model, 'note') !!}
        </div>
            
        <div class="row">
            <div class="col-md-2 ">
                <h4>Lunch</h4>
                {!! ActiveForm::checkboxList($model, 'items', Meal::getLunchDishes(), [
                     'class' => 'yemek options'
                    ])
                !!}
            </div>
            
            <div class="col-md-2  col-md-offset-2">
                <h4>Snack</h4>
                {!! ActiveForm::checkboxList($model, 'items', Meal::getSnackDishes(), [
                     'class' => 'yemek options'
                    ])
                !!}
            </div>
                
            <div class="col-md-2  col-md-offset-2">
                <h4>Dinner</h4>
                {!! ActiveForm::checkboxList($model, 'items', Meal::getDinnerDishes(), [
                     'class' => 'yemek options'
                    ])
                !!}
            </div>
        </div>
            
        
            
        <div class="row">
            {!! ActiveForm::submit('Save', array('class'=>'btn btn-primary')) !!}
        </div>
        
    {!! ActiveForm::end() !!}
</div>