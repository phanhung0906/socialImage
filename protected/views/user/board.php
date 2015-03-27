<style type="text/css">
    .show-image-album{
        cursor: pointer;
        width: 100%;
        height: 250px;
        background: url(<?php echo Yii::app()->createUrl('images/750x450.png') ?>) no-repeat center center;
        background-size: cover;
        overflow: hidden;
    }

    .show-image-album:hover{
        -webkit-animation: animatedBackground 1s ease-out 1;
        -moz-animation: animatedBackground 1s ease-out 1;
        animation: animatedBackground 1s ease-out 1;
        -webkit-animation-fill-mode: forwards;
        animation-fill-mode: forwards;
    }
    @-webkit-keyframes animatedBackground {
        0% {
            -webkit-transform: scale(1, 1);
            -moz-transform: scale(1, 1);
            -ms-transform: scale(1, 1);
            -o-transform: scale(1, 1);
            transform: scale(1, 1)
        }
        100% {
            -webkit-transform: scale(1.1, 1.1);
            -moz-transform: scale(1.1, 1.1);
            -ms-transform: scale(1.1, 1.1);
            -o-transform: scale(1.1, 1.1);
            transform: scale(1.1, 1.1)
        }

    }


    @-moz-keyframes animatedBackground {
        0% {
            -webkit-transform: scale(1, 1);
            -moz-transform: scale(1, 1);
            -ms-transform: scale(1, 1);
            -o-transform: scale(1, 1);
            transform: scale(1, 1)
        }
        100% {
            -webkit-transform: scale(1.1, 1.1);
            -moz-transform: scale(1.1, 1.1);
            -ms-transform: scale(1.1, 1.1);
            -o-transform: scale(1.1, 1.1);
            transform: scale(1.1, 1.1)
        }

    }
    @keyframes animatedBackground {
        0% {
            -webkit-transform: scale(1, 1);
            -moz-transform: scale(1, 1);
            -ms-transform: scale(1, 1);
            -o-transform: scale(1, 1);
            transform: scale(1, 1)
        }
        100% {
            -webkit-transform: scale(1.1, 1.1);
            -moz-transform: scale(1.1, 1.1);
            -ms-transform: scale(1.1, 1.1);
            -o-transform: scale(1.1, 1.1);
            transform: scale(1.1, 1.1)
        }

    }

    .link-photo{
        overflow: hidden;
        height: 250px;
        display: block;
    }
</style>
<div class="white-page">
    <div class='text-center padding-content'>
        <img src="<?php echo Yii::app()->createUrl('images/750x450.png') ?>" alt="..." class="img-circle img-profile">
        <h3>Phan Quốc Hưng</h3>
    </div>
</div>

<div class="container">
    <div class="item">
        <a class="BoardCreateRep add-new-album" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-plus-circle"></i>
            <span><?php echo Yii::t('app', 'New Album') ?></span>
        </a>
    </div>
    <?php foreach($ownAlbum as $al): ?>
        <div class="item BoardCreateRep">
            <a class="link-photo" href="<?php echo Yii::app()->createUrl('user/album/code/'.$al->code) ?>">
            <div class='show-image-album'>

            </div>
            </a>
            <div class='text-primary'><?php echo htmlspecialchars($al->name) ?></div>
            <div class='div-edit-album'><span>25 photos</span></div>
        </div>
    <?php endforeach; ?>
    <div class="clearfix"></div>
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

<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>