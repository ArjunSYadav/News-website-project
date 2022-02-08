<?php include "header.php"; 
if($_SESSION["user_role"] =='0'){
    header("Location: {$hostname}/admin/post.php");

}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
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

                        // $sql = "SELECT * FROM user ORDER BY  user_id DESC LIMIT {$offset},{$limit} ";
                        $obj->select('user',"*",null,null,null,"user_id DESC ", "$offset", $limit);
                        // $result =mysqli_query($conn, $sql) or die ("Querry Faild");
                        $result=$obj->getResult();
                if(!empty($result)>0)
                {
                    ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        //    while($row = mysqli_fetch_assoc($result))
                        foreach ($result as list("user_id"=>$uid, "first_name"=>$fname, "last_name"=>$lname, "username"=>$uname ,"role"=>$role))
                           { ?>
                        <tr>
                            <td class='id'><?php echo $uid; ?></td>
                            <td><?php echo$fname." ".$lname; ?></td>
                            <td><?php echo$uname;?></td>
                            <td><?php 
                            if($role==1)
                            {
                                echo "Admin";
                            }
                            else{echo"Normal";}
                             ?></td>
                            <td class='edit'><a href='update-user.php?id=<?php echo $uid; ?> '><i
                                        class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-user.php?id=<?php echo $uid; ?>'><i
                                        class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table><?php } 
                else{echo "<h3>No Results Found</h3>";}
                
                $sql1 ="SELECT * FROM user ";
                $result1 = mysqli_query($conn,$sql1) or die("Querry Failed");
                if(mysqli_num_rows($result1)>0)
                {
                    $total_records = mysqli_num_rows($result1);
                   
                    $total_page=ceil($total_records/$limit);
                    echo"<ul class='pagination admin-pagination'>";
                    if($page > 1)
                    {
                        echo'<li><a href="users.php?page='.($page-1).'">Prev</a></li>';
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
                        echo'<li class="'.$active.'"><a href="users.php?page='.$i.'">'.$i.'</a></li>';

                    }
                    if($total_page >$page)
                    {
                        echo'<li><a href="users.php?page='.($page+1).'">Next</a></li>';
                    }
                    
                    echo"</ul>";
                }
                ?>

                <!-- <li class="active"><a>1</a></li> -->



            </div>
        </div>
    </div>
</div>
<?php include "header.php"; ?>