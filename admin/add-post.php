<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <form action="save-post.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select name="category" class="form-control">
                            <?php
                                include "config.php";
                                include "_db_pdo.php";

                                $obj =new database();

                                $obj->select("category", "*",null,null,null,null,null,null);
                                    $result =$obj->getResult();
                                    if(!empty($result))
                                    {
                                        foreach ($result as list("category_id"=>$id, "category_name"=>$cname,"post"=>$post)) 
                                        {
                                            echo"<option value ='$id'>{$cname}</option>";
                                        }
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group" id="img_box">
                        <div id="images_array">
                            <label for="exampleInputPassword1">Post image</label>
                            <input type="file" name="fileToUpload" required>
                        </div>
                    </div>
                    <div>
                            <p class="heloo">add more files</p>
                            <input type="button" name="add" id="ad_images" class="btn btn-primary" value="add" />
                           
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="save" required />
                </form>
                <!--/Form -->
            </div>
            <div id="gallery"></div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
<script src="javascript/jquery.js"></script>
<script type="text/javascript">
var total_img = 1;
$(document).ready(function() {
    $('#ad_images').on("click", function() {
        total_img++;
        var html = '<div id="images_array_' + total_img +
            '"><label for="exampleInputPassword1">Post image</label><input type="file" name="file[]" required> <input type="button" style="margin-top: 3px; id="remove" name="remove" class="btn btn-danger" onclick=remove_img("' +
            total_img + '") value="remove" required /></div>';
        $('#img_box').append(html);

        
    });



});

function remove_img(id) {
    // alert('Image removed');
    $('#images_array_' + id).remove();
}
</script>