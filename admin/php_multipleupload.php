<?php
include "config.php";
include "_db_pdo.php";

?>
<div>
<form method='post' action='upload_image_mul.php' enctype='multipart/form-data'>
 <input type="file" name="file[]" id="file" multiple >
 <p class="heloo">add more files</p>
 <input type="button" name="add" id="ad_images"  class="btn btn-primary" value="add"/>
 <input type='submit' name='submit' id="upload" value='Upload'>
</form>
</div>

<p id="msg"></p>
<script src="javascript/jquery.js"></script>

<script>

$(document).ready(function(){
    var total_img=1;
    var count =0;
            $('#ad_images').on("click",function(){
                total_img++;
                var html ='<div id="images_array_'+total_img+'"><label for="exampleInputPassword1">Post image</label><input type="file" name="file[]" id="file2'+total_img+'" multiple > <input type="button" style="margin-top: 3px; id="remove" name="remove" class="btn btn-danger" onclick=remove_img("'+total_img+'") value="remove" required /></div>';
                $(".heloo").append(html);
                
            });
        });

        // $('#upload').on('click', function (e) {
        //     e.preventDefault();
        // });
        // $('#upload').on('click', function (e) {
        //     e.preventDefault();
		// 	var form_data = new FormData();
		// 	var ins = document.getElementById('file').files.length;
		// 	for (var x = 0; x < ins; x++) {
		// 		form_data.append("file[]", document.getElementById('file').files[x]);
		// 	}

        //     $.ajax({
		// 		url: 'arrayofimg.php', // point to server-side PHP script 
		// 		dataType: 'text', // what to expect back from the PHP script
		// 		cache: false,
		// 		contentType: false,
		// 		processData: false,
		// 		data: form_data,
		// 		type: 'post',
		// 		success: function (response) {
		// 			$('#msg').html(response); // display success response from the PHP script
		// 		},
		// 		error: function (response) {
		// 			$('#msg').html(response); // display error response from the PHP script
		// 		}
		// 	});
		// });

        function remove_img(id){
                // alert('Image removed');
                $('#images_array_'+id).remove();
            }

</script>

