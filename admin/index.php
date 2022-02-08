
<?php
include "config.php";
  session_start();

  if(isset( $_SESSION["username"])){
    header("Location:{$hostname}/admin/post.php");
  }

?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                          <a href="forget_password.php">Forgot Password</a>
                        </form>
                        <!-- /Form  End -->

                        <?php
                        if(isset($_POST['login']))
                        {
                            include "config.php";
                            include "_db_pdo.php";
                            $obj =new database();
                            if(empty($_POST['username'] || $_POST['password']))
                            {
                                echo'<div class ="alert alert-danger">Username and Password are nt enter</div>';
                                die();

                            }else{
                                $username = mysqli_real_escape_string($conn, $_POST['username']);
                            $password =md5($_POST['password']);

                            // $sql="SELECT `user_id`, `username`, `role`  FROM user WHERE username ='{$username}' AND `password` ='{$password}'";
                            $obj->select('user', " `user_id`, `username`, `role` ",null,null, " username ='{$username}' AND `password` ='{$password}'");
                            

                            $result =$obj->getResult();

                            if(!empty($result))
                            {
                                // while($row =mysqli_fetch_assoc($result))
                                foreach ($result as list("user_id"=>$uid, "username"=>$uname,"role"=>$urole)) 
                                {
                                    session_start();
                                    $_SESSION["username"]=$uname;
                                    $_SESSION["user_id"]=$uid;
                                    $_SESSION["user_role"]=$urole;

                                    header("Location:{$hostname}/admin/post.php");
                                }

                            }
                            else{
                                echo'<div class ="alert alert-danger">Username and Password are nt matched</div>';
                            }
                            }
                            
                        }
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
