
    <div class="div-edit-album">
        <h3 class='col-md-6'><?php echo $album->name ?>
            <div><small><?php echo nl2br($album->description) ?></small></div>
            <div><small>Updated about 3 months ago</small></div>
        </h3>
    </div>
    <div class="clearfix"></div>
    <?php if($userId == $userPageId): ?>
    <div class="item">
        <form method='post' enctype="multipart/form-data">
            <a class="BoardCreateRep add-new-album fileinput-button">
                <input id="inputFile" name="image" type="file">
                <i class="fa fa-plus-circle"></i>
                <span><?php echo Yii::t('app', 'Add Photos') ?></span>
            </a>
        </form>
    </div>
    <?php endif; ?>

    <?php foreach($listPhoto as $photo): ?>
        <div class="item BoardCreateRep">
            <a class="link-photo" href="<?php echo Yii::app()->createUrl('photo/'.$photo->code); ?>">
                <div class='show-image-album' style="background: url(<?php echo Yii::app()->createUrl(Constant::PATH_UPLOAD.$photo->url) ?>) no-repeat center center;background-size: cover;">

                </div>
            </a>
            <div class='text-primary'></div>
            <div class='div-edit-album'><span>25 photos</span></div>
        </div>
    <?php endforeach; ?>


<!-- Modal -->
<!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Photo</h4>
            </div>
            <?php
/*                $form = $this->beginWidget('CActiveForm', array(
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                    'enableClientValidation'=>true,
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
            */?>
            <div class="modal-body">
                <div class="form-group">
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Add files...</span>
                        <input id="inputFile" name="Photo[url]" type="file">
                        <?php
/*//                            echo CHtml::activeFileField($photo, 'url', array('id'=>'inputFile'));
//                            echo $form->error($photo, 'url');
                        */?>
                    </span>
                    <img id="image_upload_preview" src="" alt="your image" width="100px" height="100px"/>
                </div>
                <div class="form-group">
                    <?php
/*                        echo CHtml::activeLabelEx($photo, 'name', array('class' => 'control-label'));
                        echo CHtml::activeTextField($photo, 'name', array('class' => 'form-control', 'placeholder' => 'Photo Name' ));
                        echo $form->error($photo, 'name');
                    */?>
                </div>
                <div class="form-group">
                    <?php
/*                        echo CHtml::activeLabelEx($photo, 'description', array('class' => 'control-label'));
                        echo CHtml::activeTextArea($photo, 'description', array('class' => 'form-control', 'placeholder' => 'Description' ));
                        echo $form->error($photo, 'description');
                    */?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php /*echo Yii::t('app', 'Close') */?></button>
                <button type="submit" class="btn btn-primary"><?php /*echo Yii::t('app', 'Save') */?></button>
            </div>
            <?php /*$this->endWidget(); */?>

        </div>
    </div>
</div>-->
<script type="text/javascript">
    $(document).ready(function(){
        $('#inputFile').change(function()
        {
            var ext = $(this).val().split('.').pop().toLowerCase();

            if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                sweetAlert("Oops...", "Invalid extension!", "error");
            } else {
                $(this).parents('form').submit();
            }
        });
    })

</script>