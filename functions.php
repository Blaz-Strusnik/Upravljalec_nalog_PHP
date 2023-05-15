<?php
	function loged_in($id,$mysqli)
	{
		$logedin = $mysqli->prepare("UPDATE users set loged_in = ? where userid = ?");
		$loged_in = 1;
		$logedin->bind_param("ii",$loged_in,$id);

		$logedin->execute();
		$logedin->close();

	}

?>