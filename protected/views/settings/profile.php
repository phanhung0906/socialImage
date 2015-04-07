<?php
    $baseUrl = Yii::app()->baseUrl;
?>
<div class="container">
    <?php require_once('partial/menu-left.php'); ?>
    <div class="col-md-9">
        <?php
            $form = $this->beginWidget('CActiveForm', array(
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions'=>array('enctype'=>'multipart/form-data'),
            ));
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Information</h3>
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-10">
                            <?php if($userDetail->image): ?>
                                <img src="<?php echo Yii::app()->createUrl(Constant::PATH_UPLOAD . $userDetail->image)?>" alt="profile" class='profile-image' id="blah"/>
                            <?php else: ?>
                            <img src="<?php echo $baseUrl ?>/images/750x450.png" alt="profile" class='profile-image' id="blah"/>
                            <?php endif; ?>
                            <button class='btn btn-default fileinput-button input'>
                                <?php echo CHtml::activeFileField($userDetail, 'image', array('id' => 'inputFile')) ?>
                                Change image
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo CHtml::activeLabelEx($userDetail, 'description', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-10">
                            <?php
                                echo CHtml::activeTextArea($userDetail, 'description', array('class' => 'form-control', 'placeholder' => 'Description' ));
                                echo $form->error($userDetail, 'description');
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo CHtml::activeLabelEx($userDetail, 'website', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-10">
                            <?php
                                echo CHtml::activeTextField($userDetail, 'website', array('class' => 'form-control', 'placeholder' => 'Website' ));
                                echo $form->error($userDetail, 'website');
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Sex</label>
                        <div class="col-sm-10">
                            <?php echo CHtml::activeRadioButtonList($userDetail,'gender',array('1'=>'Male','2'=>'Female')); ?>
                            <!--<label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Famale
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> Empty
                            </label>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Account</label>
                        <div class="col-sm-10">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                Inactive Account
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="text-right">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <?php
                        echo CHtml::resetButton('Reset', array('class' => 'btn btn-danger'));
                    ?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        var _URL = window.URL;
        $('#inputFile').change(function()
        {
            var self = this;
            var ext = $(this).val().split('.').pop().toLowerCase();

            if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                sweetAlert("Oops...", "Invalid extension!", "error");
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
                            readURL(self);
                        }
                    };
                    img.src = _URL.createObjectURL(file);
                }
            }
        });
    })

</script>