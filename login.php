
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon"  href="../BGlogo.png" sizes="any" type="image/svg+xml">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Upravljalec nalog</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
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
	font-family: myFirstFont;
	
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



<?php


session_start();
require_once('connection.php');
//include('naloga.php');

/*
if (isset($_POST['submit'])) {
	 
	loged_in($id,$mysqli);
}
*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                                //#1
 require('logika-login.php');
}
?>
<div class="col-sm-8 signup-form">
<h2 class="h2 text-center">Login</h2>
<form action="login.php" method="post" name="loginform" id="loginform">
<div class="form-group">
			
				<div class="input-group input-group mb-3">
  <span class="input-group-text" style="font-size: 3em;"  id="inputGroup-sizing"><i class="fas fa-paper-plane"></i></span>
  <input type="text" class="form-control" id="email" name="email" 
	  placeholder="Email" maxlength="30" required
	  value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" >


    </div>
  </div>
  <div class="form-group">
			
				<div class="input-group input-group mb-3">
  <span class="input-group-text" style="font-size: 1.3em;" id="inputGroup-sizing"><i class="fas fa-lock"></i></span>
  <input type="password" class="form-control" id="password" name="password" 
	  placeholder="Geslo" maxlength="40" required
	  value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
</div>

	  
    
    <span>&nbsp;Med 8 and 12 znakov.</span></p>
  </div>
  <?php
  

  ?>			<?php 
  $sql = $mysqli->prepare("SELECT * FROM users ORDER BY loged_in LIMIT 1");
  $sql->execute();
  $result = $sql->get_result();
  //pridobi vse uporabnike razvrščene po userid jih izpiše
  // in prikaže tistega ki ima v podatkovni bazi loed_in vrednost 1 
  if ($result->num_rows > 0) { ?>

  <?php while($login = $result->fetch_assoc()){ ?>
	  <?php if ($login['loged_in'] == 0) {?>
	  

  <div class="form-group">
	<input id="submit" class="btn btn-primary btn-lg" type="submit" name="submit" value="Login">
	<?php } ?>
	  
	  <?php }?>
	  <?php }?>
    </div>
<?php include('login_glava.php'); ?>

	</div>
	
	</form>
</div>


<?php

  include('noga.php'); 
 ?>
</footer>
</div>

</body>
</html>
