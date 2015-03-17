<?php
    $baseUrl = Yii::app()->baseUrl;
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo $baseUrl ?>/libs/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo $baseUrl ?>/libs/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- style -->
    <link href="<?php echo $baseUrl ?>/libs/css/style-main.css" rel="stylesheet" type="text/css" />
    <!-- bxslider -->
    <link href="<?php echo $baseUrl ?>/libs/css/jquery.bxslider.css" rel="stylesheet" type="text/css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<header class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/site/login">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="/site/contact">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
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
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/site/about">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
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

<!-- jQuery -->
<script src="<?php echo $baseUrl ?>/libs/js/libs/jquery-2.0.2.min.js"></script>
<!-- Bootstrap 3.0.3 -->
<script src="<?php echo $baseUrl ?>/libs/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
<!-- bxslider -->
<script src="<?php echo $baseUrl ?>/libs/js/jquery.bxslider.min.js" type="text/javascript"></script>
</body>
</html>
