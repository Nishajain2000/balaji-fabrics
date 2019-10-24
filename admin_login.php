<?php

session_start();

include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="design.css">
</head>
<body>
	<div class="heading">
		<div class="login-sec">
			<h2>Login Form</h2>
			<div class="form-detail">
	        	<form action="" method="post">
			        <input type="text" name="username" placeholder="Enter your username" required>
			        <input type="password" name="password" placeholder="Enter your password" required>
			        <input type="submit" name="signin" value="LOGIN">
			    </form>
			</div>
			<p>Want add one more Admin, <a href="#" data-toggle="modal" data-target="#myModal"><b>Register Here...</b></a></p>
		</div>

		<div class="container">
		  	<div class="modal fade" id="myModal" role="dialog">
		    	<div class="modal-dialog">
		    
		      <!-- Modal content-->
		      		<div class="modal-content">
		        		<div class="modal-header">
		          			<button type="button" class="close" data-dismiss="modal">&times;</button>
		        		</div>
		        		<div class="modal-body">
		        			<h2>Registration Form</h2>
		          			<div class="form-detail">
					        	<form action="" method="post" onsubmit="return validation()">
							        <input type="text" name="username" placeholder="Enter your username" id="username">
							        <input type="password" name="password" placeholder="Enter your password" id="password">
							        <input type="submit" name="signup" value="REGISTER">
							    </form>
							</div>
		        		</div>
		        		<div class="modal-footer">
		          			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        		</div>
		      		</div>
		    	</div>
		  	</div>
		</div>
	</div>
	<?php

	error_reporting(E_ALL);
	if(isset($_POST["signin"]))
	{
		 
		$username = $_POST["username"];

		$password = $_POST["password"];
		
		$result = mysqli_query($db,"SELECT * FROM admin_login WHERE username='$username' and password='$password'");

		$num_rows=mysqli_num_rows($result);
		
		if ($num_rows>0) {
			
			while ($rows=$result->fetch_assoc()) {
				$admin_id=$rows['id'];
		        $_SESSION["admin_id"] = $admin_id;
				echo "<script>alert ('Login Successfully');</script>";
				
		        echo '<script language="Javascript">';
		        echo 'document.location.replace("./add_design.php")'; // -->
		        echo '</script>';
		    }
		}
     	else{

     		echo "<script>alert ('Unvalid User');</script>".$db->error;
     	}

	}
	if(isset($_POST["signup"]))
	{
		$username = $_POST["username"];
		$password = $_POST["password"];


		$result = $db->query("SELECT username FROM admin_login WHERE username='$username'");
  			if (($result->num_rows)>0) {
		  	  echo "<script>alert('Sorry... username already taken');</script>"; 	
		  	}else
	  		{

		      $q="INSERT INTO admin_login( username, password) VALUES('$username','$password')";
		     	if($db->query($q)==true){
		     		echo"<script>alert('inserted successfully');</script>";
		     		//echo '<script language="Javascript">';
			        //echo 'document.location.replace("./main.php")'; // -->
			        //echo '</script>';

		     	}
		     	else{
		     		echo $db->error;
		     	}
	  		}
	  	}

		
		/*$result = mysqli_query($db,"INSERT INTO admin_login( username, password) VALUES('$username','$password')");

		$num_rows=mysqli_num_rows($result);
		
		if ($num_rows>0) {
			
			while ($rows=$result->fetch_assoc()) {
				echo "Admin Registeration Successfull";
				
		        //echo '<script language="Javascript">';
		        //echo 'document.location.replace("./")'; // -->
		        //echo '</script>';
		    }
		}
     	else{

     		echo "<script>alert ('Unable to Register');</script>".$db->error;
     	}

	}*/
	
	?>
	<script type="text/javascript">
		function validation(){
			var username=document.getElementById('username').value;
			var password=document.getElementById('password').value;

			if (username==null || username==""){  
			  alert("Username can't be blank");  
			  return false;  
			}if(password.length<6){  
			  	alert("Password must be at least 6 characters long.");  
			  	return false; 
			} 
		}
	</script>
</body>
</html>