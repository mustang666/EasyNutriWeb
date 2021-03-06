<?php /* @var $this Controller */ ?>
<?php Yii::app()->bootstrap->register();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/imagensEasynutri/iconeTransparente.gif" type="image/x-icon" />


    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
          media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
          media="print"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
          media="screen, projection"/>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/easyNutri.css"
          media="screen, projection"/>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/Spinner.js"></script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div id="print-div" class="printOnly">

</div>
<div class="container" id="page">
    <!--    <div id="header">-->
    <!--        <div id="logo">--><?php //echo CHtml::encode(Yii::app()->name); ?><!--</div>-->
    <!--    </div>-->
    <!-- header -->

    <div id="mainmenu">
        <?php $this->widget('bootstrap.widgets.TbNavbar', array(
            'display' => null,
            'brandLabel'=> CHtml::image(Yii::app()->getBaseUrl().'/assets/imagensEasynutri/iconeTransparente.gif')."EasyNutri",
            'color' => TbHtml::NAV_TYPE_TABS,
            'items' => array(
                array('class' => 'bootstrap.widgets.TbNav',
                    'items' => array(
                        array('label' => 'Os Meus Utentes', 'url' => array('/utentes/admin'), 'visible' => !Yii::app()->user->isGuest),
//                        array('label' => 'Registos Antropométricos', 'url' => array('/dadosAntro/admin')),
//                        array('label' => 'Notificações', 'url' => array('/notificacoes/admin')),
//                        array('label' => 'Plano Alimentar', 'url' => array(
//                            '/planosalimentares/create')),
                        array('label' => 'Perfil', 'url' => array('/users/alterPass&id='.(!Yii::app()->user->isGuest?Yii::app()->user->userid:'')), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ),
            ),
        )); ?>
<!--        --><?php //echo TbHtml::pills($this->menu); ?>
    </div>
    <!-- mainmenu -->
    <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links' => $this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    <?php endif ?>

    <?php echo $content; ?>


    <div class="clear"></div>

    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by Informática Para a Saúde.<br/>
        All Rights Reserved.<br/>
    </div>
    <!-- footer -->

</div>
<!-- page -->

</body>
</html>
