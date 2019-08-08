<?php

/* @var $this \yii\web\View */
/* @var $content string */

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
    <?php $this->registerCsrfMetaTags() ?>
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
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => '🏠 Home', 'url' => ['/site/index']],
            ['label' => '🚗 About', 'url' => ['/site/about']],
            ['label' => '📧 Contact', 'url' => ['/site/contact']],


            Yii::$app->user->isGuest ? (
            ['label' => '📝 Signup', 'url' => ['/site/signup']]
            ):(''),


            //user rental stuff
            Yii::$app->user->getId() ? (
            [
                'label' => '🚌 Rentals',
                'items' => [
                    '<li class="dropdown-header">Manage rentals</li>',
                    ['label' => '💺 New Rental', 'url' => ['/rental/create']],
                    ['label' => '📝 My Rental History', 'url' => ['/rental/rental-history']],
                ]
            ]) : (''),

            //admin buttons
            Yii::$app->user->getId() && Yii::$app->user->identity->isUserAdmin(
                    Yii::$app->user->getId()) === true ? (
            [
                'label' => '⚙️Admin Stuff',
                'items' => [
                    '<li class="dropdown-header">Manage...</li>',
                    ['label' => '🚓 Cars', 'url' => ['/car'],'active' => $this->context->route == 'car/index'],
                    ['label' => '🏎️ Rentals', 'url' => ['/rental'],'active' => $this->context->route == 'rental/index'],
                    ['label' => '🧙‍ Users', 'url' => ['/user'],'active' => $this->context->route == 'user/index'],

                    '<li class="dropdown-header">View Reports</li>',
                    ['label' => '🚓 Car usage', 'url' => ['/car'], 'active' => $this->context->route == 'car/index'],
                    ['label' => '💲 Incomes', 'url' => ['/car'], 'active' => $this->context->route == 'car/index'],
                    ['label' => '🚓 Wrecks', 'url' => ['/car'], 'active' => $this->context->route == 'car/index'],
                ],
            ]) : (''),

            Yii::$app->user->isGuest ? (
            ['label' => '🔑 Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '🔐 Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
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
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
