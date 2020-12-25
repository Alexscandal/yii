<?php
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags()?>
    <title><?= Html::encode($this->title) ?></title>
    <?php /*$this->head() ?>
    <?=yii\helpers\Html::cssFile( "@web/css/owl.carousel.css")*/?>
    <?=yii\helpers\Html::cssFile( "@web/css/bootstrap.min.css")."\n"?>
    <?=yii\helpers\Html::cssFile( "@web/css/bootstrap-theme.min.css")."\n"?>
    <?=yii\helpers\Html::cssFile( "@web/css/bootstrap-grid.min.css")."\n"?>
    <?=yii\helpers\Html::cssFile( "@web/css/bootstrap-utilities.min.css")."\n"?>
    <?=yii\helpers\Html::cssFile( "@web/css/owl.carousel.css")."\n"?>
    <?=yii\helpers\Html::cssFile( "@web/css/site.css")."\n"?>
    <?=yii\helpers\Html::jsFile(Yii::$app->request->baseUrl.'/js/jquery.js', ["type" => "text/javascript"])."\n"?>
    <?=yii\helpers\Html::jsFile(Yii::$app->request->baseUrl.'/js/owl.carousel.js', ["type" => "text/javascript"])."\n"?>
    <?=yii\helpers\Html::jsFile(Yii::$app->request->baseUrl.'/js/main.js', ["type" => "text/javascript"])."\n"?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Search listings',
        'brandUrl' => '/',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">&copy; My Company <?= date('Y') ?></div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
