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
        <h1>UPDATE DESIGN</h1>
        <hr>
      </div>
      <?php
        include 'config.php';
        if((!isset($_GET['pattern_id']))||trim($_GET['pattern_id'])==""){
          echo "No post like that !";
        }else{

          $pattern_id = addslashes($_GET['pattern_id']);
          $result = mysqli_query($db, "SELECT * FROM pattern_des WHERE pattern_id = '$pattern_id'");
          $row = mysqli_num_rows($result);

          if($row>0){
            while($rows = mysqli_fetch_assoc($result)) {
              $dname= $rows["dname"];
              $description=$rows['description'];
              $mimage=$rows['mimage'];
              $weight=$rows['weight'];
              $width=$rows['width'];
              $composition= $rows["composition"];
              $design=$rows['design'];
              $weave=$rows['weave'];
              $dye=$rows['dye'];
              $label=$rows['label'];
              $selvedge=$rows['selvedge'];
     
      
  ?>


    <form action="" method="post" enctype="multipart/form-data">
      <div class="design-form">
        <div class="design-div">
          <div class="form-detail">
            <label>Image :</label>
            <input type="file" name="filetoupload" id="filetoupload">
            <label>Enter Design Name :</label>
            <input type="text" name="dname" id="dname" value="<?php echo $dname; ?>">
            <label>Description :</label>
            <textarea name="description" id="description" ><?php echo $description ?></textarea> 
            <label>Enter Weight :</label>
            <input type="text" name="weight" id="weight" value="<?php echo $weight; ?>">
            <label>Enter Width :</label>
            <input type="text" name="width" id="width" value="<?php echo $width; ?>">
          </div>
        </div>
        <div class="design-div">
          <div class="form-detail">
            <label>Enter Composition :</label>
            <input type="text" name="composition" id="composition" value="<?php echo $composition; ?>">
            <label>Enter Design :</label>
            <input type="text" name="design" id="design" value="<?php echo $design; ?>">
            <label>Enter Weave :</label>
            <input type="text" name="weave" id="weave" value="<?php echo $weave ?>">
            <label>Enter Dye :</label>
            <input type="text" name="dye" id="dye" value="<?php echo $weave ?>">
            <label>Enter Cloth Label :</label>
            <input type="text" name="label" id="label" value="<?php echo $label ?>">
            <label>Enter Selvedge :</label>
            <input type="text" name="selvedge" id="selvedge" value="<?php echo $selvedge; ?>">
            <!--label>Select Multiple Image :</label>
            <input type="file" name="image[]" id="image"accept=".jpg,.png,.gif" multiple-->
          </div>
        </div>
      </div>
      <input type="submit" name="updatedes" value="UPDATE DESIGN">
    </form>
  </div>

  <?php
      }
    }
  }
  if (isset($_POST['updatedes'])) {

    $dname=$_POST['dname'];
    $description=$_POST['description'];
    $weight=$_POST['weight'];
    $width=$_POST['width'];
    $composition=$_POST['composition'];
    $design=$_POST['design'];
    $weave=$_POST['weave'];
    $dye=$_POST['dye'];
    $label=$_POST['label'];
    $selvedge=$_POST['selvedge'];
    

    if(isset($_FILES['filetoupload'])){
        //------- convert image to base64_encode------------------
    
        $image_path = $_FILES["filetoupload"]["tmp_name"]; //this will be the physical path of your image
        if($image_path!=""){
        $img_binary = fread(fopen($image_path, "r"), filesize($image_path));
        $picture = base64_encode($img_binary);

        $q="UPDATE pattern_des SET dname='$dname',description ='$description',mimage='$picture',weight='$weight',width='$width',composition='$composition',design='$design',weave='$weave',dye='$dye',label='$label',selvedge='$selvedge' WHERE pattern_id='$pattern_id'";
    }else{
      $q="UPDATE pattern_des SET dname='$dname',description ='$description',weight='$weight',width='$width',composition='$composition',design='$design',weave='$weave',dye='$dye',label='$label',selvedge='$selvedge' WHERE pattern_id='$pattern_id'";
    }
          if($db->query($q)==true){
            echo "inserted successfully";
            echo '<script language="Javascript">';
              echo 'document.location.replace("./update_design.php")'; // -->
              echo '</script>';
          }
          else{
            echo $db->error;
          }
        }
    }  
  ?>
  <br>
      <div class="main-name">
        <h1>Select Shades</h1>
        <hr>
      </div>
  <div class="variety-imgs">
    
  <?php

    $sql = mysqli_query($db,"SELECT * FROM image_pattern WHERE pattern_id='$pattern_id'");
    $num_rows=mysqli_num_rows($sql);
    
    if ($num_rows==0) {
      echo "Let's start Posting.........!";
    }
    else{
      while ($rows=$sql->fetch_assoc()) {
        $img_id=$rows['img_id'];
        $name_shades=$rows['name_shades'];
          $image=$rows['image'];
          
    ?>
    
      
            <div class="variety-div">
              <div class="var-img">
                <img src='<?php echo "$image";?>'>
              </div>
              <div class="var-shades">
                <a href="update_shade.php?img_id=<?php echo $img_id;?>">UPDATE</a>
                <h4><?php echo $name_shades; ?></h4>
                <a href="delete_shade.php?img_id=<?php echo $img_id;?>">DELETE</a>
              </div>
            </div>
      <?php
        }
      }
      ?>
    </div>
  		
