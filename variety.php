<!DOCTYPE html>
<html>
<head>
      <title>Varieties-Balaji Fabrics</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="design.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	<div class="container-fluid">
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
              $mimage=$rows['mimage']
     
  ?>

	
		<div class="main-img">
			<?php echo "<img src=data:image/jpg;base64,$mimage>";?>
		</div>
		<div class="variety-des">
			<h1><?php echo $dname; ?></h1>
			<hr>
			<div class="variety-con">
				<p><?php echo $description; ?></p>
			</div>
		</div>
		<?php
				}
			}
		?>
		<div class="variety-imgs">
		<?php
			$result1 = mysqli_query($db, "SELECT * FROM image_pattern WHERE pattern_id = '$pattern_id'");
	        $row = mysqli_num_rows($result1);

	        if($row>0){
	            while($rows = mysqli_fetch_assoc($result1)) {
	            	$img_id=$rows['img_id'];
	            	$name_shades= $rows["name_shades"];
	            	$image=$rows['image'];
	            	
		?>
		
			<div class="variety-div">
				<div class="var-img">
					<a href="viewmore.php?img_id=<?php echo $img_id; ?>"><img src="<?php echo $image ?>"></a>
				</div>
				<div class="var-shades">
					<h3><a href="viewmore.php?img_id=<?php echo $img_id; ?>"><?php echo $name_shades; ?></a></h3>
				</div>
			</div>
			<?php
				}
			}
		}
			?>
		</div>
	</div>
	<?php include 'footer.php';?>
</body>
</html>