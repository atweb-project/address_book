<?php

include ('header.php');
if (isset($_SESSION['username'])){
	
$_SESSION['username']=$un;}
$dbc=mysqli_connect('localhost','root','' ,'address_book')or
        		die ('Could not connect to mySQL:'.mysqli_connect_error());
$q = "SELECT user_id FROM users WHERE username = '$un'";
$r = mysqli_query ($dbc, $q);
$row = mysql_fetch_array($r);
$owner = $row['user_id'];
if (isset($_POST['submitted'])) {
			// Check for an uploaded file:
			
$target = "eikones/"; 
$target = $target . basename( $_FILES['upload']['name']);

$pic=($_FILES['upload']['name']);

$dbc=mysqli_connect('localhost','root','' ,'address_book')or
        		die ('Could not connect to mySQL:'.mysqli_connect_error());

          	
  	
if(move_uploaded_file($_FILES['upload']['tmp_name'], $target)) 
 { 
 	$q="UPDATE users SET photo='eikones/$pic' WHERE user_id='$owner'";
	$r = mysqli_query ($dbc, $q);
	if($r)
 	echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded, and your information has been added to the directory"; 
  	}
 } 
 else { 
 
 //Gives and error if its not 
 echo "Sorry, there was a problem uploading your file."; 
 } 


 ?> 