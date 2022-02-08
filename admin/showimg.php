<?php
include "config.php";
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
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
    div.img{
        border: 1px solid #000;
        width: auto;
        height:auto;
        overflow: hidden;
        white-space: nowrap;
      }
      .img
{
  position: inherit;
  margin: auto;
  top: 0;
  right: 10%;
  bottom: 40%;
  left: 10%;
  width: 100px;
  height: 100px;
  background-color: #ccc;
  border-radius: 3px;
}
  </style>
    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>

    <!-- image start -->

    
<div style= "margin :auto;
width:70%; padding:10px;">
   <?php
   echo '<div class="img">';
   echo'<div class="scroll">';
   include "config.php";
   include "_db_pdo.php";
   $obj1 =new database();
   $obj1->select('mul_img',"*",null,null,"post_id = 38 ",null,null,null);
   $result=$obj1->getResult();
   foreach($result as $row){
    //  $first_img= explode(',',$row['post_image']);
    // echo($row['post_image']);
   
 echo'<img src="array_img/'.$row['post_image'].'" width="400px" height="250px" style="margin: 2px;" alt="">';
   }
  echo "</div>";
   echo "</div>";
  
?>
  

   
</div>


<?php
$obj1->select('mul_img',"*",null,null,"post_id = 38 ",null,null,null);
$result=$obj1->getResult();
foreach($result as $row){
?>
<form method='post' action='updateMulimg.php' enctype='multipart/form-data'>
  <div class="form-group">
    <div>
                        <label for="">Post image</label>
                        <input type="file" id="file" name="file[]"  multiple>
                        <img src="array_img/<?php echo $row['post_image']; ?>" class="ad_images<?php echo $row['i_id']; ?>" height="150px">
                       <input type="hidden" name="p_images_id[]" value="<?php echo $row['i_id'];?>">
                       <button type="submit" style="margin-top: 3px;" id="update" name="update_img" class="btn btn-warning" value="Update"  >Update</button>
                        <button type="button" style="margin-top: 3px;" id="remove" name="remove" class="btn btn-danger" onclick=remove_img(<?php echo $row['i_id'];?>) value="Remove"  ><a href="updateMulimg.php?pid=<?php echo $row['i_id'];?>">Remove</a></button>
                        <input type="hidden" name="old-image" value="<?php echo $row['i_id']; ?>">
                    </div>
                    </div>
<?php
}
?>
</form>
</div>
<div >
  <p id="true"></p>
</div>
  </body>
  <script src="javascript/jquery.js"></script>
  <script>
    $(document).ready(function(){
    var total_img=1;
    var count =0;
            
                
          
          });
          $("#update").click(function(e){
            // e.preventDefault();
            $.ajax({
              url: "updateMulimg.php",
              type : "POST",
              data: new FormData(this),
              contentType : false,
              cache:false,
              processData:false,
              success: function(data,response){
                if(response =="true"){
                  $("#true").html("File Updated"+data);
                }else{
                  $("#true").html("File NotUpdated"+data);
                }
              }
            });
          });

           
    function remove_img(id){
                // alert('Image removed');
                $('.ad_images'+id).remove();
            }
  </script>
</html>

