<!DOCTYPE html>
<?php
	session_start();
	 require("projFuncs.php");

	menuBar();
?>

<<html leng = "en">
<head>
	<title> Project: Chris Portokalis </title>
	<link rel = "stylesheet" type ="text/css" href = "style3.css">
	<meta http-equiv="Content-Type" content="text/html" charset= "utf-8"/>
</head>

<body>
	
	<h2> Chris Portokalis </h2>
	
	<?php
	
		$user = "portoka";
		$password = "dIyJPKC";
	
		$dbase = new mysqli("cs.okstate.edu", $user, $password, $user);
		
		if(mysqli_connect_error())
		{
			//header("Location: https://localhost/sudoku2/");
						
						
				echo "Table not created try again";
						
		}
		else
		{
		
		
			$create = "CREATE TABLE User (userName VARCHAR(200), userId INT, student BIT, instructor BIT, administrator BIT, salt VARCHAR(200), passwordHash VARCHAR(200))";
			
			$dbase->query($create);
			
			echo 'Success';
			
		}
	
	?>
	
<br />
<br />
<br />

</body>
</html>
	