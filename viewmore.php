<!DOCTYPE html>
<html>
<head>
	<title>Detail Fabrics</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="design.css">
</head>
<body>
	<?php include 'menu.php';?>
	<div class="view-con">
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

	            $result = mysqli_query($db, "SELECT * FROM pattern_des WHERE pattern_id = '$pattern_id'");
	          	$row = mysqli_num_rows($result);

	          	if($row>0){
		            while($rows = mysqli_fetch_assoc($result)) {
			            $weight=$rows['weight'];
		              	$width=$rows['width'];
		              	$composition= $rows["composition"];
		              	$design=$rows['design'];
		              	$weave=$rows['weave'];
		              	$dye=$rows['dye'];
		              	$label=$rows['label'];
		              	$selvedge=$rows['selvedge'];
     
  		?>
		<div class="main-name">
			<h1><?php echo $name_shades; ?></h1>
			<hr>
		</div>
		<div class="view-detail">
			<div class="shade-image">
				<img src="<?php echo $image; ?>">
			</div>
			<div class="shade-detail">
				<table>
					<tr>
						<td>AVAILABILITY</td>
						<td><?php echo $availability; ?></td>
					</tr>
					<tr>
						<td>WEIGHT</td>
						<td><?php echo $weight; ?></td>
					</tr>
					<tr>
						<td>WIDTH</td>
						<td><?php echo $width; ?></td>
					</tr>
					<tr>
						<td>COMPOSITION</td>
						<td><?php echo $composition; ?></td>
					</tr>
					<tr>
						<td>DESIGN</td>
						<td><?php echo $design; ?></td>
					</tr>
					<tr>
						<td>WEAVE</td>
						<td><?php echo $weave; ?></td>
					</tr>
					<tr>
						<td>DYE</td>
						<td><?php echo $dye; ?></td>
					</tr>
					<tr>
						<td>CLOTH LABEL</td>
						<td><?php echo $label; ?></td>
					</tr>
					<tr>
						<td>SELVEDGE</td>
						<td><?php echo $selvedge; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<?php
				}
			}
		}
	}
}
	?>
	<?php include 'footer.php';?>
</body>
</html>