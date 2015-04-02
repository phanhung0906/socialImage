<?php
    $baseUrl = Yii::app()->baseUrl;
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $baseUrl ?>/libs/css/images/red.png" />
    <!-- bootstrap 3.0.3 -->
    <link href="<?php echo $baseUrl ?>/libs/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $baseUrl ?>/libs/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo $baseUrl ?>/libs/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $baseUrl ?>/libs/css/font-awesome-animation.min.css" rel="stylesheet" type="text/css" />
    <!-- bxslider -->
    <link href="<?php echo $baseUrl ?>/libs/css/jquery.bxslider.css" rel="stylesheet" type="text/css" />
    <!-- wow css -->
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/libs/css/animate.css">
    <!-- sweet alert -->
    <link href="<?php echo $baseUrl ?>/libs/css/sweet-alert.css" rel="stylesheet" type="text/css" />
    <!-- style -->
    <link href="<?php echo $baseUrl ?>/libs/css/style-main.css" rel="stylesheet" type="text/css" />
    <!-- jQuery -->
    <script src="<?php echo $baseUrl ?>/libs/js/libs/jquery-2.0.2.min.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<header class="navbar navbar-default">
   <?php require_once('partial/header.php'); ?>
</header>

<div id="page">
    <!-- Flash message -->
        <?php if (Yii::app()->user->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissable fade in">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
        <?php elseif (Yii::app()->user->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissable fade in">
                <i class="fa fa-ban"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo Yii::app()->user->getFlash('error'); ?>
            </div>
        <?php endif;?>
    <!-- End Flash message -->

	<?php echo $content; ?>

	<div class="clear"></div>

</div>

<footer>
    <div class='container'>
        <p class="pull-right"><small>Page generated on Sun, 15 Mar 2015 22:10:53 +0000</small></p>
        Powered by <a href="#" rel="external">socialImage</a>
    </div>
</footer>

<!-- Bootstrap 3.0.3 -->
<script src="<?php echo $baseUrl ?>/libs/js/bootstrap/bootstrap.min.js"></script>
<!-- bootstrap switch -->
<script src="<?php echo $baseUrl ?>/libs/js/bootstrap/bootstrap-switch.min.js"></script>
<!-- Wow js -->
<script src="<?php echo $baseUrl ?>/libs/js/wow.min.js"></script>
<!-- bxslider -->
<script src="<?php echo $baseUrl ?>/libs/js/jquery.bxslider.min.js"></script>
<!-- Bootstrap 3.0.3 -->
<script src="<?php echo $baseUrl ?>/libs/js/sweet-alert.min.js"></script>
<script>
    new WOW().init();
</script>
</body>
</html>
