
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
                        <form  id="login-form" method ="POST">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" id="email" name="email" class="form-control email" placeholder="" required>
                            </div>
                            <div>
                                <span class="field_error" id="email_error"></span>
                            </div>
                            
                            <input type="submit" id="btn_submit" name="login" class="btn btn-primary"  value="Submit" />
                        </form>
                        <!-- /Form  End -->

                        
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="javascript/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn_submit").on("click", function(e){
                e.preventDefault();
                // forget_password();
                {
                var email = $("#email").val();
                console.log(email);
                
                if(email == ''){
                    $("#email_error").html('');
                }else{
                    $('#btn_submit').html('Please wait ....');
                    $('#btn_submit').attr('disabled',true);
                    $.ajax({
                        url : "forget_password_submit.php",
                        type : "POST",
                        data : {
                            email: email
                        },
                        success: function(result){
                            $("#email").val('');
                            $('#email_error').html(result);
                            $('#btn_submit').html('Submit');
                            $('#btn_submit').attr('disabled',false);
                        }
                    });
                }
            }
            });
           
        });
    </script>
</html>
