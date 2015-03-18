<?php
    $baseUrl = Yii::app()->baseUrl;
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

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
    <!-- style -->
    <link href="<?php echo $baseUrl ?>/libs/css/style-main.css" rel="stylesheet" type="text/css" />
    <!-- jQuery -->
    <script src="<?php echo $baseUrl ?>/libs/js/libs/jquery-2.0.2.min.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<header class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand wow swing" href="/"><?php echo Yii::t('app','SocialImage') ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/site/login"><?php echo Yii::t('app','Home') ?></a></li>
                <li><a href="/site/contact"><?php echo Yii::t('app','Contact') ?></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Yii::t('app','Action') ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/site/page">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" id="search-index-page">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </form>
            <button type="button" class="btn btn-default navbar-btn"><?php echo Yii::t('app','Upload') ?></button>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $baseUrl ?>/user"><?php echo Yii::t('app','My page') ?></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id='image-user-bar-a-tag'><img id='image-user-bar' src="<?php echo $baseUrl ?>/images/750x450.png" alt="Account"/></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $baseUrl ?>/settings"><?php echo Yii::t('app','Settings') ?></a></li>
                        <li class="divider"></li>
                        <li class="disabled"><a href="#"><?php echo Yii::t('app','Language') ?></a></li>
                        <li><a href="#"><?php echo Yii::t('app','English') ?></a></li>
                        <li><a href="#"><?php echo Yii::t('app','Vietnamese') ?></a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="fa fa-power-off"></i> <?php echo Yii::t('app','Logout') ?></a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
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
<script>
    new WOW().init();
</script>
</body>
</html>
