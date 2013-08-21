<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>My Address Book</title>
<link type="text/css" href="style.css" rel="stylesheet">
</head>
<body>
	<div id="content-header">
		<div id="header"><img alt="" src="addressbook_image.png"></div>
		<div id="header_a"><h1> My Address book</h1></div>
	</div>
	
	<div id="button_panel">
		<form id="home" action=control_panel.php method=post>
				  <input id="home" type=submit value='Επαφές'  />
		</form>
		
		<form id="users" action=view_users.php method=post>
				  <input id="" type=submit value='Χρήστες'  />
		</form>
		
		<form id="logout" action=logout.php method=post>
				  <input id="logout" type=submit value='Αποσύνδεση'  />
		</form>
	</div>
	<div id="welcome">
	<?php 
	
	echo"<h2>Καλώς ήρθες";
	if (isset($_SESSION['username'])){
		$dbc=mysqli_connect('localhost','root','' ,'address_book')or
        		die ('Could not connect to mySQL:'.mysqli_connect_error());
        		
        		//Ερώτημα ελέγχου για την εμφάνιση του πίνακα contacts
    			$q="SELECT * FROM users ORDER BY registration_date ASC";
     			$r= mysqli_query($dbc,$q);
     			
     			if ($r){
     			$row = mysqli_fetch_array($r,MYSQLI_ASSOC) ;
     					echo ', <a href="edit_user_profile.php?id=' . $row['user_id'] . '">'.$_SESSION['username'].'</a>';
     				
     			}
	}
	echo'</h2>';
	
	?>
	</div>
	<div id="search">
		 <form id="search" method="post" action="search.php">
 				Αναζήτηση επαφών: <input type="text" name="find" /> με 
 				<select name="field">
 				<option value="firstname">Όνομα</option>
 				<option value="lastname">Επίθετο</option>
 				<option value="phonenumber">Τηλέφωνο</option>
 				<option value="address">Διεύθυνση</option>
 				</select>
 				<input type="hidden" name="searching" value="yes" />
 				<input id ="search" type="submit" name="search" value="Αναζήτηση" />
 		</form>
 		</div>



</body>
</html>
 