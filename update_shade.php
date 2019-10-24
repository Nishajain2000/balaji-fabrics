<?php
session_start();
$admin_id = $_SESSION['admin_id']; 

//- if no value in $dir go to login page
if($admin_id==""){
    echo '<script language="Javascript">';
    echo 'document.location.replace("./admin_login.php")'; // 
    echo '</script>';
}
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	  <title>Our Designs</title>
	  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="design.css">
</head>
<body>
  <?php include 'menu_admin.php';?>
    <div class="design-con">
        <div class="main-name">
            <h1>UPDATE OUR SHADE</h1>
            <hr>
        </div>

         <?php
            include 'config.php';
            if((!isset($_GET['img_id']))||trim($_GET['img_id'])==""){
              echo "No post like that !";
            }else{

              $img_id = addslashes($_GET['img_id']);
              $result = mysqli_query($db, "SELECT * FROM image_pattern WHERE img_id = '$img_id'");
              $row = mysqli_num_rows($result);

              if($row>0){
                while($rows = mysqli_fetch_assoc($result)) {
                  $pattern_id= $rows["pattern_id"];
                  $availability=$rows['availability'];
                  $name_shades=$rows['name_shades'];
                  $image=$rows['image'];
                  
              
              ?>

        <div class="view-detail">
            <div class="shade-image">
                <img src="<?php echo $image; ?>">
            </div>
            <div class="shade-detail">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="update-div">
                        <div class="form-detail">
                            <label>Shade Image :</label>
                            <input type="file" name="filetoupload" id="filetoupload">
                            <label>Availability :</label>
                            <select name="availability">
                                <option value="Available">Available</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                            <!--input type="text" name="availability" id="availability" value="<?php echo $availability; ?>"-->
                            <label>Enter Name of Shade :</label>
                            <input type="text" name="name_shades" id="name_shades" value="<?php echo $name_shades; ?>">
                            <input type="submit" name="updateshade" value="UPDATE SHADE">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
            
        <?php
            }
        }
    }
    if (isset($_POST['updateshade'])) {

    $availability=$_POST['availability'];
    $name_shades=$_POST['name_shades'];
    

    if(isset($_FILES['filetoupload'])){
        //------- convert image to base64_encode------------------
        $image_path = $_FILES["filetoupload"]["tmp_name"];
        if($image_path!=""){
         //this will be the physical path of your image

        $img_dir = 'pattern_img/'.$_FILES['filetoupload']['name']; 

          if(move_uploaded_file($_FILES['filetoupload']['tmp_name'], $img_dir)){
            if (!unlink($image))
                {
                echo ("Error deleting $image");
                }
            else
                {
                echo ("Deleted $image");
                }
            }
            $q="UPDATE image_pattern SET availability='$availability',name_shades ='$name_shades',image='$img_dir' WHERE img_id='$img_id'";
        }else{
          $q="UPDATE image_pattern SET availability='$availability',name_shades ='$name_shades' WHERE img_id='$img_id'";
            }
              if($db->query($q)==true){
                echo "inserted successfully";
                echo '<script language="Javascript">';
                echo 'document.location.replace("update_design_description.php?pattern_id='.$pattern_id.'")'; // -->
                echo '</script>';
              }
              else{
                echo $db->error;
              }
            }
        }
      
  ?>

      










