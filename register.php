<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon"  href="../BGlogo.png" sizes="any" type="image/svg+xml">
<title>Upravljalec nalog</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<style>

@font-face {
   font-family: myFirstFont;
   src: url('./VisbyCF_ExtraBold.ttf');
}

* {
   font-family: myFirstFont;
}

body {
	color: #fff;
	background: #ededed;
	
}
.form-control {
	font-size: 15px;
}
.form-control, .form-control:focus, .input-group-text {
	border-color: #e1e1e1;
}
.form-control, .btn {        
	border-radius: 3px;
}
.signup-form {
	width: 400px;
	margin: 0 auto;
	padding: 30px 0;		
}
.signup-form form {
	color: #999;
	border-radius: 3px;
	margin-bottom: 15px;
	background: #fff;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form h2 {
	color: #333;
	font-weight: bold;
	margin-top: 0;
}
.signup-form hr {
	margin: 0 -30px 20px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form label {
	font-weight: normal;
	font-size: 15px;
}
.signup-form .form-control {
	min-height: 38px;
	box-shadow: none !important;
}	
.signup-form .input-group-addon {
	max-width: 42px;
	text-align: center;
}	
.signup-form .btn, .signup-form .btn:active {        
	font-size: 16px;
	font-weight: bold;
	background: #0D6EFD !important;
	border: none;
	min-width: 140px;
}
.signup-form .btn:hover, .signup-form .btn:focus {
	background: #0d49fd !important;
}
.signup-form a {
	color: #fff;	
	text-decoration: underline;
}
.signup-form a:hover {
	text-decoration: none;
}
.signup-form form a {
	color: #19aa8d;
	text-decoration: none;
}	
.signup-form form a:hover {
	text-decoration: underline;
}
.signup-form .fa {
	font-size: 21px;
}
.signup-form .fa-paper-plane {
	font-size: 18px;
}
.signup-form .fa-check {
	color: #fff;
	left: 17px;
	top: 18px;
	font-size: 7px;
	position: absolute;
}
</style>
   <script src="verify.js"></script> 
</head>
<body>
<div class="container" style="margin-top:30px">


 


  <div class="row" style="padding-left: 0px;">


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {                                
 require('logika_register.php');
} 
?>
<div class="col-sm-8 signup-form">
<h2 class="h2 text-center" >Register</h2>
<form action="register.php" method="post" onsubmit="return checked();"
name="regform" id="regform">
  <div class="form-group">
			
			<div class="input-group input-group mb-3">
<span class="input-group-text" style="font-size: 1.3em;"  id="inputGroup-sizing"><i class="fas fa-user"></i></span>

<input type="text" class="form-control" id="first_name" name="first_name" 
	  placeholder="Ime" maxlength="30" required
	  value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" >

</div>
</div>
  <div class="form-group">
			
			<div class="input-group input-group mb-3">
<span class="input-group-text" style="font-size: 1.3em;"  id="inputGroup-sizing"><i class="fas fa-user"></i></span>

<input type="text" class="form-control" id="last_name" name="last_name" 
	  placeholder="Priimek" maxlength="40" required
	  value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">

</div>
</div>

  <div class="form-group">
			
				<div class="input-group input-group mb-3">
  <span class="input-group-text" style="font-size: 3em;"  id="inputGroup-sizing"><i class="fas fa-paper-plane"></i></span>
  <input type="email" class="form-control" id="email" name="email" 
	  placeholder="E-mail" maxlength="60" required
	  value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">


    </div>
  </div>
  <div class="form-group">
			
			<div class="input-group input-group mb-3">
<span class="input-group-text" style="font-size: 1.3em;"  id="inputGroup-sizing"><i class="fas fa-lock"></i></span>

<input type="password" class="form-control" id="password1" name="password1" 
	  placeholder="Geslo" minlength="8" maxlength="12" required
	  value="<?php if (isset($_POST['password1'])) echo $_POST['password1']; ?>">
	  

</div>
<span id='message'>Med 8 and 12 znakov.</span>
</div>
<div class="form-group">
			
			<div class="input-group input-group mb-3">
<span class="input-group-text" style="font-size: 1.3em;"  id="inputGroup-sizing"><i class="fas fa-lock"></i></span>


<input type="password" class="form-control" id="password2" name="password2" 
	  placeholder="Potrdi geslo" minlength="8" maxlength="12" required
	  value="<?php if (isset($_POST['password2'])) echo $_POST['password2']; ?>">

</div>
<span id='message'>Med 8 and 12 znakov.</span>
</div>


<div class="form-group row">
    <div class="col-sm-12">
	<input id="submit" class="btn btn-primary" type="submit" name="submit" value="Register">
    </div>
	</div>
	<?php include('register_glava.php'); ?>
	</form>
</div>
<footer>
<?php


  include('noga.php'); 
 ?>

</footer>


</div>
</body>
</html>
<?php

if(isset($_POST['signup']))
{

$fname=$_POST['fullname'];	
$email=$_POST['email'];	
$mobile=$_POST['mobilenumber'];	
$pass=password_hash($_POST['password'], PASSWORD_DEFAULT); 	

$result ="SELECT count(*) FROM tblusers WHERE EmailId=?";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('s',$email);$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if($count>0)
{
echo "<script>alert('E-poštni ID je že povezan z drugim računom. Poskusite z drugim e-poštnim ID-jem.');</script>";
} 

else {
$sql="INSERT into tblusers(FullName,EmailId,MobileNumber,Password)VALUES(?,?,?,?)";
$stmti = $mysqli->prepare($sql);
$stmti->bind_param('ssis',$fname,$email,$mobile,$pass);
$stmti->execute();
$stmti->close();

echo "<script>alert('Registracija uporabnika je uspela!');</script>";
}
}

?>

