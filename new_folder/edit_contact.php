<?php

include ('header.php');

echo '<div id="edittitle"><h3>Επεξεργασία επαφής</h3></div>';

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
	
	$errors = array();
	
 //Έλεγχος καταχώρησης ονόματος

  if(empty($_POST['firstname']))
  {
   $errors[]='Παρακαλώ συμπληρώστε το όνομά σας';
  }
  else
  {
   $fn=trim($_POST['firstname']);
  }

  //Έλεγχος καταχώρησης επωνύμου

  if(empty($_POST['lastname']))
  {
   $errors[]='Παρακαλώ συμπληρώστε το επώνυμό σας';
  }
  else
  {
   $ln=trim($_POST['lastname']);
  }
  
 //Έλεγχος καταχώρησης τηλεφώνου

  if(empty($_POST['phonenumber']))
  {
   $errors[]='Παρακαλώ συμπληρώστε το τηλέφωνό σας';
  }
    elseif(is_numeric($_POST['phonenumber']))
    {$ph=trim($_POST['phonenumber']);
    }
  else
  {
  	$errors[]='Παρακαλώ συμπληρώστε σωστά το τηλέφωνό σας';
  }
 
  //Έλεγχος καταχώρησης διεύθυνσης

  if(empty($_POST['address']))
  {
   $errors[]='Παρακαλώ συμπληρώστε την διεύθυνσή σας';
  }
  else
  {
   $ad=trim($_POST['address']);
  }
  if (empty($errors)) {
  	$q = "SELECT user_id FROM contacts WHERE phonenumber='$ph' AND user_id != $id";
  	$r = mysqli_query($dbc, $q);
  	if (mysqli_num_rows($r) == 0) {
  		$q = "UPDATE contacts SET firstname='$fn', lastname='$ln', phonenumber='$ph' address='$ad' WHERE user_id=$id LIMIT 1";
  		$r = mysqli_query ($dbc, $q);
  		
  		if (mysqli_affected_rows($dbc) == 1)
		{echo '<p>The user has been edited.</p>';
		} else {
			echo '<p class="error">The user could not be edited due to a system error.
					We apologize for any inconvenience.</p>'; // Public message.
		
  			echo '<p>' . mysqli_error($dbc) . '<br/>Query: ' . $q . '</p>'; // Debugging message.
		}
		} else {
			echo '<p class="error">The email
					address has already been registered.</p>';
		}
		
		} else {
			echo '<p class="error">The following error(s) occurred:<br />';
			
			foreach ($errors as $msg) {
				echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p>';
		}
	}
	$q = "SELECT firstname, lastname, phonenumber, address FROM contacts WHERE user_id=$id";
	$r = @mysqli_query ($dbc, $q);
	if (mysqli_num_rows($r) == 1) {
		$row = mysqli_fetch_array ($r,MYSQLI_NUM);
	
		echo '<form id="edit" action="edit_contact.php" method="post">
		<table style="padding:10px; width:75%; border:2px solid #333;">
		<tr><td>Όνομα: <input type="text" name="firstname" size="15" maxlength="15" value="' . $row[0] . '" /></td></tr>
		
		<tr><td>Επίθετο: <input type="text" name="lastname" size="15" maxlength="30" value="' . $row[1] . '" /></td></tr>
		
		<tr><td>Tηλέφωνο: <input type="text" name="phonenumber" size="20" maxlength="40" value="' . $row[2] . '" /> </td></tr>
		
		<tr><td>Διεύθυνση: <input type="text" name="address" size="20" maxlength="40" value="' . $row[3] . '" /> </td></tr>
		
		<tr><td><input style="float: right;" type="submit" name="submit" value="Αποθήκευση" /></td></tr>
		
		<input type="hidden" name="submitted" value="TRUE" />
		
		<input type="hidden" name="id" value="' . $id . '" />
		</table></form>';
		
		} else {
			echo '<p class="error">This page has been accessed in error.</p>';
		}
		mysqli_close($dbc);
		
?>