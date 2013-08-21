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
				  <input id="users" type=submit value='Χρήστες'  />
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
 	<div id=contacttable>
 			<h3>Οι επαφές σας είναι:</h3>
 			
 			<form id="add_new" method="post" action="add_new_contact_form.php">
 			<input type="submit" name="add_new" value="Προσθήκη νέας επαφής" />
 			</form>
 			<?php 
 				//Σύνδεση με την βάση
  	 			$dbc=mysqli_connect('localhost','root','' ,'address_book')or
        		die ('Could not connect to mySQL:'.mysqli_connect_error());
        		
        		//Ερώτημα ελέγχου για την εμφάνιση του πίνακα contacts
    			$q="SELECT * FROM contacts ORDER BY registration_date ASC";
     			$r= mysqli_query($dbc,$q);
     			
     			if ($r){
     				echo '<table style="padding:10px; width:75%; border:2px solid #333;">
     				<tr>
     				<td><b>ID</b></td><td><b>Όνομα</b></td><td><b>Επώνυμο</b></td>
     				<td><b>Τηλέφωνο</b></td><td><b>Διεύθυνση</b></td><td><b>Επεξεργασία</b></td><td><b>Διαγραφή</b></td></tr>';
     				
     				while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
     					echo '<tr><td>' . $row['user_id'] . '</td><td>' . $row['firstname'] . '</td><td>
     					' . $row['lastname'] . '</td><td>' . $row['phonenumber'] . '</td><td>' . $row['address'] . '</td>
     					<td><a href="edit_contact.php?id=' . $row['user_id'] . '"><img id="editimg" src="edit.jpg" alt="Επεξεργασία"/></a></td>
     					<td><a href="delete_contact.php?id=' . $row['user_id'] . '"><img id="editimg" src="delete.jpg" alt="Διαγραφή"/></a></td></tr>';
     				}
     				echo '</table>';
     				
     				mysqli_free_result ($r);
     			
     			}else {
     				echo'Δεν υπάρχουν εγγραφές καταχωρημένες στο προφίλ σας';
     			}
     			
 			?>
 	</div>
	</div>
</body>
</html>