<?php include "header.php"; 
if($_SESSION["user_role"] =='0'){
    header("Location: {$hostname}/admin/post.php");

}
if(isset($_POST['save']))
{
    include "config.php";
    include "_db_pdo.php";
    $obj =new database();

    $category =$_POST['cat'];
   
  

    $obj->select("category",'category_name',null,null,"category_name = '{$category}'",null,null,null);
    $result=$obj->getResult();
   
    if(!empty($result))
    {
        echo "<p style ='color:red;text-align:center;margin:10px;0'>Category already exist.</p>";
    }else{

        $result=$obj->insert('category',['`category_name`'=> $category]);

        if(!empty($result))
        {
            header("Location:{$hostname}/admin/category.php");
        }
    }
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
