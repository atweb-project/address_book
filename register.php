<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>My Address Book</title>
<link type="text/css" href="style.css" rel="stylesheet">
</head>
<body>
	<div id="content-box">
		<div id="internal">
			<h2>Καλώς ήρθατε στο προσωπικό σας Address book</h2>
			<img alt="" src="addressbook_image.png">

<?php
//Έλεγχος αν υποβλήθηκε η φόρμα

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

  // Έλεγχος του πίνακα errors
  if (empty($errors))
  {
  	//Σύνδεση με την βάση
  	 $dbc=mysqli_connect('localhost','root','' ,'address_book')or
        die ('Could not connect to mySQL:'.mysqli_connect_error());
    
        //Ερώτημα ελέγχου username
    $q="SELECT * FROM users WHERE username='$un'";
     $r= mysqli_query($dbc,$q);
     $num=mysqli_num_rows($r);
          if ($num>0)
     {
     	echo "<div id='same_user'>Το username <b>$un</b> χρησιμοποποιείται, παρακαλώ ξαναεπιλέξτε username.</div>
     			<div id='a_try_again'>Για να προσπαθήσετε ξανά πατήστε <a href='registration_form.php'>εδώ</a></div>";
   
     	exit();
          }
     else
     {
     	//Εγγραφή στοιχείων στον πίνακα users
  $q="set names 'utf8'";
  $results=mysqli_query($dbc,$q) or die(mysql_error());
     	
  $q= "INSERT INTO users(username,password,email,registration_date) VALUES ('$un',SHA1('$p'),'$e',NOW())";
  $results= mysqli_query($dbc,$q);
   if ($r){
   	
   	 session_start();
   	     $_SESSION['username']=$un;
         $_SESSION['password']=$p;
         $_SESSION['email']=$e;
  	echo "<h2>Σας ευχαριστούμε!</h2>Η εγγραφή σας είναι επιτυχής<br /><br />
  			<div id=to_continue>Για να κάνετε login πατήστε <a href='index.php'>εδώ</a>";

  	
   }
       else
      {
       echo '<h1>System error</h1>';
      //μήνυμα αποσφαλμάτωσης
       echo'<p>' .mysqli_error($dbc) .'<br /><br />Query:' .$q .'</p>';
       } 
       //Κλείσιμο σύνδεσης με την βάση
       mysqli_close($dbc);
     }
  }
else
{    
//αναφορά σφαλμάτων
echo'<h2>Σφάλμα!</h2>';
foreach($errors as $msg)
{
  echo"-$msg<br />\n";
}
echo "<br />-Παρακαλώ προσπαθήστε <a href='registration_form.php'>ξανά</a>";
}//τελος συνθήκης empty(errors)
 
}
 
?>

		</div>
	</div>
</body>
</html>

