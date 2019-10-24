<!--?php
session_start();
$user_id = $_SESSION['user_id']; 
$name=$_SESSION["name"];
$email=$_SESSION['email'];
//- if no value in $dir go to login page
if($user_id=="" && $name=="" && $email==""){
    echo '<script language="Javascript">';
    echo 'document.location.replace("./main.php")'; 
    echo '</script>';
}
?>// -->
<?php

require 'config.php';
      if((!isset($_GET['img_id']))||trim($_GET['img_id'])==""){
      echo "No post like that !";
      }else{

        $img_id=$_GET['img_id'];
        $result = mysqli_query($db, "SELECT * FROM image_pattern WHERE img_id = '$img_id'");
              $row = mysqli_num_rows($result);

              if($row>0){
                while($rows = mysqli_fetch_assoc($result)) {
                  $pattern_id= $rows["pattern_id"];
                  $image=$rows['image'];
            
                  if (!unlink($image))
                    {
                      echo ("Error deleting $image");
                    }
                  else
                    {
                      $sql1 = mysqli_query($db, "DELETE FROM image_pattern WHERE img_id='$img_id'");
                      echo ("Deleted $image");
                    }
              echo '<script language="Javascript">';
              echo 'document.location.replace("update_design_description.php?pattern_id='.$pattern_id.'")'; // -->
              echo '</script>';
              }
            }
              else {
              echo "Error deleting record: " . $db->error;
            }

        }
      
    

    ?>