<?php
    $baseUrl = Yii::app()->baseUrl;
?>
<style type="text/css">

</style>
<link rel="stylesheet" href="<?php echo $baseUrl ?>/libs/css/style-timeline.css"> <!-- Resource style -->
<link rel="stylesheet" href="<?php echo $baseUrl ?>/libs/css/reset-timeline.css"> <!-- CSS reset -->
<script src="<?php echo $baseUrl ?>/libs/js/modernizr-timeline.js"></script> <!-- Modernizr -->

<div class="white-page">
    <div class='text-center padding-content'>
        <?php if($userPageDetail->image): ?>
            <img src="<?php echo Yii::app()->createUrl(Constant::PATH_UPLOAD . $userPageDetail->image) ?>" alt="Account" class="img-circle img-profile"/>
        <?php else: ?>
            <img src="<?php echo Yii::app()->createUrl(Constant::PATH_NO_IMAGE) ?>" alt="Account" class="img-circle img-profile"/>
        <?php endif; ?>
        <h2><?php echo $model->user_name ?></h2>
    </div>
</div>
<div class="container width-85">
<div class="row">
    <div class="col-md-4">
        <?php if($userId == $userPageId): ?>
            <div class="item">
                <a class="BoardCreateRep add-new-album" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-plus-circle"></i>
                    <span><?php echo Yii::t('app', 'New Album') ?></span>
                </a>
            </div>
        <?php endif; ?>
        <?php foreach($ownAlbum as $al): ?>
            <div class="item BoardCreateRep">
                <a class="link-photo" href="<?php echo Yii::app()->createUrl('album/'.$al->code) ?>">
                <div class='show-image-album' style=" background: url(
                <?php
                    if(Photo::getImage($al->id))
                        echo Yii::app()->createUrl(Constant::PATH_UPLOAD . Photo::getImage($al->id));
                    else
                        echo Yii::app()->createUrl('images/750x450.png');
                ?>
                    ) no-repeat center center; background-size: cover;">

                </div>
                </a>
                <div class='text-primary'><?php echo htmlspecialchars($al->name) ?></div>
                <div class='div-edit-album'><span><?php echo Photo::countPhoto($al->id) ?> photos</span></div>
            </div>
        <?php endforeach; ?>
        <div class="clearfix"></div>
    </div>
    <div class="col-md-8">
        <section id="cd-timeline" class="cd-container">
            <?php if(count($timeline) > 0): ?>
                <?php foreach($timeline as $dataTimline): ?>
            <div class="cd-timeline-block">
                <div class="cd-timeline-img cd-picture">
                    <img src="<?php echo $baseUrl ?>/libs/css/images/timeline/cd-icon-picture.svg" alt="Picture">
                </div> <!-- cd-timeline-img -->

                <div class="cd-timeline-content">
                    <h2><?php $dataTimline->name ?></h2>
                    <img class='img-responsive' src="<?php echo Yii::app()->createUrl(Constant::PATH_UPLOAD . $dataTimline->url) ?>"/>
                    <p><?php $dataTimline->description ?></p>
                    <a href="<?php echo Yii::app()->createUrl('photo/'.$dataTimline->code) ?>" class="cd-read-more"><?php echo Yii::t('app', 'Detail') ?></a>
                    <span class="cd-date"><?php echo $dataTimline->created ?></span>
                </div> <!-- cd-timeline-content -->
            </div> <!-- cd-timeline-block -->
                    <?php endforeach ?>
            <?php endif; ?>
        </section> <!-- cd-timeline -->
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Create Album</h4>
            </div>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'user_register',
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'enableClientValidation'=>true,
            ));
            ?>
            <div class="modal-body">
                <div class="form-group">
                    <?php
                        echo CHtml::activeLabelEx($album, 'name', array('class' => 'control-label'));
                        echo CHtml::activeTextField($album, 'name', array('class' => 'form-control', 'placeholder' => 'Album Name' ));
                        echo $form->error($album, 'name');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                        echo CHtml::activeLabelEx($album, 'description', array('class' => 'control-label'));
                        echo CHtml::activeTextArea($album, 'description', array('class' => 'form-control', 'placeholder' => 'Description' ));
                        echo $form->error($album, 'description');
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('app', 'Close') ?></button>
                <button type="submit" class="btn btn-primary"><?php echo Yii::t('app', 'Save') ?></button>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<script src="<?php echo $baseUrl ?>/libs/js/main-timeline.js"></script> <!-- Resource jQuery -->
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>