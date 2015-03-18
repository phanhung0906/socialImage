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
                        <label for="inputEmail3" class="col-sm-2 control-label">By email</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="my-checkbox" data-size="small" checked>
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

<script type="text/javascript">
    $(document).ready(function(){
        $("[name='my-checkbox']").bootstrapSwitch();
        $('body').click(function(e) {
            console.log($("[name='my-checkbox']").val());
        })
    })
</script>