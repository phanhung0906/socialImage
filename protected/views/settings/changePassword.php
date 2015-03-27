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
                'enableClientValidation' => true,
            ));
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Notify</h3>
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <?php  echo CHtml::activeLabelEx($user, 'oldPassword', array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php
                                echo CHtml::activePasswordField($user, 'oldPassword', array('class' => 'form-control', 'placeholder' => 'Old Password' ));
                            ?>
                            <?php echo $form->error($user, 'oldPassword'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php  echo CHtml::activeLabelEx($user, 'newPassword', array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php
                                echo CHtml::activePasswordField($user, 'newPassword', array('class' => 'form-control', 'placeholder' => 'New Password' ));
                            ?>
                            <?php echo $form->error($user, 'newPassword'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php  echo CHtml::activeLabelEx($user, 'retypePassword', array('class' => 'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php
                                echo CHtml::activePasswordField($user, 'retypePassword', array('class' => 'form-control', 'placeholder' => 'Re-type New Password' ));
                            ?>
                            <?php echo $form->error($user, 'retypePassword'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="text-right">
                    <?php
                        echo CHtml::resetButton('Reset', array('class' => 'btn btn-danger'));
                    ?>
                    <button class='btn btn-primary'>Update</button>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
