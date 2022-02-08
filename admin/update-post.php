<?php include "header.php";
if ($_SESSION["user_role"] == '0') {

    include "config.php";
    include "_db_pdo.php";
    $obj = new database();
    $post_id = $_GET['postid'];

    $obj->select('post', 'author', null, null, " post_id={$post_id}");

    // $sql_2 = "SELECT author FROM post WHERE post_id={$post_id}";

    $result_2 = $obj2->getResult();
    foreach ($result_2 as list("post_id " => $postid, "author" => $authorname)) {
        $row_2 = $authorname;
    }
    if ($row_2 != $_SESSION["user_id"]) {
        header("Location: {$hostname}/admin/post.php");
    }
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form for show edit-->

                <?php
                include "config.php";
                include "_db_pdo.php";
                $obj = new database();
                $post_id = $_GET['postid'];

                // $sql = "SELECT post.post_id, post.title, post.description, post.post_img, post.category, category.category_name  FROM post LEFT JOIN category ON post.category =category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post.post_id={$post_id}";
                $obj->select(
                    'post',
                    " post.post_id, post.title, post.description, post.post_img, post.category, post.post_date, category.category_name, user.username ",
                    " category ON post.category = category.category_id ",
                    " user ON post.author = user.user_id ",
                    " post.post_id={$post_id} ",
                    null,
                    null,
                    null,
                );

                $result = $obj->getResult();
                if (!empty($result)) {
                    // while ($row = mysqli_fetch_assoc($result))
                    foreach ($result as list("post_id" => $pid, "title" => $title, "description" => $desc, "post_img" => $p_img, "category" => $pcategory, "post_date" => $pdate, "category_name" => $cname, "username" => $username)) {
                ?>
                        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="post_id" class="form-control" value="<?php echo $pid; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTile">Title</label>
                                <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $title; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Description</label>
                                <textarea name="postdesc" class="form-control" required rows="5">
                <?php echo $desc; ?>
                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCategory">Category</label>
                                <select class="form-control" name="category">
                                    <option disabled>Select Category</option>
                                    <?php
                                    include "config.php";
                                    // include "_db_pdo.php";
                                    // $sql1 = "SELECT * FROM category ";
                                    $obj->select('category', '*', null, null, null, null, null, null);
                                    $result1 = $obj->getResult();
                                    if (!empty($result1)) {
                                        // while ($row1 = mysqli_fetch_assoc($result1)) 
                                        foreach ($result1 as list("category_id" => $cid, "category_name" => $cname, "post" => $post)) {
                                            if ($pcategory == $cid) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo "<option {$selected} value ='{$cid}'>$cname</option>";
                                        }
                                    }

                                    ?>

                                </select>
                                <input type="hidden" name='old_category' value='<?php echo $pcategory ?>'>

                            </div>
                            <div class="form-group">
                                <label for="">Post image</label>
                                <input type="file" name="new-image">
                                <?php echo $p_img; ?>
                                <img src="upload/<?php echo $p_img; ?>" height="150px">
                                <input type="hidden" name="old-image" value="<?php echo $p_img; ?>">
                            </div>
                            <?php
                            $post_id2 =$_GET['postid'];
                            $obj_1 =new database();
                            $obj_1->select('mul_img', "*", null, null, "post_id = $post_id2 ", null, null, null);
                            $result = $obj_1->getResult();
                            foreach ($result as $row) {
                            ?>
                               
                                    <div class="form-group" id="img_box">
                                        <div>
                                            <label for="">Post image</label>
                                            <input type="file" id="file" name="file[]" multiple>
                                            <img src="array_img/<?php echo $row['post_image']; ?>" class="ad_images<?php echo $row['i_id']; ?>" height="150px">
                                            <input type="hidden" name="post_id_img" value="<?php echo $_GET['postid']; ?>">
                                            <input type="hidden" name="p_images_id[]" value="<?php echo $row['i_id']; ?>">
                                            <button type="button" style="margin-top: 3px;" id="remove" name="remove" class="btn btn-danger" onclick=remove_img(<?php echo $row['i_id']; ?>) value="Remove"><a href="updateMulimg.php?pid=<?php echo $row['i_id']; ?>">Remove</a></button>
                                            <input type="hidden" name="old-image" value="<?php echo $row['i_id']; ?>">
                                        </div>
                                    </div>
                                <?php
                            }
                                ?>
                               <div>
                            <!-- <input type="file" name="file[]" id="file" multiple> -->
                            <p class="heloo">add more files</p>
                            <input type="button" name="add" id="ad_images" class="btn btn-primary" value="add" />
                           
                    </div>
                                <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                        </form>
                <?php
                    }
                } else {
                    echo "Result Not found";
                }

                ?>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div><div >
  <p id="true"></p>
</div>
<script src="javascript/jquery.js"></script>
<script>
    $(document).ready(function() {
        var total_img=1;
   
    $('#ad_images').on("click", function() {
        total_img++;
        var html = '<div id="images_array_' + total_img +
            '"><label for="exampleInputPassword1">Post image</label><input type="file" name="file[]" required> <input type="button" style="margin-top: 3px; id="remove" name="remove" class="btn btn-danger" onclick=remove_img("' +
            total_img + '") value="remove" required /></div>';
        $('.heloo').append(html);
    });



});
    function remove_img(id){
        $.ajax({
            url:"updateMulimg.php",
            type : "POST",
            data : {id:id},
            success: function(data,response){
                if(response =="true"){
                  $("#true").html("File Updated"+data);
                }else{
                  $("#true").html("File NotUpdated"+data);
                }
              }
        })
           
        
                $('.ad_images'+id).remove();
            }
</script>
<?php include "footer.php"; ?>