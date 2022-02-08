<?php include 'header.php'; ?>

<head>
    <style>
        div.scroll {
            margin: 10px, 10px;
            padding: 20px;
            background-color: white;
            width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
        }

        div.img {
            border: 1px solid #000;
            width: auto;
            height: auto;
            overflow: hidden;
            white-space: nowrap;
        }

        .img {
            position: auto;
            margin: auto;
            top: 0;
            right: 10%;
            bottom: 40%;
            left: 10%;
            width: 10px;
            height: 10px;
            background-color: #ccc;
            border-radius: 3px;
        }
    </style>
</head>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    include "config.php";
                    // include "_dbpdo2.php";
                    include "_db_pdo2.php";
                    $obj = new homeclass();

                    $post_id = $_GET['postid'];

                    $obj->select('post', "post.post_id, post.title, post.description, post.category, post.post_date, post.post_img, post.author, category.category_name, user.username", " category ON post.category=category.category_id ", " user ON post.author = user.user_id ", "post.post_id={$post_id}", null, null, null);


                    $result = $obj->getResult();
                    if (!empty($result)) {

                        foreach ($result as list("post_id" => $pid, "title" => $title, "description" => $desc, "post_img" => $imgname, "author" => $author, "category" => $pcategory, "post_date" => $pdate, "category_name" => $cname, "username" => $username)) {



                    ?>
                            <div class="post-content single-post">
                                <h3><?php echo $title; ?></h3>
                                <div class="post-information">
                                    <span>
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        <a href='category.php?catid=<?php echo $pcategory; ?>'><?php echo $cname ; ?></a>
                                    </span>
                                    <span>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <a href='author.php?aid=<?php echo $author; ?>'><?php echo $username; ?></a>
                                    </span>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <?php echo $pdate; ?>
                                    </span>
                                </div>
                                <!-- <img class="single-feature-image" src="admin/upload/<?php echo $imgname; ?>" alt="hello"/> -->
                                <div style="margin :20px; width:80%; height:50%; padding:20px;  ">
                                    <?php
                                    echo '<div class="img">';
                                    echo '<div class="scroll">';
                                    include "config.php";
                                     echo '<img src="admin/upload/' . $imgname . '" style="margin: 2px; width:200px; height:200px;  border: 1px solid skyblue;" alt="">';
                                    // include "_db_pdo.php";
                                    $obj1 = new homeclass();
                                    $obj1->select('mul_img', "*", null, null, "post_id = $pid ", null, null, null);
                                    $result = $obj1->getResult();
                                    foreach ($result as $row) {
                                        //  $first_img= explode(',',$row['post_image']);
                                        // echo($row['post_image']);

                                        echo '<img src="admin/array_img/' . $row['post_image'] . '" style="margin: 2px; width:200px; height:200px; border: 1px solid skyblue;" alt="">';
                                    }
                                    echo "</div>";
                                    echo "</div>";

                                    ?>



                                </div>
                                <p class="description">
                                    <?php echo $desc; ?>
                                </p>
                            </div>
                    <?php
                        } //whileloop
                    } //if
                    else {
                        echo "No result found";
                    }


                    ?>

                </div>
                <!-- /post-container -->

            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>