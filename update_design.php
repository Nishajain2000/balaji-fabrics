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
	<div class="container-fluid">
  		<div class="main-name">
  			<h1>SELECT DESIGN FOR UPDATE</h1>
  			<hr>
  		</div>
  		<div class="variety-imgs">

	<?php

		$sql = mysqli_query($db,"SELECT * FROM pattern_des");
		$num_rows=mysqli_num_rows($sql);
		
		if ($num_rows==0) {
			echo "Let's start Posting.........!";
		}
		else{
			while ($rows=$sql->fetch_assoc()) {
				$pattern_id=$rows['pattern_id'];
				$dname=$rows['dname'];
			    $mimage=$rows['mimage'];
			    
		?>
  	
	  	
	        <div class="variety-div">
	            <div class="var-img">
					<?php echo "<img src=data:image/jpg;base64,$mimage>";?>
				</div>
				<div class="var-shades">
					<a href="update_design_description.php?pattern_id=<?php echo $pattern_id;?>">UPDATE</a>
					<h4><?php echo $dname; ?></h4>
					<a href="delete_design.php?pattern_id=<?php echo $pattern_id;?>">DELETE</a>
				</div>
			</div>
			<?php
				}
			}
			?>
		</div>
	</div>

</body>
</html>

