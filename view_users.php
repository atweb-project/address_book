<?php 
include ('header.php');?>
<div id="contacttable">
 			<h3>Οι χρήστες είναι:</h3>
 			
 			<?php 
 				//Σύνδεση με την βάση
  	 			$dbc=mysqli_connect('localhost','root','' ,'address_book')or
        		die ('Could not connect to mySQL:'.mysqli_connect_error());
        		
        		//Ερώτημα ελέγχου για την εμφάνιση του πίνακα contacts
    			$q="SELECT * FROM users ORDER BY registration_date ASC";
     			$r= mysqli_query($dbc,$q);
     			
     			if ($r){
     				echo '<table style="padding:10px; width:75%; border:2px solid #333;">
     				<tr>
     				<td><b>ID</b></td><td><b>Username</b></td><td><b>Email</b></td>
     				<td><b>Επεξεργασία</b></td><td><b>Διαγραφή</b></td></tr>';
     				
     				while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
     					echo '<tr><td>' . $row['user_id'] . '</td><td>' . $row['username'] . '</td><td>
     					' . $row['email'] . '</td>
     					<td><a href="edit_user_profile.php?id=' . $row['user_id'] . '"><img id="editimg" src="edit.jpg" alt="Επεξεργασία"/></a></td>
     					<td><a href="delete_contact.php?id=' . $row['user_id'] . '"><img id="editimg" src="delete.jpg" alt="Διαγραφή"/></a></td></tr>';
     				}
     				echo '</table>';
     				
     				mysqli_free_result ($r);
     			
     			}else {
     				echo'Δεν υπάρχουν καταχωρημένοι χρήστες';
     			}
     			
 			?>
 	</div>
	