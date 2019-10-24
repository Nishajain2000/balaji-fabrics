<!DOCTYPE html>
<html>
<head>
	<title>Contact us</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" type="text/css" href="design.css">
</head>
<body>
	<?php
		include 'config.php';
		include 'menu.php'; 
	?>
	<div class="contact-div">
		<div class="main-name" style="margin-bottom: 30px;">
	        <h1>Contact</h1>
	        <hr>
		</div>
		<div class="contact-detail">
			
			<div class="contact-con">
				<div class="info">
					<img src="image/cn.jpg">
				</div>
				
			</div>
		
			<form method="post" action="">
				<input type="text" name="name" id="name" placeholder="Your name" required>
				<input type="email" name="email" id="email" placeholder="Email Address" required>
				<input type="number" name="number" id="number" placeholder="Contact number">
				<textarea name="message" id="message" placeholder="Write somthing here..." required></textarea>
				<input type="submit" name="messagesend" value="Message Send">
			</form>
		</div>
	</div>
	<?php include'footer.php';?>
</body>
</html>
<?php

	error_reporting(0);
	if (isset($_POST['messagesend'])) {

	$client_name=addslashes($_POST['name']);
	$email=addslashes($_POST['email']);
	$contact=addslashes($_POST['number']);
	$message=addslashes($_POST['message']);

	$subject = "User Message";
	$txt = "User Name :".$client_name."User Email :".$email."Contact No. :".$contact."Message :".$message;

	if(mail('kadamaish23@gmail.com',$subject,$txt)){
		echo "Mail is send to you";
		$q="INSERT INTO contact (client_name,email,contact,message) VALUES ('$client_name','$email','$contact','$message')";
     		if($db->query($q)==true){
     			echo "<script>alert('Message send successfully');</script>";
     		}
	     	else{
	     		echo $db->error;
	     	}
		}else{
		echo "Mail is not send,Retry again.....";
		}
	}

      	
	
?>
