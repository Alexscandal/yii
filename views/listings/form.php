<?php
use yii\helpers\Html;
?>
<?=Html::beginForm('/listings/','get')?>
     <div class="row justify-content-md-center">
          <div class="col-sm-3 col-lg-2 col-3"><?=Html::dropdownList('type',$type,$types,['prompt'=>'Select type','placeholder' => 'Min Price','class'=>'form-control'])?></div>
          <div class="col-sm-3 col-lg-2 col-3"><?=Html::textInput('min',$min,['placeholder' => 'Min Price','class'=>'form-control'])?></div>
          <div class="col-sm-3 col-lg-2 col-3"><?=Html::textInput('max',$max,['placeholder' => 'Max Price','class'=>'form-control'])?></div>
          <div class="col-auto"><?=Html::submitButton('Search', ['class' => 'btn btn-primary'])?></div>
     </div>
<?=Html::endForm() ?>
