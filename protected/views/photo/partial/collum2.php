<style type="text/css">
    .div-photo-featured li{
        list-style: none;
        margin-bottom: 20px;
    }
    .info-container a{
        color: #000000;
    }
    .info-container a:hover{
        color: #0087F7;
    }
</style>
<h4><?php echo Yii::t('app', 'Featured') ?></h4>
<div class='div-photo-featured'>
    <?php foreach($feature as $v):?>
    <li>
        <a href="<?php echo Yii::app()->createUrl('photo/'.$v->code) ?>">
            <!--<img src="<?php /*echo Yii::app()->createUrl(Constant::PATH_UPLOAD.$photo->url) */?>" alt="detail" class='detail-photo img-responsive'/>-->
            <div class="show-image-featured" style=" background: url('<?php echo Yii::app()->createUrl(Constant::PATH_UPLOAD.$v->url) ?>') no-repeat center center; background-size: cover;">

            </div>
        </a>
        <div class="info-container"><h4><a href="#"><?php echo $v->name ?></a></h4></div>
    </li>
    <?php endforeach; ?>
</div>