<?php

include ('header.php');

echo '<div id="edittitle"><h3>Προσθήκη Νέας Επαφής</h3></div>';

//Έλεγχος αν υποβλήθηκε η φόρμα

if (isset($_POST['submitted']))
{
   $errors=array();

  //Έλεγχος καταχώρησης Username
 
  //Έλεγχος καταχώρησης ονόματος

  if(empty($_POST['firstname']))
  {
   $errors[]='Παρακαλώ συμπληρώστε ένα όνομα ';
  }
  else
  {
   $fn=trim($_POST['firstname']);
  }

  //Έλεγχος καταχώρησης επωνύμου

  if(empty($_POST['lastname']))
  {
   $errors[]='Παρακαλώ συμπληρώστε ένα επώνυμο';
  }
  else
  {
   $ln=trim($_POST['lastname']);
  }
  
 //Έλεγχος καταχώρησης τηλεφώνου

  if(empty($_POST['phonenumber']))
  {
   $errors[]='Παρακαλώ συμπληρώστε ένα τηλέφωνό';
  }
    elseif(is_numeric($_POST['phonenumber']))
    {$ph=trim($_POST['phonenumber']);
    }
  else
  {
  	$errors[]='Παρακαλώ συμπληρώστε σωστά το τηλέφωνο';
  }
 
  //Έλεγχος καταχώρησης διεύθυνσης

  if(empty($_POST['address']))
  {
   $errors[]='Παρακαλώ συμπληρώστε μια διεύθυνση';
  }
  else
  {
   $ad=trim($_POST['address']);
  }

  // Έλεγχος του πίνακα errors
  if (empty($errors))
  {
  	//Σύνδεση με την βάση
  	 $dbc=mysqli_connect('localhost','root','' ,'address_book')or
        die ('Could not connect to mySQL:'.mysqli_connect_error());
    
        //Ερώτημα ελέγχου username
    $q="SELECT * FROM contacts WHERE firstname='$fn' AND lastname='$ln'";
     $r= mysqli_query($dbc,$q);
     $num=mysqli_num_rows($r);
          if ($num>0)
     {
     	echo "<div id='same_contact'>Η επαφή<b>$un</b>έχει ήδη καταχωρηθεί, παρακαλώ προσπαθήστε ξανά.<br /><br />
     			Για να προσπαθήσετε ξανά πατήστε <a href='add_new_contact_form.php'>εδώ</a></div>";
   
     	exit();
          }
     else
     {
     	//Εγγραφή στοιχείων στον πίνακα users
  $q="set names 'utf8'";
  $results=mysqli_query($dbc,$q) or die(mysql_error());
     	
  $q= "INSERT INTO contacts(firstname,lastname,phonenumber,address,registration_date) VALUES ('$fn','$ln','$ph','$ad',NOW())";
  $results= mysqli_query($dbc,$q);
   if ($r){
  	echo '<div id="thank_you"><h3>Σας ευχαριστούμε!</h3>Η επαφή σας καταχωρήθηκε επιτυχώς</div>';

  	//Εγγραφή στο αρχείο details.txt
  	$registration_date=date('d-m-Y H:i:s');
  	$data="Όνομα:$fn,Επώνυμο:$ln,Tηλέφωνο:$ph,Διεύθυνση:$ad,Registration Date:$registration_date";
  	$folder=($_POST['username']);
    mkdir($folder,0777);
    $file1="$folder/details.txt";
    $file2="$folder/log.txt";
    $fd=fopen("$folder/details.txt","w");
        $fl=fopen("$folder/log.txt","w");
    fputs($fd,$data);
    fclose($fd);
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
echo "<br />-Παρακαλώ προσπαθήστε <a href='add_new_contact_form.php'>ξανά</a>";
}//τελος συνθήκης empty(errors)
 
}
 
?>