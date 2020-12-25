<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;
?>
<h1>Listings</h1>
<?=$form?>
<div class="row grid">
<?php foreach ($items as $value) {?>
<div class="col-lg-4 col-md-6">
     <div class="item">
          <div class="image"><a href="/listings/listing?mls=<?=$value['list_MLSnum']?>"><img src="<?=$value['listing_photos']['URLs']?>" alt="" /></a></div>
          <div class="desc"><?if ($value['bedrms_total']>0) {?><b><?=$value['bedrms_total']?></b> Beds<?}?><?if ($value['room1']>0) {?> <b><?=$value['room1']?></b> Baths<?}?><?if ($value['prop20']>0) {?> <b><?=number_format($value['prop20'])?></b> Sq Ft<?}?></div>
          <div class="price">$<?=number_format($value['list_Price'])?></div>
     </div>
</div>
<?php }?>
</div>
<div style="overflow: hidden;">
<?=LinkPager::widget(['pagination' => $pagination])?>
</div>