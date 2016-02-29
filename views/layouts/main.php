<?php

/* @var $this \yii\web\View */
/* @var $content string */

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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
    $navItems=[
    		['label' => '主页', 'url' => ['/site/index']],
//     		['label' => 'Status', 'url' => ['/status/index']],
    		['label' => '关于我们', 'url' => ['/site/about']],
    		['label' => '反馈', 'url' => ['/site/contact']]
    ];
    
    if (Yii::$app->user->isGuest) {
    	array_push($navItems,['label' => '登陆', 'url' => ['/user/security/login']],['label' => 'Sign Up', 'url' => ['/user/register']]);
    } else {
    	array_push($navItems,['label' => '登出 (' . Yii::$app->user->identity->username . ')',
    			'url' => ['/site/logout'],
    			'linkOptions' => ['data-method' => 'post']]
    			);
    }
    echo Nav::widget([
    		'options' => ['class' => 'navbar-nav navbar-right'],
    		'items' => $navItems,
    ]);
    
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy;  <?= Yii::$app->name,' ',date('Y') ?></p>

        <p class="pull-right"><?= 'Powered by Sevenga'//Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
