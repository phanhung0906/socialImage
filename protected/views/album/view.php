
<div class="container white-page padding-content">
    <?php echo CHtml::link('Album',array(Yii::app()->createUrl('user/'.$userPageInfo->user_name)), array('class'=>'btn btn-primary')) ?>
    <?php if($step == 1): ?>
        <?php require_once('partial/showAlbum.php'); ?>
    <?php else : ?>
        <?php require_once('partial/updatePhoto.php'); ?>
<?php endif; ?>
</div>