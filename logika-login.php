<?php 
/*
if($_SESSION['loged_in'] == 1 &&  'Query login_date' - 'php_funkcija_date_now' > 7 )
{
  // datume v pravi format
  // dobiti razliko dveh datumov
  // Iz te razlike dobiti število dni
// Izvede logout, počisti uporabnikovo prijavo in ga preusmeri na prijavno okno
}
*/


require_once('connection.php');
require_once('functions.php');
//require_once('login.php');
  //$logedin = null;
  // Ta razdelek obdeluje oddaje iz obrazca za prijavo
  // Preverite, ali je bil obrazec oddan: 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
try {

// Potrdi e-poštni naslov
// Preverite e-poštni naslov:
	    $email = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL);	
	if  ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
		$errors[] = 'Pozabili ste vpisati email';
		$errors[] = ' ali ste ga narobe vnesli';
	}
// Validacija gesla
	    $password = filter_var( $_POST['password'], FILTER_SANITIZE_STRING);	
	if (empty($password)) {
		$errors[] = 'Pozabili ste vpisati geslo!';
	}
   if (empty($errors)) { // Če je vse v redu. #1
    // pridobi user_id, password, first_name
    // za kombinacijo e-pošte/gesla
 $query = "SELECT userid, password, first_name FROM users WHERE email=?";
      $q = mysqli_stmt_init($mysqli);
      mysqli_stmt_prepare($q, $query);

        // bind $id to SQL Statement
	  mysqli_stmt_bind_param($q, "s", $email); 

       // execute query
	   
       mysqli_stmt_execute($q);

$result = mysqli_stmt_get_result($q);

$row = mysqli_fetch_array($result, MYSQLI_NUM);
if (mysqli_num_rows($result) == 1) {
//če se ena vrstica baze podatkov (zapis) ujema z vnosom:-
// Začnite sejo, pridobite zapis in vstavite
// vrednosti v matriki
/*

*/

if (password_verify($password, $row[1])) {
  //Preveri če je vrednost stolpca 0(to pomeni da je uporabnik izpisan)
  //uporabi funkcijo loged_in() iz naloga.php, ki sprejme dva argumenta
  //in sicer id uporabnika(oziroma v tem primeru prvi element v arrayu)
  //kot drugi argument pa poizvedbo UPDATE kis spremeni vrednost iz 0 v 1
  session_start();

if ($row['loged_in'] == 0){
  $id = $row[0];
  loged_in($id,$mysqli);
}		



		


		

	
header('Location: naloga.php'); 
} else { // geslo se ne ujema s podatki v podatkvni bazi
  
$errors[] = 'Email ali geslo se ne ujema s podatki v podatkvni bazi. ';
$errors[] = 'Morda je potrebna registracija';


}
} else { // Email se ne ujema s podatki v podatkvni bazi
$errors[] = 'Email ali geslo se ne ujema s podatki v podatkvni bazi. ';
$errors[] = 'Morda je potrebna registracija ';
}
}
if (!empty($errors)) {                     
		$errorstring = "Error! <br /> Ta napak se je pojavila:<br>";
		foreach ($errors as $msg) { 
			$errorstring .= " $msg<br>\n";
		}
		$errorstring .= "Prosim poskusite znova.<br>";
		echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
		}
mysqli_stmt_free_result($q);
mysqli_stmt_close($q);
}
 catch(Exception $e)  
   {
     // print "Pojavila se je napaka. Sporočilo: " . $e->getMessage();
     print "Sistem je zaseden prosim poskusite znova!";
   }
   catch(Error $e)
   {
      //print "Pojavila se je napaka. Sporočilo: " . $e->getMessage();
      print "Sistem je zaseden prosim poskusite znova!";
   }
} 
?>