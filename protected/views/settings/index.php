<?php
    $baseUrl = Yii::app()->baseUrl;
?>
<div class="container">
   <?php require_once('partial/menu-left.php'); ?>
    <div class="col-md-9">
        <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'user_register',
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            ));
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">Basic information about account</div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                       <?php  echo CHtml::activeLabelEx($user, 'user_name', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-10">
                            <?php
                                echo CHtml::activeTextField($user, 'user_name', array('class' => 'form-control', 'placeholder' => 'User name' ));
                            ?>
                            <div class="text-info"><?php echo Yii::app()->getBaseUrl(true)."/user/".$user->user_name ?></div>
                            <?php  echo $form->error($user, 'user_name'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php  echo CHtml::activeLabelEx($user, 'email', array('class' => 'col-sm-2 control-label')); ?>
                        <div class="col-sm-10">
                            <?php
                                echo CHtml::activeTextField($user, 'email', array('class' => 'form-control', 'placeholder' => 'Email' ));
                                echo $form->error($user, 'email');
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Language</label>
                        <div class="col-sm-10">
                            <select class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
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
        $("[name='my-checkbox']").bootstrapSwitch();
        $('body').click(function(e) {
            console.log($("[name='my-checkbox']").val());
        })
    })
</script>