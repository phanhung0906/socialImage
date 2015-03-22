<?php
    $baseUrl = Yii::app()->baseUrl;
?>
<div class="container">
    <?php require_once('partial/menu-left.php'); ?>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Notify</h3>
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Old Password</label>
                        <div class="col-sm-9">
                            <input class="form-control" placeholder="Old Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">New Password</label>
                        <div class="col-sm-9">
                            <input class="form-control" placeholder="New Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Re-type New Password</label>
                        <div class="col-sm-9">
                            <input class="form-control" placeholder="Re-type New Password">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="text-right">
                    <button class='btn btn-danger'>Cancel</button>
                    <button class='btn btn-primary'>Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
