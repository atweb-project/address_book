<?php ob_start(); ?>
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
  
   }
//Έλεγχος του πίνακα errors
  if (empty($errors))
  {
  	//Σύνδεση με την βάση
  	 $dbc=mysqli_connect('localhost','root','' ,'address_book')or
        die ('Could not connect to mySQL:'.mysqli_connect_error());
    
        //Ερώτημα ελέγχου username και password 
     $q="SELECT * FROM users WHERE username='$un'AND password=SHA1('$p')";
     $r= mysqli_query($dbc,$q);
     $num=mysqli_num_rows($r);
          if ($num>0)
     {
     	//Έναρξη session
     	session_start();
     	$_SESSION['username']=$_POST['username'];
     	$_SESSION['password']=SHA1($_POST['password']);
     	$_SESSION['user_id']=$_POST['id'];
     	
     	 
   		
     	//Ανακατεύθυνση στο loggedin.php
     	header('Location:control_panel.php');
     	exit();
          }     else
     {
     	//Εκτύπωση μυνήματος σφάλματος
  		echo "<h1>Λάθος username ή password </h1>Δεν μπορείτε να συνδεθείτε<p>Παρακαλώ προσπαθήστε <a href='index.php'>ξανά</a></p>";
       
     }       
      //Κλείσιμο σύνδεσης με την βάση
       mysqli_close($dbc);
     }
  
else
{    
//Αναφορά σφαλμάτων
echo'<h2>Σφάλμα!</h2>';
foreach($errors as $msg)
{
  echo"-$msg<br />\n";
}
echo "<br />-Παρακαλώ προσπαθήστε <a href='index.php'>ξανά</a>";
}
 

 
?>
	
	</div>
</div>
</body>
</html>

<?php ob_flush(); ?>
