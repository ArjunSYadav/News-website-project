<?php include "header.php";

if($_SESSION["user_role"] =='0'){
    header("Location: {$hostname}/admin/post.php");

}
 ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
            <?php
                        include "config.php";
                        include "_db_pdo.php";
                        $obj =new database();
                        $limit =3;

                        // $page =$_GET['page'];

                        if(isset($_GET['page']))
                        {
                            $page =$_GET['page'];
                        }else{
                            $page =1;
                        }
                        $offset =($page - 1)* $limit;

                        // $sql = "SELECT * FROM category ORDER BY  category_id DESC LIMIT {$offset},{$limit} ";
                        $obj->select('category', '*', null, null,null, "category_id DESC ", "$offset", $limit);
                        $result =$obj->getResult();
                        $args =array();
                        // $result =mysqli_query($conn, $sql) or die ("Querry Faild");
                        
                if(!empty($result))
                {
                    ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                    <?php
                        //    while($row = $)
                        foreach ($result as list("category_id"=>$id, "category_name"=>$cname,"post"=>$post)) {
                                        
                            ?>
                        <tr>
                            <td class='id'><?php echo $id; ?></td>
                            <td><?php echo$cname; ?></td>
                            <td><?php echo$post; ?></td>
                            <td class='edit'><a href='update-category.php?catid= <?php echo $id; ?> '><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?catid= <?php echo $id; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        
                        <?php } ?>
                    </tbody>
                </table><?php } 
                 $sql1 ="SELECT * FROM category ";
                 $result1 = mysqli_query($conn,$sql1) or die("Querry Failed");
                 if(mysqli_num_rows($result1)>0)
                 {
                     $total_records = mysqli_num_rows($result1);
                    
                     $total_page=ceil($total_records/$limit);
                     echo"<ul class='pagination admin-pagination'>";
                     if($page > 1)
                     {
                         echo'<li><a href="category.php?page='.($page-1).'">Prev</a></li>';
                     }
                     
                     for($i=1; $i<=$total_page; $i++)
                     {
                         if($i == $page)
                         {
                             $active ="active";
                         }
                         else{
                             $active="";
                         }
                         echo'<li class="'.$active.'"><a href="category.php?page='.$i.'">'.$i.'</a></li>';
 
                     }
                     if($total_page >$page)
                     {
                         echo'<li><a href="category.php?page='.($page+1).'">Next</a></li>';
                     }
                     
                     echo"</ul>";
                 }
                 
                ?>
                <!-- <ul class='pagination admin-pagination'>
                    <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li>
                </ul> -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
