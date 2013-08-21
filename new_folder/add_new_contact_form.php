<?php

include ('header.php');

echo '<div id="edittitle"><h3>Προσθήκη Νέας Επαφής</h3></div>';

echo '<form id="edit" action="add_new_contact.php" method="post">
		<table style="padding:10px; width:75%; border:2px solid #333;">
		<tr><td>Όνομα: <input type="text" name="firstname" size="15" maxlength="15" /></td></tr>
		
		<tr><td>Επίθετο: <input type="text" name="lastname" size="15" maxlength="30" /></td></tr>
		
		<tr><td>Tηλέφωνο: <input type="text" name="phonenumber" size="20" maxlength="40" /> </td></tr>
		
		<tr><td>Διεύθυνση: <input type="text" name="address" size="20" maxlength="40" /> </td></tr>
		
		<tr><td><input style="float: right;" type="submit" name="submit" value="Αποθήκευση" /></td></tr>
		
		<input type="hidden" name="submitted" value="TRUE" />
		
		</table></form>';

?>