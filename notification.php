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
	<div class="noti-con">
		<div class="main-name">
			<h1>Notification</h1>
			<hr>
		</div>
    <div class="noti-main">
        <table>
          <tr>
            <th>CLIENT NAME </th>
            <th>EMAIL </th>
            <th>CONTACT </th>
            <th>MESSAGE </th>
            <th>DATE </th>
          </tr>
      <?php

        $sql = mysqli_query($db,"SELECT * FROM contact");
        $num_rows=mysqli_num_rows($sql);
        
        if ($num_rows==0) {
          echo "No Notification";
        }
        else{
          while ($rows=$sql->fetch_assoc()) {
            $client_name=$rows['client_name'];
            $email=$rows['email'];
            $contact=$rows['contact'];
            $message=$rows['message'];
            $date=$rows['date'];
            
      ?>
          <tr>
            <td><?php echo $client_name; ?></td>
            <td><?php echo $email; ?> </td>
            <td><?php echo $contact; ?> </td>
            <td class="mess"><?php echo $message; ?> </td>
            <td><?php echo $date; ?> </td>
          </tr>
      <?php
        }
      }
      ?>
    </table>
  </div>
</div>
</body>
</html>
