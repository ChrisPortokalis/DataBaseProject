<!DOCTYPE html>
<?php session_start();
	  require("projFuncs.php");
	  checkLogin('admin');
	  menuBar();
?>
<html leng = "en">
<head>
	<title> Project: Chris Portokalis </title>
	<link rel = "stylesheet" type ="text/css" href = "projStyle.css">
	<meta http-equiv="Content-Type" content="text/html" charset= "utf-8"/>
</head>

<body>
	
	<h1> Chris Portokalis </h1>
	<h1> Students </h1>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
		<br/>
		<br/>
		
		<?php
			
			$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
			$dbpass = trim($fileText);
			
			$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
			
			
			$create2 = "SELECT * FROM Student";
			
			$table = $DB->query($create2);
			
			echo "<table class = 'show' align = 'center' border = '1' cellpadding = '10' >";
			echo "<th> name </th> <th> userId </th> <th> major </th> <th> year </th>";
			
			genTable($table);
			
			echo '<br/> <br/> <br/>';
		
		
		
		
		
		?>
	</td>
<tr>