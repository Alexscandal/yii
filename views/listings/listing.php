<?php
use yii\helpers\VarDumper;
//VarDumper::dump($item,10,true);
?>
<h1>Listing #<?=$item['list_MLSnum']?></h1>
<div class="row">
     <div class="col-sm-8">
						<div id="property-detail-wrapper" class="style1">
							<div id="property-detail-large" class="owl-carousel">
                                   <?php foreach($item['photo'] as $key=>$value) {?>
								<div class="item">
									<img src="<?=$value?>" alt="<?=$ws_address?> - Photo <?=$key+1?>" />
								</div>
							<?php }?>
							</div>
							<?php if (count($item['photo'])>1) {?>
							<div id="property-detail-thumbs" class="owl-carousel">
                                   <?php foreach($item['photo'] as $key=>$value) {?>
								<div class="item"><img src="<?=$value?>" alt="Photo <?=$key+1?>" /></div>
                                   <?php }?>
							</div>
                                   <?php }?>
						</div>
     </div>
     <div class="col-sm-4">
          <p>Price: $<?=number_format($item['list_Price'])?></p>
          <p>Beds: <?=$item['bedrms_total']?></p>
          <p>Baths: <?=$item['room1']?></p>
          <p>Area: <?=number_format($item['prop20'])?> Sq Ft</p>
     </div>
</div>11