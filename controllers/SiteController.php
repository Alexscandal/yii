<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Listings;
use app\models\Property_type;

class SiteController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
     Yii::$app->view->title = 'Search Listings';
          $ListingsModel= new Listings();
          $items=Property_type::find()->orderBy('order')->asArray()->all();
          $types=[];
          foreach ($items as $value) {
               $types[$value['PropertyTypeCode']]=$value['PropertyTypeName'];
          }
     $form=$this->renderPartial('../listings/form', ['types'=>$types]);
        return $this->render('index', ['form'=>$form]);
    }

}
