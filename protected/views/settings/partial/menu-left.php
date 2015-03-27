
<div class="col-md-3">
    <div class="list-group">
        <a href="<?php echo  $baseUrl ?>/settings" class="list-group-item <?php echo Common::checkActive('settings','index');?>">Account</a>
        <a href="<?php echo  $baseUrl ?>/settings/changePassword" class="list-group-item <?php echo Common::checkActive('settings','changePassword');?>">Change Password</a>
        <a href="<?php echo  $baseUrl ?>/settings/notify" class="list-group-item <?php echo Common::checkActive('settings','notify');?>">Notify</a>
        <a href="<?php echo  $baseUrl ?>/settings/profile" class="list-group-item <?php echo Common::checkActive('settings','profile');?>">Profile</a>
        <a href="#" class="list-group-item">Apply</a>
    </div>
</div>