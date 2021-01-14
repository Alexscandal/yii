<?php

namespace app\controllers;

use Yii;
use app\models\Listings;
use app\models\Property_type;
use yii\data\Pagination;
use yii\helpers\VarDumper;

class ListingsController extends \yii\web\Controller {
     public function actionIndex() {
          $ListingsModel= new Listings();
          $items=Property_type::find()->orderBy('order')->asArray()->all();
          $types=[];
          foreach ($items as $value) {
               $types[$value['PropertyTypeCode']]=$value['PropertyTypeName'];
          }
          $type = Yii::$app->request->get('type');
          $min = (int)Yii::$app->request->get('min');
          $max = (int)Yii::$app->request->get('max');
          if ($min==0) $min="";
          if ($max==0) $max="";
          //VarDumper::dump($types,10,true);
          /* not works
               $query = Listings::find()
               ->select('l.list_MLSnum,l.bedrms_total,l.room1,l.prop20,l.list_Price, p.URLs')
               ->leftJoin('listing_photos p', 'l.list_MLSnum=p.list_MLSnum')
               ;
          */
               $query = Listings::find()
               ->select('l.list_MLSnum,l.bedrms_total,l.room1,l.prop20,l.list_Price, p.URLs')
               ->from(Listings::tableName() . " l")
               ->joinWith('listing_photos p');
               if (!empty($type) && key_exists($type,$types)) $query->where(['l.prop_class'=>$type]);
               $query->andFilterWhere(['>=','l.list_Price',$min]);
               $query->andFilterWhere(['<=','l.list_Price',$max]);
               //VarDumper::dump($query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);
             $pagination = new Pagination([
                 'defaultPageSize' => 12,
                 'totalCount' => $query->count(),
                 'route' => '../listings/'
             ]);
             $items = $query->orderBy('list_Price DESC')
                 ->offset($pagination->offset)
                 ->limit($pagination->limit)
                 ->all();
          foreach ($items as $key=>$value) {
               $items[$key]['listing_photos']['URLs']=$ListingsModel->get_photo($value['listing_photos']);
          }
          Yii::$app->view->title = 'Listings';
          $form=$this->renderPartial('form', ['types'=>$types, 'type'=>$type, 'min'=>$min, 'max'=>$max]);
          return $this->render('index', ['items'=>$items, 'pagination' => $pagination, 'form'=>$form]);
     }
    
     public function actionListing() {
          $ListingsModel= new Listings();
          $mls = Yii::$app->request->get('mls');
          $query = Listings::find()
          ->select('l.*, p.URLs')
          ->from(Listings::tableName() . " l")
          ->joinWith('listing_photos p')
          ->where(['l.list_MLSnum'=>$mls]);
          $item = $query->one();
          $item['listing_photos']['URLs']=$ListingsModel->get_photos($item);
          $item['photo']=$ListingsModel->getPhoto();
          Yii::$app->view->title = 'Listing #'.$mls;
          return $this->render('listing', ['item'=>$item]);
     }

}
