
<div class="container">

    <div class='row'>
        <div class='col-md-8'>
            <?php require_once('partial/collum1.php') ?>
        </div>
        <div class='col-md-4 padding-20'>
            <?php require_once('partial/collum2.php') ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('#guest-like-button').popover();
        $('#guest-dislike-button').popover();

        <?php if($userId): ?>
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
        <?php endif; ?>

        $('#colorboxPhoto').find('a').colorbox({
            maxWidth : '100%',
            maxHeight : '100%',
            opacity : 0.8,
            transition : 'elastic',
            current : ''
        });

    })
</script>