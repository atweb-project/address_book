<?php

include ('header.php');

echo '<div id="edittitle"><h3>Επεξεργασία προφίλ <b>' . ($_SESSION['username']).'</b></h3></div>';

if ( (isset($_GET['id'])) && (is_numeric
($_GET['id'])) ) {
	
	$id = $_GET['id'];
	
} elseif ( (isset($_POST['id'])) &&
(is_numeric($_POST['id'])) ) {

	$id = $_POST['id'];
	
}else {

		echo '<p class="error">This page has been accessed in error.</p>';
		
		exit();
	}
	
	$dbc=mysqli_connect('localhost','root','' ,'address_book')or
        		die ('Could not connect to mySQL:'.mysqli_connect_error());
        		
if (isset($_POST['submitted']))
{
   $errors=array();

  //Έλεγχος καταχώρησης Username
 
   if(empty($_POST['username']))
  {
   $errors[]='Παρακαλώ συμπληρώστε το username σας';
  }
  else
  {
   $un=trim($_POST['username']);
  }

 //Έλεγχος καταχώρησης password

  if(empty($_POST['password']))
   {
    $errors[]='Παρακαλώ συμπληρώστε το password σας';
   }
   else
   {
    $p=trim($_POST['password']);
  }
  //Έλεγχος καταχώρησης email
  
 if(empty($_POST['email']))
   {
    $errors[]='Παρακαλώ συμπληρώστε το email σας';
   }
   else
   {
    $e=trim($_POST['email']);
  }
  
  if (empty ($errors)) {
  	$q = "SELECT user_id FROM users WHERE username='$un' AND user_id != $id";
  	$r = mysqli_query($dbc, $q);
  	if (mysqli_num_rows($r) == 0) {
  		$q = "UPDATE users SET username='$un', password=SHA1('$p'), email='$e' WHERE user_id=$id LIMIT 1";
  		$r = mysqli_query ($dbc, $q);
  		
  		if (mysqli_affected_rows($dbc) == 1)
		{echo '<p>Το προφίλ σας ανανεώθηκε.</p>';
		} else {
			echo '<p class="error">Tο προφίλ σας δεν ανανεώθηκε λόγω σφάλματος του συστήματος.
					Ζητούμε συγγνώμη.</p>'; // Public message.
		
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
	$q = "SELECT username, password, email FROM users WHERE user_id=$id";
	$r = @mysqli_query ($dbc, $q);
	if (mysqli_num_rows($r) == 1) {
		$row = mysqli_fetch_array ($r,MYSQLI_NUM);
		
		echo '<form id="edit" action="edit_user_profile.php" method="post">
		<table style="padding:10px; width:75%; border:2px solid #333;">
		<tr><td>Username: <input type="text" name="username" size="15" maxlength="30" value="' . $row[0] . '" /></td></tr>
		
		<tr><td>Password: <input type="text" name="password" size="15" maxlength="30" value="' . $row[1] . '" /></td></tr>
		
		<tr><td>Email: <input type="text" name="email" size="20" maxlength="40" value="' . $row[2] . '" /> </td></tr>
		
		<tr><td><input style="float: right;" type="submit" name="submit" value="Αποθήκευση" /></td></tr>
		
		<input type="hidden" name="submitted" value="TRUE" />
		<input type="hidden" name="id" value="' . $id . '" />
		</table></form>';
		
		} else {
			echo '<p class="error">This page has been accessed in error.</p>';
		}
		mysqli_close($dbc);
		
		/*if (isset($_POST['submitted'])) {
			// Check for an uploaded file:
			
			if (isset($_FILES['upload'])) {
		// Validate the type. Should be
		JPEG or PNG.
		
		$allowed = array ('image/pjpeg',
						  'image/jpeg', 'image/jpeg',
						  'image/JPG', 'image/X-PNG',
		                  'image/PNG', 'image/png',
		                  'image/x-png');
		
		if (in_array($_FILES['upload']
		['type'], $allowed)) {
			// Move the file over.
		
			if (move_uploaded_file
			($_FILES['upload']['tmp_name'],
			"../uploads/{$_FILES['upload']['name']
				}")) {
					echo '<p><em>The file has been uploaded!</em></p>';
				} // End of move... IF.
				
				} else { // Invalid type.
					echo '<p class="error">Please upload a JPEG or PNG image.</p>';
				}
				} // End of isset($_FILES['upload']) IF.
				
				// Check for an error:
				if ($_FILES['upload']['error'] > 0) {
					echo '<p class="error">The file could not be uploaded because: <strong>';
				// Print a message based upon the error.
				
					switch ($_FILES['upload']['error']) {
						case 1:
							print 'The file exceeds the upload_max_filesize setting in php.ini.';
							break;
						
						case 2:
							print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form.';
							break;
							
						case 3:
							print 'The file was only partially uploaded.';
							break;
							
						case 4:
							print 'No file was uploaded.';
							break;
							
						case 6:
							print 'No temporary folder was available.';
							break;
							
						case 7:
							print 'Unable to write to the disk.';
							break;
							
						case 8:
							print 'File upload stopped.';
							break;
							
						default:
							print 'A system error occurred.';
							break;
							
							} // End of switch.
					
							print '</strong></p>';
							
							} // End of error IF.
							
							// Delete the file if it still exists:
							if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']) ) {
								unlink ($_FILES['upload']['tmp_name']);
							}
							
							} // End of the submitted conditional.*/
							
			
 
		
?>

		<form id ="photo" enctype="multipart/form-data" action="upload_photo.php" method="post">
		<input type="hidden" name="MAX_FILE_SIZE" value="524288">
		<fieldset id="photo"><legend>Select a JPEG or PNG image of 512KB or smaller to be uploaded:</legend>
		<p id="photo"><b>File:</b> <input type="file" name="upload" /></p>
		</fieldset>
		
		<div align="center"><input type="submit" name="submit" value="Submit" /></div>
		<input type="hidden" name="submitted" value="TRUE" />
		<input type="hidden" name="id" value="' . $id . '" />
		</form>
  
  