<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

class Listings extends \yii\db\ActiveRecord
{
     
     const HOST="https://s3.amazonaws.com/media.premiereplusrealty.com/n/";
     private $photo;

     public function __set($name,$value)
     {
          $this[$name] = $value;
     }
     
     public function getPhoto()
     {
          return $this['listing_photos']['URLs'];
     }
     
     public function getListing_photos()
     {
          return $this->hasOne(Listing_photos::className(), ['list_MLSnum' => 'list_MLSnum']);
     }

	private function get_source($MLS_NUM)
     {
	    $num=substr(substr($MLS_NUM,-2)*3,-2);
	    if (strlen($num)<2) $num="0".$num;
	    return $src="http://extimages2.living.net/ImagesHomeProd2/FL/idx/photos/naples/".$num."/";
	}
	
	public function get_photo($data)
     {
          $photo="/web/images/nophoto.gif";
          if (isset($data['URLs']) && $data['URLs']!="") {
               $urls=explode(",",$data['URLs']);
               foreach ($urls as $value) {
                    $photos[]=self::HOST.$value;
               }
               $photo=$photos[0];
          }
          elseif (isset($data['med1']) && $data['med1']>0) $photo=$this->get_source($data['list_MLSnum']).$data['list_MLSnum'].".jpg";
		return $photo;
	}
	
	public function get_photos($data)
     {
          $photos=array("/web/images/nophoto.gif");
          if ($data['listing_photos']['URLs']!="") {
               $photos=[];
               $urls=explode(",",$data['listing_photos']['URLs']);
               foreach ($urls as $key=>$value) {
                    if ($key>0) $photos[]=self::HOST.$value;
               }
          }
          else if ($data['med1']>0) {
               $photos=array();
               for ($i=1; $i<=$data['med1']; $i++) {
                    $photos[]=$this->get_source($data['list_MLSnum']).$data['list_MLSnum'].($i>1 ? "_".$i : "").".jpg";
               }
          }
		return $photos;
	}
     
}
