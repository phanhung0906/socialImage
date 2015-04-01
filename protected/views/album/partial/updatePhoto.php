
    <div class="div-edit-album">
        <h3 class='col-md-6'><?php echo $album->name ?>
            <div><small><?php echo nl2br($album->description) ?></small></div>
            <div><small>Updated about 3 months ago</small></div>
        </h3>
    </div>
    <div class="clearfix"></div>

    <form action="/file-upload" class="dropzone">
        <div class="fallback">
            <input name="file" type="file" multiple />
        </div>
    </form>

<script type="text/javascript">
    $(document).ready(function(){
         var Dropzone = require("dropzone");
        // "myAwesomeDropzone" is the camelized version of the HTML element's ID
        Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                }
                else { done(); }
            }
        };

        // Prevent Dropzone from auto discovering this element:
        Dropzone.options.myAwesomeDropzone = false;
// This is useful when you want to create the
// Dropzone programmatically later

// Disable auto discover for all elements:
        Dropzone.autoDiscover = false;
        myDropzone.on("complete", function(file) {
            myDropzone.removeFile(file);
        });
    })

</script>