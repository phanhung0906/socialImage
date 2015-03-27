<style type="text/css">
    .fileinput-button {
        position: relative;
        overflow: hidden;
    }
    .fileinput-button input {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        opacity: 0;
        font-size: 200px;
        cursor: pointer;
</style>
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
        <a class="BoardCreateRep add-new-album" data-toggle="modal" data-target="#myModal">
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Photo</h4>
            </div>
            <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                    'enableClientValidation'=>true,
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
            ?>
            <div class="modal-body">
                <div class="form-group">
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Add files...</span>
                        <input id="inputFile" name="Photo[url]" type="file">
                        <?php
//                            echo CHtml::activeFileField($photo, 'url', array('id'=>'inputFile'));
//                            echo $form->error($photo, 'url');
                        ?>
                    </span>
                    <img id="image_upload_preview" src="" alt="your image" width="100px" height="100px"/>
                </div>
                <div class="form-group">
                    <?php
                        echo CHtml::activeLabelEx($photo, 'name', array('class' => 'control-label'));
                        echo CHtml::activeTextField($photo, 'name', array('class' => 'form-control', 'placeholder' => 'Photo Name' ));
                        echo $form->error($photo, 'name');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                        echo CHtml::activeLabelEx($photo, 'description', array('class' => 'control-label'));
                        echo CHtml::activeTextArea($photo, 'description', array('class' => 'form-control', 'placeholder' => 'Description' ));
                        echo $form->error($photo, 'description');
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
    $(document).ready(function(){
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image_upload_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#inputFile").change(function () {
            console.log(this);
            readURL(this);
        });
    })

</script>