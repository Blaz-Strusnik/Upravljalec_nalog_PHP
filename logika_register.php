<?php



// Ta skript je poizvedba, ki vstavi zapis v tabeli uporabnikov.

try {
	$errors = array(); // Inicializacija matrike. 
	// Preveri ime:                        
        $first_name = filter_var( $_POST['first_name'], FILTER_SANITIZE_STRING);	
	if (empty($first_name)) {
		$errors[] = 'Pozabili ste vpisati ime!';
	}
	// Preveri priimek:
	    $last_name = filter_var( $_POST['last_name'], FILTER_SANITIZE_STRING);	
	if (empty($last_name)) {
		$errors[] = 'Pozabili ste vpisati Priimek!';
	}
	// Preveri email:
	    $email = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL);	
	if  ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
		$errors[] = 'Pozabili ste vpisati email!';
		$errors[] = ' ali ste ga nepravilno vnesli.';
	}
	// Preverite geslo in ujemanje gesel:
			$password1 = filter_var( $_POST['password1'], FILTER_SANITIZE_STRING);
			$password2 = filter_var( $_POST['password2'], FILTER_SANITIZE_STRING);
	if (!empty($password1)) {
		if ($password1 !== $password2) { 
			$errors[] = 'Vaši gesli se ne ujemata.';
		} 
	} else {
		$errors[] = 'Pozabili ste vnesti geslo.';
	}
	if (empty($errors)) { // Če je vse vredu nadaljuj!.              
	// Registracija uporabnika v podatkovno bazo
	// Haširanje gesla od 60 karakterjev naprej
	    $hashed_passcode = password_hash($password1, PASSWORD_DEFAULT); 
		require ('./connection.php'); // Povezava s podatkovno bazo    
		// Poizvedba za vstavljanje podatkov uporabnika v podatkovno zbirko                                              
		$query = "INSERT INTO users (userid, first_name, last_name, email, password, registration_date) ";
		$query .="VALUES(' ', ?, ?, ?, ?, NOW() )";		                
        $q = mysqli_stmt_init($mysqli);                                  
        mysqli_stmt_prepare($q, $query);
        // Uporaba pripravljenih izjav oziorma metod da smo prepirčano da se vnaša samo text
        // poveži polja z SQL izjavo
        mysqli_stmt_bind_param($q, 'ssss', $first_name, $last_name, $email, $hashed_passcode);
     // izvedba poizvedbe
        mysqli_stmt_execute($q);
        if (mysqli_stmt_affected_rows($q) == 1) {	// pogoj da je vnešen samo en zapis		
		header ("location: ./login.php"); 
		exit();
		} else { // če se ne ujema.
		// Public message:
		    $errorstring = "<p class='text-center col-sm-8' style='color:red'>";
			$errorstring .= "System Error<br />Nismo Vas morali registrirati zaradi ";
			$errorstring .= "sistemske napake. Za nevšečnosti se Vam opravičujemo.</p>"; 
			echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
			// za razhroščevanje poizvedb
			//echo '<p>' . mysqli_error($mysqli) . '<br><br>Query: ' . $query . '</p>';
		    mysqli_close($mysqli); // Zaprtje pozvezave s podatkovno bazo.
		
			echo '<footer class="jumbotron text-center col-sm-12"
	        style="padding-bottom:1px; padding-top:8px;">
            include("noga.php"); 
            </footer>';
			//prekinitev izvedb programa
		exit();
		}
	} else { // Poročanje napak.                             
		$errorstring = "Error! <br /> The following error(s) occurred:<br>";
		foreach ($errors as $msg) { 
			$errorstring .= " - $msg<br>\n";
		}
		$errorstring .= "Please try again.<br>";
		echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
		}
		}									
   catch(Exception $e)   
   {
     // print "Pojavila se je izjema. Sporočilo: " . $e->getMessage();
     print "Sistem je zaseden prosim poskusite kasneje!";
   }
   catch(Error $e)
   {
      //print "Pojavila se je izjema. Sporočilo: " . $e->getMessage();
      print "Sistem je zaseden prosim poskusite kasneje!";
   }
?>