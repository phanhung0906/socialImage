
    <div class="div-edit-album">
        <h3 class='col-md-6'><?php echo $album->name ?>
            <div><small><?php echo nl2br($album->description) ?></small></div>
            <div><small>Updated about 3 months ago</small></div>
        </h3>
    </div>
    <div class="clearfix"></div>
    <?php if($userId == $userPageId): ?>
    <div class="item">
        <form method='post' enctype="multipart/form-data">
            <a class="BoardCreateRep add-new-album fileinput-button">
                <input id="inputFile" name="image" type="file">
                <i class="fa fa-plus-circle"></i>
                <span><?php echo Yii::t('app', 'Add Photos') ?></span>
            </a>
        </form>
    </div>
    <?php endif; ?>

   <!-- <?php /*foreach($listPhoto as $photo): */?>
        <div class="item BoardCreateRep">
            <a class="link-photo" href="<?php /*echo Yii::app()->createUrl('photo/'.$photo->code); */?>">
                <div class='show-image-album' style="background: url(<?php /*echo Yii::app()->createUrl(Constant::PATH_UPLOAD.$photo->url) */?>) no-repeat center center;background-size: cover;">

                </div>
            </a>
            <div class='text-primary'></div>
        </div>
    --><?php /*endforeach; */?>

    <div id="basicExample">
    <?php foreach($listPhoto as $photo): ?>

        <a href="<?php echo Yii::app()->createUrl('photo/'.$photo->code); ?>">
            <img alt="<?php echo $photo->name ?>" src="<?php echo Yii::app()->createUrl(Constant::PATH_UPLOAD.$photo->url) ?>" />
            <div class="caption">like 1 <p>comment 20</p></div>
        </a>

    <?php endforeach; ?>
    </div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#basicExample").justifiedGallery({
            rowHeight : 170,
            lastRow : 'nojustify',
            margins : 3
        });
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() == $(document).height()) {
               /* for (var i = 0; i < 5; i++) {
                    $('#basicExample').append('<a>' +
                        '<img src="/images/750x450.png" />' +
                        '</a>');
                }
                $('#basicExample').justifiedGallery('norewind');*/
            }
        });

        var _URL = window.URL;
        $('#inputFile').change(function()
        {
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
                            $('#inputFile').parents('form').submit();
                        }
                    };
                    img.src = _URL.createObjectURL(file);
                }
            }
        });
    })

</script>