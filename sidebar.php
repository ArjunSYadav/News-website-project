<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>

        <?php
             include "config.php";
            
            // include "admin/_db_pdo.php";
             $obj1= new homeclass();
             $limit =3;

             $obj1->select('post', " post.post_id, post.title, post.category, post.post_date, post.post_img, category.category_name", " category ON post.category = category.category_id ",null,null, " post.post_id DESC ",'0', "5");

            //    $sql = "SELECT post.post_id, post.title,  post.category, post.post_date, post.post_img,  category.category_name FROM post LEFT JOIN category ON post.category =category.category_id ORDER BY post.post_id DESC LIMIT {$limit}";   
                $result =$obj1->getResult();
                // print_r($result);
                    if(!empty($result))
                    {
                    
                    //    while($row = mysqli_fetch_assoc($result))
                    foreach ($result as list("post_id"=>$pid, "title"=>$title,"category"=>$pcategory,"post_date"=>$pdate, "post_img"=>$imagename, "category_name"=> $cname,))

                            {
                                
        
        ?>
        <div class="recent-post">
            <a class="post-img" href="single.php?postid=<?php echo$pid;?>">
                <img src="admin/upload/<?php echo $imagename;?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?postid=<?php echo$pid;?>"><?php echo $title;?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?catid=<?php echo $pcategory;?>'><?php echo $cname;?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $pdate;?>
                </span>
                <a class="read-more" href="single.php?postid=<?php echo$pid;?>">read more</a>
            </div>
        </div>
        <?php
                          }  //whilelopp // foreachloop
                        } //if block
    
    ?>
    <!-- /recent posts box -->
        
    </div>
    
    
</div>
