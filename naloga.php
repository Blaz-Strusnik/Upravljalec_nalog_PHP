<?php

//require_once('./logika-login.php');



require('./connection.php');
/*

$sql = $mysqli->prepare("SELECT userid FROM users where loged_in=1");
$sql->execute();
$result = $sql->get_result();
//pridobi vse uporabnike razvrščene po userid jih izpiše
// in prikaže tistega ki ima v podatkovni bazi loed_in vrednost 1 
if ($result->num_rows > 0) { 

 while($login = $result->fetch_assoc()){ 

	 if ($login[1] == 1) {
		header ("location:naloga.php");
	 }else{
		header ("location:naloga.php"); 
	 }

	 }
	}
	*/


/*
if($_SESSION['logedin']=== false){
	$_SESSION['logedin']= true;
	
}else if($_SESSION['logedin']){
	header("location:naloga.php");	
}

if(isset($_POST['log_out'])){
	$_SESSION['loggedin'] = false;
	header("location:logout.php");
}



else{
	$_SESSION['logedin'] = true;
	header("location:naloga.php");
}
*/






$id = '';
if (isset($_POST['naloga']) && empty($_POST['id']) && isset($_POST['date-of-birth'])) {
	$naloga =	$_POST['naloga'];
	$date = date('Y-m-d H:i:s', strtotime($_POST['date-of-birth']));
	if (!empty($naloga)) {
		vpisNaloge($naloga, $date, $mysqli);
		echo '<div class="alert alert-success" role="alert">Naloga in datum uspešno vnešena!</div>';
	} else {
		echo '<div class="alert alert-danger" role="alert">Prosim vnesite nalogo in datum!</div>';
	}
}




if (isset($_POST['naloga']) && !empty($_POST['id'])) {
	$id  =  $_POST['id'];
	$naloga = $_POST['naloga'];
	$date = date('Y-m-d H:i:s', strtotime($_POST['date-of-birth']));
	posodobiNalogo($id, $naloga, $date, $mysqli);
	echo '<div class="alert alert-success" role="alert">Naloga in datum posodobljena!</div>';
}

if (isset($_GET['izbris_id'])) {
	$id = $_GET['izbris_id'];
	izbrisNaloge($id, $mysqli);
	echo '<div class="alert alert-danger" role="alert">Naloga in datum izbrisana!</div>';
}
if (isset($_GET['oznaci_id'])) {
	$id = $_GET['oznaci_id'];
	opravljenaNaloga($id, $mysqli);
	echo '<div class="alert alert-success" role="alert">Naloga opravljena!</div>';
}
if (isset($_GET['neoznaci_id'])) {
	$id = $_GET['neoznaci_id'];
	neopravljenaNaloga($id, $mysqli);
	echo '<div class="alert alert-danger" role="alert">Neopravljena naloga!</div>';
}
/*
if (isset($_GET['loged_out'])) {
	$id = $_GET['loged_out'];
	loged_in($id, $mysqli);
	echo '<div class="alert alert-success" role="alert">Vpisali ste se!</div>';
}
*/
/*
if (isset($_GET['loged_out'])) {
	$id = $_GET['loged_out'];
	loged_out($id, $mysqli);
	echo '<div class="alert alert-danger" role="alert">Odjava!</div>';
}
*/
if (isset($_GET['loged_out_2'])) {
	$id = $_GET['loged_out_2'];
	loged_out($id, $mysqli);
	
	
	
}



function vpisNaloge($naloga, $date, $mysqli)
{

	$vpis = $mysqli->prepare("INSERT INTO naloge set naloga = ?,  dt = ? ");
	$vpis->bind_param("ss", $naloga, $date);
	$vpis->execute();
	$vpis->close();
}



function izbrisNaloge($id, $mysqli)
{

	$izbris = $mysqli->prepare("DELETE FROM naloge WHERE id = ? ");
	$izbris->bind_param("i", $id);
	$izbris->execute();
	$izbris->close();
}


function opravljenaNaloga($id, $mysqli)
{
	$opravljen = $mysqli->prepare("UPDATE naloge set opravljena = ? where id = ?");
	$opravljena = 1;
	$opravljen->bind_param("ii", $opravljena, $id);

	$opravljen->execute();
	$opravljen->close();
}
function neopravljenaNaloga($id, $mysqli)
{
	$opravljen = $mysqli->prepare("UPDATE naloge set opravljena = ? where id = ?");
	$opravljena = 0;
	$opravljen->bind_param("ii", $opravljena, $id);

	$opravljen->execute();
	$opravljen->close();
}

function loged_in($id, $mysqli)
{
	$logedin = $mysqli->prepare("UPDATE users set loged_in = ? where userid = ?");
	$loged_in = 1;
	$logedin->bind_param("ii", $loged_in, $id);

	$logedin->execute();
	$logedin->close();
}
function loged_out($id, $mysqli)
{
	$logedout = $mysqli->prepare("UPDATE users set loged_in = ? where userid = ?");
	$loged_out = 0;
	$logedout->bind_param("ii", $loged_out, $id);

	$logedout->execute();
	$logedout->close();
	header("location:logout.php");
	
}

function GetNalogo($id, $mysqli)
{

	$get = $mysqli->prepare("SELECT* FROM naloge WHERE id = ? ");
	$get->bind_param("i", $id);
	$get->execute();
	$result = $get->get_result();
	if ($result == true) {
		return	$result->fetch_assoc();
	} else {
		return false;
	}
}
if (isset($_POST['posodobi'])) {
	$id = $_POST['posodobi_id'];
	$data = GetNalogo($id, $mysqli);
}
function posodobiNalogo($id, $naloga, $date, $mysqli)
{
	$update = $mysqli->prepare("UPDATE naloge SET naloga = ?, dt = ? WHERE id = ? ");
	$update->bind_param("ssi", $naloga, $date, $id);

	$update->execute();
	$update->close();
}
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Upravljalec nalog</title>
	<style>
		@font-face {
			font-family: myFirstFont;
			src: url(VisbyCF_ExtraBold.ttf);
		}

		* {
			font-family: myFirstFont;
		}

		.element::-webkit-input-placeholder {
			color: black !important;
			font-weight: bold !important;
		}

		/*
      h3#font {
        font-family: 'Visby ExtraBold';
      }
*/
		body {
			background: #ededed !important;
		}
	</style>
	<link rel="stylesheet" href="build/jquery.datetimepicker.min.css">
	<link rel="icon" href="BGlogo.png" sizes="any" type="image/svg+xml">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/1ba105315c.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fruktur">

</head>

<body>

	<div class="container mt-3 mb-3">
		<div class="row justify-content-center">
			<form method="POST" action="naloga.php">
				<!--<input type="submit" name="loged_in"  value="Odjava" />-->
				<!--<button  type="text"class="btn btn-primary btn-lg" onclick="location.href = '/blaz/Upravljalec_nalog/login/logout.php'">Odjava</button>-->
				<a href='logout.php'>Odjava</a>
			</form>
		</div>
	</div>

	<?php
	$sql = $mysqli->prepare("SELECT * FROM users ORDER BY userid DESC");
	$sql->execute();
	$result = $sql->get_result();
	//pridobi vse uporabnike razvrščene po userid jih izpiše
	// in prikaže tistega ki ima v podatkovni bazi loed_in vrednost 1 
	//V naloga.php prikaže ime uporabnikov ki imajo vrednost loged_in 1
	if ($result->num_rows > 0) { ?>
		<div class="container mt-5 mb-5">
			<div class="row justify-content-center">
				<div class="table-responsive-sm">
					<table class="table table-striped">
						<?php while ($login = $result->fetch_assoc()) { ?>
							<?php if ($login['loged_in'] == 1) { ?>
								<a href='naloga.php?loged_out_2=<?php echo $login['userid']; ?>'><i class="btn btn-primary btn-lg"><?php echo $login['first_name']; ?></i></a>

							<?php } ?>

						<?php } ?>
					<?php } ?>








					<div class="container mt-5 mb-5">
						<div class="row justify-content-center">
							<h3 id="font" class="text-center text-primary mb-5"><img src="Blogo.svg" height="150" width="250" /></h3>
							<form method="post" id="form" action="naloga.php">

								<div class="row g-3 align-items-center">
									<div class="col-xs-auto">
										<input type="text" class="form-control" name="naloga" placeholder="ustvari novo nalogo" value="<?php if (isset($_POST['posodobi_id'])) {
																																			echo $data['naloga'];
																																		}  ?>">
									</div>

									<div class="col-xs-auto">
										<input id="datetimepicker" type='text' class="form-control" autocomplete="off" name="date-of-birth" value="<?php if (isset($_POST['posodobi_id'])) {
																																						$date_2 = date('j.n.Y G:i', strtotime($data['dt']));
																																						echo  $date_2;
																																					} else {
																																						echo 'Datum';
																																					}  ?>" />
									</div>
									<div class="col-xs-auto">
										<input type="hidden" class="input-group" name="id" value="<?php if (isset($_POST['posodobi_id'])) {
																										echo $data['id'];
																									}  ?>">
										<input class="btn-sm btn-outline-primary input-group" id="btnSubmit" type="submit" value="Ok">
									</div>
								</div>



							</form>
						</div>
					</div>
					<?php
					$sql = $mysqli->prepare("SELECT * FROM naloge ORDER BY id DESC");
					$sql->execute();
					$result = $sql->get_result();

					if ($result->num_rows > 0) { ?>
						<div class="container mt-5 mb-5">
							<div class="row justify-content-center">
								<div class="table-responsive-sm">
									<table class="table table-striped">
										<?php while ($naloge = $result->fetch_assoc()) { ?>


											<tbody>
												<tr>
													<td><?php echo '<p>' . $naloge['naloga'] . '</p>'  ?></td>
													<td>
														<form class="form" method="post" action="naloga.php">
															<input type="hidden" name="posodobi_id" value="<?php echo $naloge['id']; ?>">
															<input class="form-control-plaintext text-primary" type="submit" value="Spremeni" name="posodobi">
													<td><?php $date_1 = date('j.n.Y G:i', strtotime($naloge['dt']));
														echo  $date_1;  ?></td>
													</form>
													</td>
													<td><?php if ($naloge['opravljena'] == 1) { ?>
															<a href='naloga.php?neoznaci_id=<?php echo $naloge['id']; ?>'><i class="fa fa-check text-success"></i></a>
														<?php } else { ?>
															<a href='naloga.php?oznaci_id=<?php echo $naloge['id']; ?>'><i class="fa fa-check text-danger"></i></a>
														<?php } ?>
													</td>
													<td><a href='naloga.php?izbris_id=<?php echo $naloge['id']; ?>'><i class="fa fa-trash text-primary" aria-hidden="true"></i></a></td>
												</tr>
											</tbody>

									<?php }
									}
									?>
									</table>
								</div>
							</div>
						</div>
						<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
						<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
						<script src="build/jquery.datetimepicker.min.js" charset="UTF-8"></script>
						<script src="build/jquery.datetimepicker.full.min.js" charset="UTF-8"></script>
						<script>
							jQuery.datetimepicker.setLocale('sl');
							jQuery('#datetimepicker').datetimepicker({
								dayOfWeekStart: '1',
								format: 'd.m.Y H:i',
							});

							if (window.history.replaceState) {
								window.history.replaceState(null, null, window.location.href);
							}

							setTimeout(function() {
								//$('.alert').hide();
								$('.alert').fadeOut(3000);

							}, 2500);
						</script>
</body>

</html>