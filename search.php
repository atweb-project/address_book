<?php

include ('header.php');
 //Έλεγχος υποβολής της φόρμας 
 if (isset($_POST['searching']))
 { 
 echo '<div id="edittitle"><h3>Αποτελέσματα αναζήτησης</h3></div>'; 
 
 //Έλεγχος έαν το πεδίο αναζήτησης είναι άδειο  
 if (empty($_POST['find'])) 
 { 
 echo '<div id="edittitle">Παρακαλώ συμπληρώστε μια λέξη για αναζήτηση</div>'; 
 exit; 
 } 
 
 // Σύνδεση με την βάση
 mysql_connect("localhost", "root", "") or die(mysql_error()); 
 mysql_select_db("address_book") or die(mysql_error()); 
 
 // Φιλτράρισμα 
 $find = strtoupper($_POST['find']); 
 $find = strip_tags($_POST['find']); 
 $find = trim ($_POST['find']); 
 $field=$_POST['field'];
 
 //Αναζήτηση στην βάση της λέξης που υποβλήθηκε 
 $data = mysql_query("SELECT * FROM contacts WHERE $field LIKE'%$find%'"); 
  
 //Εκτύπωση αποτελεσμάτων
 while($result = mysql_fetch_array( $data )) 
 { 
 echo '<table style="padding:10px; width:20%; border:2px solid #333;margin-left:30%;">
		<tr><td>Όνομα:"<b>'. $result['firstname'] .'</b>"</td></tr>
		
		<tr><td>Επίθετο: "<b>'. $result['lastname'] .'</b>" </td></tr>
		
		<tr><td>Tηλέφωνο: "<b>'. $result['phonenumber'] .'</b>"  </td></tr>
		
		<tr><td>Διεύθυνση: "<b>'. $result['address'] .'</b>"  </td></tr>
		</table>';
		
 } 
 
 //Μέτρηση των αποτελεσμάτων και εκτύπωση μυνήματος
 $anymatches=mysql_num_rows($data); 
 if ($anymatches == 0) 
 { 
 echo '<div id="edittitle">Συγγνώμη, δεν μπορούμε να βρούμε εγγραφή που να ταιριάζει με την αναζήτησή σας<br /><br /></div>'; 
 } 
 
 //Εκτύπωση της λέξης αναζήτησης
 echo '<table style="padding:10px; width:20%; border:2px solid #333;margin-left:30%;">
 			<tr><td><b>Λέξη αναζήτησης:</b> "' .($_POST['find']).'"</td></tr>
 		</table>'; 
 } 
 ?> 
