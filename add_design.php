<?php
session_start();
$admin_id = $_SESSION['admin_id']; 

//- if no value in $dir go to login page
if($admin_id==""){
    echo '<script language="Javascript">';
    echo 'document.location.replace("./admin_login.php")'; // -->
    echo '</script>';
}

include('config.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Design</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet"  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.css">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="design.css">
</head>
<body>
	<?php include 'menu_admin.php';?>
	<div class="design-con">
		<div class="main-name">
  			<h1>ADD NEW DESIGN</h1>
  			<hr>
  		</div>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="design-form">
				<div class="design-div">
		        	<div class="form-detail">
		        		<label>Image :</label>
		        		<input type="file" name="filetoupload" id="filetoupload" required>
		        		<label>Enter Design Name :</label>
		        		<input type="text" name="dname" placeholder="e.g Galaxy" id="dname" required>
		        		<label>Description :</label>
		        		<textarea name="description" id="description" required></textarea> 
		        		<label>Enter Weight :</label>
		        		<input type="text" name="weight" placeholder="e.g 270gm / medium (260-320gr)" id="weight">
		        		<label>Enter Width :</label>
		        		<input type="text" name="width" id="width" placeholder="eg. 150cm">
					</div>
		        </div>
				<div class="design-div">
					<div class="form-detail">
						<label>Enter Composition :</label>
				        <input type="text" name="composition" id="composition" placeholder="e.g. 54 % polyester 44 % wool 2 % elastan">
		        		<label>Enter Design :</label>
		        		<input type="text" name="design" id="design" placeholder="e.g. plain">
		        		<label>Enter Weave :</label>
		        		<input type="text" name="weave" id="weave" placeholder="e.g 2/2 twill">
		        		<label>Enter Dye :</label>
		        		<input type="text" name="dye" placeholder="e.g yarn dye" id="dye">
		        		<label>Enter Cloth Label :</label>
		        		<input type="text" name="label" id="label" placeholder="">
		        		<label>Enter Selvedge :</label>
				        <input type="text" name="selvedge" id="selvedge" placeholder="e.g. 	* scabal * super 110's * made in england">
				        <!--label>Select Multiple Image :</label>
				        <input type="file" name="image[]" id="image"accept=".jpg,.png,.gif" multiple-->
					</div>
				</div>
			</div>
			<input type="submit" name="add" value="ADD DESIGN">
		</form>
	</div>
	<div class="form-second">
		<div class="main-name">
  			<h1>ADD SHADES</h1>
  			<hr>
  		</div>
		<form method="post" id="upload_multiple_images" enctype="multipart/form-data">
			<div class="select-div">
				<select name="dname" required>
					<option value=''>Select Option</option>
				<?php 
				//$sql = $db->query("SELECT * FROM pattern_des");
				$sql = mysqli_query($db,"SELECT * FROM pattern_des");
				$num_rows=mysqli_num_rows($sql);
				
				if ($num_rows==0) {
					echo "Let's start Posting.........!";
				}
				else{
					while ($rows=$sql->fetch_assoc()) {
						$dname=$rows['dname'];
						echo "<option value='".$dname."'>".$dname."</option>";
				}
			}
				?>
				</select>
				<input type="file" name="userfile[]" value="" multiple="" required>
			</div>
			<input type="submit" name="insert" id="insert" value="Insert Multiple Images"/>
		</form>
	</div>




	<?php

	

	error_reporting(0);
	if (isset($_POST['add'])) {

	$dname=addslashes($_POST['dname']);
	$description=addslashes($_POST['description']);
	$weight=addslashes($_POST['weight']);
	$width=addslashes($_POST['width']);
    $composition=addslashes($_POST['composition']);
	$design=addslashes($_POST['design']);
	$weave=addslashes($_POST['weave']);
	$dye=addslashes($_POST['dye']);
	$label=addslashes($_POST['label']);
	$selvedge=addslashes($_POST['selvedge']);
	

	if(isset($_FILES['filetoupload'])){
      //------- convert image to base64_encode------------------
		
      	$image_path = $_FILES["filetoupload"]["tmp_name"]; //this will be the physical path of your image
      	if($image_path!=""){
      	$img_binary = fread(fopen($image_path, "r"), filesize($image_path));
      	$picture = base64_encode($img_binary);
      	

       	$result = $db->query("SELECT dname FROM pattern_des WHERE dname='$dname'");
  			if (($result->num_rows)>0) {
		  	  echo "Sorry... design name already exist"; 	
		  	}else
	  		{

		      $q="INSERT INTO pattern_des (dname,description,mimage,weight,width,composition,design,weave,dye,label,selvedge) VALUES ('$dname','$description','$picture','$weight','$width','$composition','$design','$weave','$dye','$label','$selvedge')";
		     	if($db->query($q)==true){
		     		echo "<script>alert('Inserted Successfully');</script>";
		     		echo '<script language="Javascript">';
							        echo 'document.location.replace("./update_design.php")'; // -->
							        echo '</script>';
		     	}
		     	else{
		     		echo $db->error;
		     	}
	  		}
	  	}

	}
}
/*$phpFileUploadErrors = array(
0 => 'There is no error, the file uploaded with success',
1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
2 => 'The uploaded file exceeds the upload_max_filesize directive that was specified in the HTML form',
3 => 'The uploaded file was only partially uploaded',
4 => 'No file was uploaded',
6 => 'Missing a Temporary folder',
7 => 'Failed to write file to disk.',
8 => 'A PHP extention stopped the file upload.',
);*/

if (isset($_POST['insert'])) {
	$dname=$_POST['dname'];

	$sql = mysqli_query($db,"SELECT * FROM pattern_des WHERE dname='$dname'");
		$num_rows=mysqli_num_rows($sql);
		
		if ($num_rows==0) {
			echo "Let's start Posting.........!";
		}
		else{
			while ($rows=$sql->fetch_assoc()) {
				$pattern_id=$rows['pattern_id'];

			if (isset($_FILES['userfile'])) {
				$file_array = reArrayFiles($_FILES['userfile']);
				//pre_r($file_array);
				for ($i=0;$i<count($file_array);$i++){
					if($file_array[$i]['error'])
					{
						?> <div class="alert alert-danger">
						<?php echo $file_array[$i]['name'].' - '.$phpFileUploadErrors[$file_array[$i]['error']];
						?> </div> <?php

					} 
					else{
						$extention = array('jpg','png','gif','jpeg');

						$file_ext = explode('.', $file_array[$i]['name']);

						$name = $file_ext[0];
						$name = preg_replace("!-!"," ",$name);
						$name = ucwords($name);




						$file_ext = end($file_ext);

						if (!in_array($file_ext,$extention))
						{
								?> <div class="alert alert-danger">
								<?php echo "{$file_array[$i]['name']} - invalid file extention";
								?> </div> <?php
						}
						else{

							$img_dir = 'pattern_img/'.$file_array[$i]['name']; 

							move_uploaded_file($file_array[$i]['tmp_name'], $img_dir); 

							$sql = "INSERT IGNORE INTO image_pattern (pattern_id,availability,name_shades,image) VALUES('$pattern_id','available','','$img_dir')";
								if($db->query($sql)==TRUE){
									echo "<script>alert('Inserted Successfully');</script>";
								    echo '<script language="Javascript">';
							        echo 'document.location.replace("./update_design.php")'; // -->
							        echo '</script>';
								} 
							}
						}
					}
				}
			}
		}
	}

function reArrayFiles($file_post){

	$file_ary = array();
	$file_count = count($file_post['name']);
	$file_keys = array_keys($file_post);

	for ($i=0; $i <$file_count; $i++) { 
		foreach ($file_keys as $key) {
			$file_ary[$i][$key]=$file_post[$key][$i];
		}
	}
	return $file_ary;
}
function pre_r($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}


?>

</body>

</html>