<?php

include ('header.php');

echo '<div id="edittitle"><h3>Διαγραφή Επαφής</h3></div>';

if ( (isset($_GET['id'])) && (is_numeric
($_GET['id'])) ) {
	
	$id = $_GET['id'];
	
} elseif ( (isset($_POST['id'])) &&
(is_numeric($_POST['id'])) ) {

	$id = $_POST['id'];
	
	} else {

		echo '<p class="error">This page has been accessed in error.</p>';
		
		exit();
	}
	
	$dbc=mysqli_connect('localhost','root','' ,'address_book')or
        		die ('Could not connect to mySQL:'.mysqli_connect_error());
        		
if (isset($_POST['submitted'])) {
	if ($_POST['sure'] == 'Yes') {
		
		$q = "DELETE FROM contacts WHERE user_id=$id LIMIT 1";

		$r = mysqli_query ($dbc, $q);
		
		if (mysqli_affected_rows($dbc) == 1) {
// If it ran OK.


			echo '<p style="float:left;margin-left: 536px;margin-top: 0;">Η επαφή σας έχει διαγραφεί.</p>';
			
			} else {
				echo '<p class="error">The user could not be deleted due to a system error.</p>';
			
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>';

			}
			
			} else {
				echo '<p style="float:left;margin-left: 536px;margin-top: 0;">Η επαφή σας δεν έχει διαγραφεί.</p>';
			}
			
			} else {
				
				$q = "SELECT CONCAT(lastname, ', ',firstname) FROM contacts WHERE user_id=$id";
				$r = mysqli_query ($dbc, $q);
				
				if (mysqli_num_rows($r) == 1){ // Valid user ID, show the form.
					
					// Get the user's information:
					$row = mysqli_fetch_array ($r,MYSQLI_NUM);
					
					echo '<form id="edit" action="delete_contact.php" method="post">
					
					<h3>Όνομα: ' . $row[0] . '</h3>
					
					<p id="delete">Θέλετε να διαγράψετε την επαφή;<br />
					
					<input type="radio" name="sure" value="Yes" /> Ναι
					
					<input type="radio" name="sure" value="No" checked="checked" /> Όχι</p>
					
					<p><input type="submit" name="submit" value="Διαγραφή" /></p>
					
					<input type="hidden" name="submitted" value="TRUE" />
					
					<input type="hidden" name="id" value="'. $id . '" />
					</form>';
					
					} else {// Not a valid user ID.
						
						echo '<p class="error">This page has been accessed in error.</p>';
						
					}
			}
			
			mysqli_close($dbc);
			
?>