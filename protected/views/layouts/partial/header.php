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
        <?php  if (!Yii::app()->user->isGuest): ?>
            <button type="button" class="btn btn-default navbar-btn"><?php echo Yii::t('app','Upload') ?></button>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $baseUrl .'/user/'. $this->userName ?>"><?php echo Yii::t('app','My page') ?></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id='image-user-bar-a-tag'><img id='image-user-bar' src="<?php echo $baseUrl ?>/images/750x450.png" alt="Account"/></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $baseUrl ?>/settings"><?php echo Yii::t('app','Settings') ?></a></li>
                        <li class="divider"></li>
                        <li class="disabled"><a href="#"><?php echo Yii::t('app','Language') ?></a></li>
                        <li><a href="#"><?php echo Yii::t('app','English') ?></a></li>
                        <li><a href="#"><?php echo Yii::t('app','Vietnamese') ?></a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo $baseUrl ?>/site/logout"><i class="fa fa-power-off"></i> <?php echo Yii::t('app','Logout') ?></a></li>
                    </ul>
                </li>
            </ul>
        <?php else: ?>
        <ul class="nav navbar-nav navbar-right">
            <a href='<?php echo $baseUrl ?>/site/register' class="btn btn-primary navbar-btn"><?php echo Yii::t('app','Sign up') ?></a>
            <a href='<?php echo $baseUrl ?>/site/login' class="btn btn-success navbar-btn"><?php echo Yii::t('app','Sign in') ?></a>
        </ul>
        <?php endif; ?>
    </div>
</div>