<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    include "config.php";
                    include "_db_pdo2.php";

                    $obj= new homeclass();
                     $limit =5;

                        // $page =$_GET['page'];

                        if(isset($_GET['page']))
                        {
                            $page =$_GET['page'];
                        }else{
                            $page =1;
                        }
                        $offset =($page - 1)* $limit;
                        
                           
                            // $sql = "SELECT post.post_id, post.title, post.description, post.category, post.post_date, post.post_img, post.author, category.category_name, user.username FROM post LEFT JOIN category ON post.category =category.category_id LEFT JOIN user ON post.author = user.user_id ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                            $obj->select('post',"post.post_id, post.title, post.description, post.category, post.post_date, post.post_img, post.author, category.category_name, user.username"," category ON post.category=category.category_id ", " user ON post.author = user.user_id ", null," post.post_id DESC ","$offset",$limit);
                        
                        $result =$obj->getResult();
                            if(!empty($result))
                            {
                            
                            //    while($row = mysqli_fetch_assoc($result))
                            foreach ($result as list("post_id"=>$pid, "title"=>$title, "description"=>$desc, "post_img"=>$imgname, "author"=>$author, "category"=>$pcategory,"post_date"=>$pdate, "category_name"=> $cname, "username"=>$username))
                            {
                           
                    
                    
                    ?><script>
                        // 1ccd4308b9cf46e8827ee333ceb37c87
                    </script>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?postid=<?php echo$pid;?>"><img src="admin/upload/<?php echo $imgname;?>" alt="" /></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href="single.php?postid=<?php echo$pid;?>"><?php echo $title;?></a>
                                    </h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?catid=<?php echo $pcategory;?>'><?php echo $cname;?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?aid=<?php echo $author;?>'><?php echo $username;?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $pdate;?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($desc,0,100)."...";?>
                                    </p>
                                    <a class='read-more pull-right' href="single.php?postid=<?php echo$pid;?>">read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php
                                    } //whileloop
                                }//if
                                else{
                                    echo"No result found";
                                }
                                
                        
                        ?>                

                
                <?php
                $sql1 ="SELECT * FROM post ";
                $result1 = mysqli_query($conn,$sql1) or die("Querry Failed");
                if(mysqli_num_rows($result1)>0)
                {
                    $total_records = mysqli_num_rows($result1);
                   
                    $total_page=ceil($total_records/$limit);
                    echo"<ul class='pagination admin-pagination'>";
                    if($page > 1)
                    {
                        echo'<li><a href="index.php?page='.($page-1).'">Prev</a></li>';
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
                        echo'<li class="'.$active.'"><a href="index.php?page='.$i.'">'.$i.'</a></li>';

                    }
                    if($total_page >$page)
                    {
                        echo'<li><a href="index.php?page='.($page+1).'">Next</a></li>';
                    }
                    
                    echo"</ul>";
                }
                
                ?>
                
            </div><!-- /post-container -->
        </div>
        <?php include 'sidebar.php'; ?>
    </div>
</div>
</div>
<?php include 'footer.php'; ?>