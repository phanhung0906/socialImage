
<div class="container">
    <div class='row'>
        <div class='col-md-8'>
            <h3><?php echo $photo->name ?></h3>
            <p class='text-info'>By <a href="<?php echo Yii::app()->createUrl('/user/'.$user->user_name) ?>"><?php echo $user->user_name ?></a></p>
            <div class='div-photo-detail'>
            <img src="<?php echo Yii::app()->createUrl(Constant::PATH_UPLOAD.$photo->url) ?>" alt="detail" class='detail-photo img-responsive'/>
            </div>
            <?php if(Yii::app()->user->isGuest): ?>
                <div class='like-div'>
                    <div class='pull-right'>
                        <a href="javascript:void(0)" id='guest-like-button' data-placement="bottom" data-content="You need login to continue this action" data-trigger="focus">
                            <i class="fa fa-thumbs-up fa-2 faa-vertical"></i>
                        </a>
                        <span class='text-info'><?php echo $countLike ?></span>
                        <a href="javascript:void(0)" data-placement="bottom" data-content="You need login to continue this action" id='guest-dislike-button' data-trigger="focus">
                            <i class="fa fa-thumbs-down fa-2 faa-vertical"></i>
                        </a>
                        <span class='text-info'><?php echo $countDislike ?></span>
                    </div>
                </div>
            <?php else: ?>
                <div class='like-div'>
                    <div class='pull-right'>
                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="I like this picture" id='like-button'>
                            <i class="fa fa-thumbs-up fa-2 faa-vertical <?php if($checkLike) echo 'text-info' ?>"></i>
                        </a>
                        <span class='text-info' id='count-like-photo'><?php echo $countLike ?></span>
                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="I don't like this picture" id='dislike-button'>
                            <i class="fa fa-thumbs-down fa-2 faa-vertical <?php if($checkDislike) echo 'text-info' ?>"></i>
                        </a>
                        <span class='text-info' id='count-dislike-photo'><?php echo $countDislike ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($photo->description): ?>
                <div class='white-page'>
                    <div class="bs-callout bs-callout-info" id="callout-dropdown-positioning">
                        <h4 id="may-require-additional-positioning">Description<a class="anchorjs-link" href="#may-require-additional-positioning"><span class="anchorjs-icon"></span></a></h4>
                        <p><?php echo $photo->description ?></p>
                    </div>
                </div>
            <?php endif; ?>
            <div class="white-page">

            </div>
        </div>
        <div class='col-md-4'>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('#guest-like-button').popover();
        $('#guest-dislike-button').popover();

        $('#like-button').click(function () {
            var self = $(this);
            $.ajax({
                method: "POST",
                url: window.location.pathname,
                data: { userLikeId: <?php echo $userId ?> }
            }).done(function (response) {
                    if (response == <?php echo Constant::LIKE_SAVE_SUCCESS ?>) {
                        self.find('i').addClass('text-info');
                        var countLike = parseInt($('#count-like-photo').html());
                        $('#count-like-photo').html(++countLike);
                    } else if (response == <?php echo Constant::LIKE_EXIST ?>) {
                        self.find('i').removeClass('text-info');
                        var countLike = parseInt($('#count-like-photo').html());
                        $('#count-like-photo').html(--countLike);
                    } else {
                        sweetAlert("Oops...", "Sorry! System have error", "error");
                    }
                });
        })

        $('#dislike-button').click(function () {
            var self = $(this);
            $.ajax({
                method: "POST",
                url: window.location.pathname,
                data: { userDislikeId: <?php echo $userId ?> }
            }).done(function (response) {
                    if (response == <?php echo Constant::LIKE_SAVE_SUCCESS ?>) {
                        self.find('i').addClass('text-info');
                        var countLike = parseInt($('#count-dislike-photo').html());
                        $('#count-dislike-photo').html(++countLike);
                    } else if (response == <?php echo Constant::LIKE_EXIST ?>) {
                        self.find('i').removeClass('text-info');
                        var countLike = parseInt($('#count-dislike-photo').html());
                        $('#count-dislike-photo').html(--countLike);
                    } else {
                        sweetAlert("Oops...", "Sorry! System have error", "error");
                    }
                });
        })

    })
</script>