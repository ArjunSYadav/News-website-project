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
                   $obj2= new homeclass();
                     if(isset($_GET['search']))
                     {
                        $search_id =mysqli_real_escape_string($conn,$_GET['search']);
                     }
                     
                    ?>
                    <h2 class="page-heading"><?php echo $search_id;?></h2>
                    <div class="post-content">

                        <?php

                         include "config.php";
                        
                    
                     $limit =3;
                     if(isset($_GET['search']))
                     {
                        $search_id =mysqli_real_escape_string($conn,$_GET['search']);
                     }

                        if(isset($_GET['page']))
                        {
                            $page =$_GET['page'];
                        }else{
                            $page =1;
                        }
                        $offset =($page - 1)* $limit;
                        
                           
                            // $sql = "SELECT post.post_id, post.title, post.description, post.category, post.post_date, post.post_img, post.author, category.category_name, user.username FROM post LEFT JOIN category ON post.category =category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post.title LIKE '%{$search_id}%' OR post.description LIKE '%{$search_id}%' ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                            $obj2->select('post', " post.post_id, post.title, post.description, post.category, post.post_date, post.post_img, post.author, category.category_name, user.username ", " category ON post.category = category.category_id ", " user ON post.author = user.user_id "," post.title LIKE '%{$search_id}%' OR post.description LIKE '%{$search_id}%' ", " post.post_id DESC ", "$offset", $limit);

                        
                        $result =$obj2->getResult();
                            if(!empty($result))
                            {
                            
                            //    while($row = mysqli_fetch_assoc($result))
                            foreach ($result as list("post_id"=>$pid, "title"=>$title, "description"=>$desc,"category"=>$pcategory, "post_img"=>$imagename, "author"=>$author,"post_date"=>$pdate, "category_name"=> $cname, "username"=>$username))

                                    {
                           
                    
                    
                    ?>

                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?postid=<?php echo$pid;?>"><img
                                            src="admin/upload/<?php echo $imagename;?>" alt="" /></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a
                                                href="single.php?postid=<?php echo$pid;?>"><?php echo $title;?></a>
                                        </h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a
                                                    href='category.php?catid=<?php echo $pcategory;?>'><?php echo $cname;?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a
                                                    href='author.php?aid=<?php echo $author;?>'><?php echo $username;?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $pdate;?>
                                            </span>
                                        </div>
                                        <p class="description">
                                            <?php echo substr($desc,0,100)."...";?>
                                        </p>
                                        <a class='read-more pull-right'
                                            href="single.php?postid=<?php echo$pid;?>">read more</a>
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
                                // $sql1 ="SELECT * FROM post WHERE post.titlE LIKE '%{$search_id}%'";
                                $obj2->select('post',"*",null,null," post.titlE LIKE '%{$search_id}%' ",null,null,null);
                                $result1 =$obj2->getResult();
                if(!empty($result1))
                {
                    $total_records = count($result1);
                   
                    $total_page=ceil($total_records/$limit);
                    echo"<ul class='pagination admin-pagination'>";
                    if($page > 1)
                    {
                        echo'<li><a href="search.php?search='.$search_id.'page='.($page-1).'">Prev</a></li>';
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
                        echo'<li class="'.$active.'"><a href="search.php?search='.$search_id.'page='.$i.'">'.$i.'</a></li>';

                    }
                    if($total_page >$page)
                    {
                        echo'<li><a href="search.php?search='.$search_id.'page='.($page+1).'">Next</a></li>';
                    }
                    
                    echo"</ul>";
                }
                
                ?>

                    </div><!-- /post-container -->
            </div>
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>