
<div class="container white-page padding-content">
    <div class="div-edit-album">
        <a class="btn btn-default edit-album">Edit</a>
        <h3 class='col-md-6'><?php echo $album->name ?>
            <div><small><?php echo nl2br($album->description) ?></small></div>
            <div><small>Updated about 3 months ago</small></div>
        </h3>
    </div>
    <div class="clearfix"></div>
    <div class="item">
        <a class="BoardCreateRep" >
            <i class="fa fa-plus-circle"></i>
            <span><?php echo Yii::t('app', 'Add Photos') ?></span>
        </a>
    </div>
    <?php /*foreach($photos as $photo): */?><!--
    <div class="item">
        <a class="BoardCreateRep" href="<?php /*echo $baseUrl .'/user/album/code/'.$al->code */?>">
        </a>
        <div class='text-primary'><?php /*echo htmlspecialchars($al->name) */?></div>
    </div>
--><?php /*endforeach; */?>

</div>
