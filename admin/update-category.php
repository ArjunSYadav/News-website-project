<?php include "header.php"; 

if($_SESSION["user_role"] =='0'){
    header("Location: {$hostname}/admin/post.php");
}

if(isset($_POST['sumbit']))
{
    include "config.php";

    include "_db_pdo.php";
    $obj =new database();

    $category_id =mysqli_real_escape_string($conn,$_POST['cat_id']);
    $category_name =mysqli_real_escape_string($conn,$_POST['cat_name']);
    
    

    // $sql = "UPDATE `category` SET `category_name` = '{$category_name}' WHERE `category`.`category_id` = {$category_id}";
       $obj->update('category',['category_name'=>$category_name],"`category`.`category_id` = {$category_id}");
        $result=$obj->getResult();
         if(!empty($result))
        {
            header("Location:{$hostname}/admin/category.php");
        }

}


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
              <?php
                include "config.php";
                include "_db_pdo.php";
                
                    $obj1 =new database();
                    $cat_id=$_GET['catid'];

                //  $sql = "SELECT * FROM category WHERE `category_id` = {$cat_id} ";
                $obj1->select("category","*",null,null,"category_id = {$cat_id}",null,null,null);
                $result_1=$obj1->getResult();
                // $result =mysqli_query($conn, $sql) or die ("Querry Faild");
                if(!empty($result_1))
                {
                //  while($row = mysqli_fetch_assoc($result))
                foreach ($result_1 as list("category_id"=>$id, "category_name"=>$cname))
                 {

                 
                ?>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $id; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $cname; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                   }// while loop ends
                } // if ends
                 ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
