<?php
    $baseUrl = Yii::app()->baseUrl;
?>
<div class="container">
    <div class='row'>
        <div class='col-md-8'>
            <h3>Kungfu Hiphop</h3>
         <!--   <p>
                <a href='javascript:void(0)'>
                    <span>
                        <span>13,751</span>
                    </span> like
                </a> ·
                <a href="#comment">
                    <span>461</span> comments</a>
            </p>-->
            <img src="<?php echo $baseUrl ?>/images/750x450.png" alt="detail"/>
            <div class='like-div'>
                <div class='pull-right'>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="I like this picture">
                        <i class="fa fa-thumbs-up fa-2 faa-vertical"></i>
                    </a>
                    <span class='text-info'>13,751</span>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="I don't like this picture">
                        <i class="fa fa-thumbs-down fa-2 faa-vertical"></i>
                    </a>
                    <span class='text-info'>13,751</span>
                </div>
            </div>
            <div class='white-page'>
                <div class="bs-callout bs-callout-info" id="callout-dropdown-positioning">
                    <h4 id="may-require-additional-positioning">May require additional positioning<a class="anchorjs-link" href="#may-require-additional-positioning"><span class="anchorjs-icon"></span></a></h4>
                    <p>Dropdowns are automatically positioned via CSS within the normal flow of the document. This means dropdowns may be cropped by parents with certain <code>overflow</code> properties or appear out of bounds of the viewport. Address these issues on your own as they arise.</p>
                </div>
            </div>

            <div class="white-page">

            </div>
        </div>
        <div class='col-md-4'>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>