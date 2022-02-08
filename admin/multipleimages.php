<head>
    <link rel="stylesheet" href="../css/dropzone.css" />
</head>

<div class="form-group" id="content">
    <form class="dropzone" id="imgupload" method="post">

    <button id="upload_btn">Upload</button>


          </form>
    <!--/Form -->
</div>
<div id="gallery">

</div>
<script src="javascript/jquery.js"></script>
<script src="javascript/dropzone.js"></script>
<script>
    Dropzone.autoDiscover =false;
    var myDropezone =new Dropzone("#imgupload",{
        url: "arrayofimg.php",
        parallelUploads: 3,
        uploadMultiple: true,
        acceptedFiles: '.png,.jpg,.jpeg',
        autoProcessQueue : false,
        success : function(file,response){
            if(response == 'true'){
                $('#content .message').hide();
                $('#content').append('<div class="message">Images Uploaded </div>');
            }else{
                
                $('#content').append('<div class="message">Images notUploaded </div>');
            }
        }
        });


        $("#upload_btn").click(function(){
            myDropezone.processQueue();
        });

</script>

<script type="text/javascript">
    var total_img = 1;
    $(document).ready(function() {
        $('#ad_images').on("click", function() {
            total_img++;
            var html = '<div id="images_array_' + total_img + '"><label for="exampleInputPassword1">Post image</label><input type="file" id="files" name="post_images[]" multiple required> <input type="button" style="margin-top: 3px; id="remove" name="remove" class="btn btn-danger" onclick=remove_img("' + total_img + '") value="remove" required /></div>';
            $('#img_box').after(html);

        });



    });

    // $('#upload_btn').click(function(e) {
    //     e.preventDefault();
    //     var form_data = new FormData();
    //     var totalFiles = document.getElementById('files').files.length;
    //     for (var index = 0; index < totalFiles; index++) {
    //         form_data.append('files[]', document.getElementById('files').files[index]);
    //     }
    //     $.ajax({
    //         url: "arrayofimg.php",
    //         type: "POST",
    //         data: form_data,
    //         dataType: 'json',
    //         contentType: false,
    //         processData: false,
    //         success: function(data, response) {

    //             if (response == 'true') {
    //                 $('#gallery .message').hide();
    //                 $('#gallery').append('<div class="message"><p>Images Uploaded successfully</p></div>');
    //             } else {
    //                 $('#gallery .message').hide();
    //                 $('#gallery').append('<div class="message"><p>Images cant Uploaded</p></div>');
    //             }
    //         }
    //     });
    // })

    // function remove_img(id) {
    //     // alert('Image removed');
    //     $('#images_array_' + id).remove();
    // }
</script>