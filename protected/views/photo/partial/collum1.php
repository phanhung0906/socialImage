<h3><?php echo $photo->name ?></h3>
<p class='text-info text-uppercase'>By <a href="<?php echo Yii::app()->createUrl('/user/'.$user->user_name) ?>"><?php echo $user->user_name ?></a> - <a href="<?php echo Yii::app()->createUrl('read/delete/id/'.$photo->id) ?>" onclick="return confirm('Are you sure?')">DELETE</a></p>
<!-- Buttons start here. Copy this ul to your document. -->
<?php require_once('socialButton.php'); ?>
<!-- Buttons end here -->
<div class='div-photo-detail' id="colorboxPhoto">
    <a href="<?php echo Yii::app()->createUrl(Constant::PATH_UPLOAD.$photo->url) ?>">
        <img src="<?php echo Yii::app()->createUrl(Constant::PATH_UPLOAD.$photo->url) ?>" alt="detail" class='detail-photo img-responsive'/>
    </a>
</div>
<?php if(Yii::app()->user->isGuest): ?>
    <div class='like-div'>
        <div class='pull-right'>
            <a href="javascript:void(0)" id='guest-like-button' data-placement="bottom" data-content="You need login to continue this action" data-trigger="focus">
                <i class="fa fa-thumbs-up fa-2 faa-vertical"></i>
            </a>
            <span class='text-info'><?php echo $countLike ?></span>
            <a href="javascript:void(0)" data-placement="bottom" data-content="You need login to continue this action" id='guest-dislike-button' data-trigger="focus">
                <i class="fa fa-thumbs-down fa-2 faa-vertical"></i>
            </a>
            <span class='text-info'><?php echo $countDislike ?></span>
        </div>
    </div>
<?php else: ?>
    <div class='like-div'>
        <div class='pull-right'>
            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="I like this picture" id='like-button'>
                <i class="fa fa-thumbs-up fa-2 faa-vertical <?php if($checkLike) echo 'text-info' ?>"></i>
            </a>
            <span class='text-info' id='count-like-photo'><?php echo $countLike ?></span>
            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="I don't like this picture" id='dislike-button'>
                <i class="fa fa-thumbs-down fa-2 faa-vertical <?php if($checkDislike) echo 'text-info' ?>"></i>
            </a>
            <span class='text-info' id='count-dislike-photo'><?php echo $countDislike ?></span>
        </div>
    </div>
<?php endif; ?>

<?php if($photo->description): ?>
    <div class='white-page'>
        <div class="bs-callout bs-callout-info" id="callout-dropdown-positioning">
            <h4 id="may-require-additional-positioning">Description<a class="anchorjs-link" href="#may-require-additional-positioning"><span class="anchorjs-icon"></span></a></h4>
            <p><?php echo $photo->description ?></p>
        </div>
    </div>
<?php endif; ?>
<div class="white-page">
    <?php /*require_once('fb-comments.php') */?>
</div>