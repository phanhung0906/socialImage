<style type="text/css">
    body{
        background-color: #fff;
    }
</style>

<div class="container register-div">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'user_register',
//            'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
//                'enableClientValidation'=>true,
            ));
            ?>
            <h2>Sign In</h2>
            <hr class="colorgraph">
            <div class="row">
                <div class="form-group">
                    <?php
                        echo CHtml::activeTextField($model, 'username', array('class' => 'form-control input-lg', 'placeholder' => 'Email Address' ));
                        echo $form->error($model, 'username');
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <?php
                        echo CHtml::activePasswordField($model, 'password', array('class' => 'form-control input-lg', 'placeholder' => 'Password' ));
                        echo $form->error($model, 'password');
                    ?>
                </div>
            </div>
            <div class="row">
                <span class="button-checkbox">
                    <?php
                        echo CHtml::activeCheckBox($model, 'rememberme').'&nbsp';
                        echo CHtml::activeLabelEx($model, 'rememberme');
                    ?>

                </span>
                <div class="col-md-12">
                    <?php echo $form->error($model, 'rememberme'); ?>
                </div>
            </div>

            <hr class="colorgraph">
            <div class="row">
                <div class="form-group">
                    <?php echo CHtml::submitButton('Sign In', array('class' => 'btn btn-success btn-block btn-lg')); ?>
                </div>
            </div>
            <div class="row">You dont have account, register <a href="<?php  Yii::app()->baseUrl ?>/site/register">here</a></div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>