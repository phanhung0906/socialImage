<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                        'htmlOptions'=>array(
                            'class'=>'form-horizontal',
                        ),
                    ));
                ?>
                    <fieldset>
                        <legend class="text-center header">Contact us</legend>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <?php
                                    echo CHtml::activeTextField($model, 'name', array('class' => 'form-control', 'placeholder' => 'Name' ));
                                    echo $form->error($model, 'name');
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                            <div class="col-md-8">
                                <?php
                                    echo CHtml::activeTextField($model, 'email', array('class' => 'form-control', 'placeholder' => 'Email Address' ));
                                    echo $form->error($model, 'email');
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                                <?php
                                    echo CHtml::activeTextField($model, 'phone', array('class' => 'form-control', 'placeholder' => 'Phone' ));
                                    echo $form->error($model, 'phone');
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-home bigicon"></i></span>
                            <div class="col-md-8">
                                <?php
                                    echo CHtml::activeTextField($model, 'address', array('class' => 'form-control', 'placeholder' => 'Address' ));
                                    echo $form->error($model, 'address');
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
                                <?php
                                    echo CHtml::activeTextArea($model, 'content', array('class' => 'form-control', 'placeholder' => 'Enter your massage for us here. We will get back to you within 2 business days.' ));
                                    echo $form->error($model, 'content');
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>

<style>
    .header {
        color: #36A0FF;
        font-size: 27px;
        padding: 10px;
    }

    .bigicon {
        font-size: 35px;
        color: #36A0FF;
    }
</style>