
<div class="div-edit-album">
    <h3 class='col-md-6'><?php echo $album->name ?>
        <div><small><?php echo nl2br($album->description) ?></small></div>
        <div><small>Updated about 3 months ago</small></div>
    </h3>
</div>
<div class="clearfix"></div>
<?php if($userId == $userPageId): ?>
    <div class="item">
        <a class="BoardCreateRep add-new-album fileinput-button" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-plus-circle"></i>
            <span><?php echo Yii::t('app', 'Add Photos') ?></span>
        </a>
    </div>
<?php endif; ?>

<div id="basicExample">
<?php foreach($listPhoto as $photo): ?>
    <a href="<?php echo Yii::app()->createUrl('photo/'.$photo->code); ?>">
        <img alt="<?php echo $photo->name ?>" src="<?php echo Yii::app()->createUrl(Constant::PATH_UPLOAD.$photo->url) ?>" />
        <div class="caption"><?php echo $photo->name ?></p></div>
    </a>
<?php endforeach; ?>
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
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                    'enableClientValidation'=>true,
                    'htmlOptions' => array('enctype' => 'multipart/form-data')
                ));
            ?>
            <div class="modal-body">
                <div class="form-group">
                    <input id="inputFile" name="image" type="file">
                </div>
                <div class="form-group">
                    <?php
                        echo CHtml::activeLabelEx($photoUpload, 'name', array('class' => 'control-label'));
                        echo CHtml::activeTextField($photoUpload, 'name', array('class' => 'form-control', 'placeholder' => 'Title' ));
                        echo $form->error($photoUpload, 'name');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                        echo CHtml::activeLabelEx($photoUpload, 'description', array('class' => 'control-label'));
                        echo CHtml::activeTextArea($photoUpload, 'description', array('class' => 'form-control', 'placeholder' => 'Description' ));
                        echo $form->error($photoUpload, 'description');
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
        $("#basicExample").justifiedGallery({
            rowHeight : 170,
            lastRow : 'nojustify',
            margins : 3
        });

        var number = 1;
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() == $(document).height()) {
                $.ajax({
                    dataType: 'json',
                    method: "POST",
                    url: window.location.pathname,
                    data: { number: number++ }
                }).done(function (response) {
                    var numberOfPhoto = response.length;
                        if(numberOfPhoto > 0){
                            for (var i = 0; i < numberOfPhoto; i++) {
                                $('#basicExample').append('<a href="/photo/'+ response[i].code +'">' +
                                    '<img alt="'+ response[i].name +'" src="/images/uploads/'+ response[i].url +'" />'+'</a>' );
                            }
                            $('#basicExample').justifiedGallery('norewind');
                        }
                });
            }
        });

        var _URL = window.URL;
        $('#inputFile').change(function()
        {
            var size = this.files[0].size;
            var ext = $(this).val().split('.').pop().toLowerCase();

            if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                sweetAlert("Oops...", "Invalid extension!", "error");
                return;
            } else if(size > 3*1024*1024) {
                sweetAlert("Oops...", "Max size: 3MB!", "error");
                return;
            } else {
                var file, img, height;
                if ((file = this.files[0])) {
                    img = new Image();
                    img.onload = function () {
    //                    width = this.width;
                        height = this.height;
                        if(height < 170){
                            sweetAlert("Oops...", "Something wrong with the image dimensions!", "error");
                        } else {
//                            $('#inputFile').parents('form').submit();
                        }
                    };
                    img.src = _URL.createObjectURL(file);
                }
            }
        });
    })
</script>