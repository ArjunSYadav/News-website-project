<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <?php
                        include "config.php";

                        include "_db_pdo.php";
                        $obj =new database();
                        $limit =3;

                        // $page =$_GET['page'];
                        $obj=new database();

                        if(isset($_GET['page']))
                        {
                            $page =$_GET['page'];
                        }else{
                            $page =1;
                        }
                        $offset =($page - 1)* $limit;
                        if($_SESSION["user_role"] =='1'){
                           
                            // $sql = "SELECT post.post_id, post.title, post.description, post.category, post.post_date, category.category_name, user.username 
                            // FROM post LEFT JOIN category ON post.category =category.category_id 
                            // LEFT JOIN user ON post.author = user.user_id ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                            $obj->select('post', " post.post_id, post.title, post.description, post.category, post.post_date, category.category_name, user.username ", " category ON post.category = category.category_id ", " user ON post.author = user.user_id ", null, " post.post_id ", "$offset", $limit);
                        }elseif($_SESSION["user_role"] =='0'){
                            // // $sql = "SELECT post.post_id, post.title, post.description, post.category, post.post_date, category.category_name, user.username FROM post LEFT JOIN category ON post.category =category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post.author ={$_SESSION['user_id']} ORDER BY  post.post_id DESC LIMIT {$offset},{$limit}";
                            $obj->select("post"," post.post_id, post.title, post.description, post.category, post.post_date, category.category_name, user.username ", " category ON post.category = category.category_id ", " user ON post.author = user.user_id ", " post.author ={$_SESSION['user_id']}", " post.post_id", "$offset", $limit);
                        }

                        
                        $result =$obj->getResult();
                if(!empty($result))
                {
                    ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                            $serial =$offset +1;
                        //    while($row = mysqli_fetch_assoc($result))
                        foreach ($result as list("post_id"=>$pid, "title"=>$title,"category"=>$pcategory,"post_date"=>$pdate, "category_name"=> $cname, "username"=>$username))
                           { ?>
                           
                        <tr>
                            <td class='id'><?php echo$serial ; ?></td>
                            <td><?php echo$title; ?></td>
                            <td><?php echo $cname; ?></td>
                            <td><?php echo $pdate; ?></td>
                            <td><?php echo $username; ?></td>

                            <td class='edit'><a href='update-post.php?postid=<?php echo $pid;?>'><i
                                        class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-post.php?postid=<?php echo $pid; ?>&catid=<?php echo $pcategory;?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php $serial++;} ?>
                    </tbody>
                </table>
                <?php } 
                else{echo "<h3>No Results Found</h3>";}
                
                $sql1 ="SELECT * FROM post ";
                $result1 = mysqli_query($conn,$sql1) or die("Querry Failed");
                if(mysqli_num_rows($result1)>0)
                {
                    $total_records = mysqli_num_rows($result1);
                   
                    $total_page=ceil($total_records/$limit);
                    echo"<ul class='pagination admin-pagination'>";
                    if($page > 1)
                    {
                        echo'<li><a href="post.php?page='.($page-1).'">Prev</a></li>';
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
                        echo'<li class="'.$active.'"><a href="post.php?page='.$i.'">'.$i.'</a></li>';

                    }
                    if($total_page >$page)
                    {
                        echo'<li><a href="post.php?page='.($page+1).'">Next</a></li>';
                    }
                    
                    echo"</ul>";
                }
                ?>

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>