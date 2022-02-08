<?php
include "config.php";
  session_start();

  if($_SESSION["user_role"] =='0'){
    header("Location: {$hostname}/admin/post.php");
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
                        <h3 class="heading"><?php echo $_SESSION["username"];?></h3>
                        <!-- Form Start -->
                        <form  id="login-form" method ="POST">
                            <div class="form-group">
                                <h1 id="username" name="username"></h1>
                            </div>
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="pasword" id="old" name="old-password" class="form-control email" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" id="new" name="new-password" class="form-control email" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" id="confirm" name="confirm-password" class="form-control email" placeholder="" required>
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
                var current_pass = $("#old").val();
                var new_pass = $("#new").val();
                var confirm_pass = $("#confirm").val();
                var is_error='';
                // console.log(email);
                
                if(current_pass == ''){
                    $("#email_error").html('Current Password Is required');
                    is_error='yes';
                }
                if(new_pass == ''){
                    $("#email_error").html('new Password Is required');
                    is_error='yes';
                }
                if(confirm_pass == ''){
                    $("#email_error").html('Confirm Password Is required');
                    is_error='yes';
                }
                if(new_pass != '' && confirm_pass != '' && new_pass != confirm_pass){
                    $("#email_error").html('Please enter same Password');
                    is_error='yes';
                }
                if(is_error ==''){
                    $('#btn_submit').html('Please wait ....');
                    $('#btn_submit').attr('disabled',true);
                    $.ajax({
                        url : "updatePaswword.php",
                        type : "POST",
                        data : {
                            old_pass: current_pass,
                            new_pass : new_pass,
                        },
                        success: function(result){
                            $("#new").val('');
                            $('#email_error').html(result);
                            $('#btn_submit').html('Submit');
                            $('#btn_submit').attr('disabled',false);
                            $('#login-form')[0].reset();
                        }
                    });
                }
                
            }
            });
           
        });
    </script>
</html>