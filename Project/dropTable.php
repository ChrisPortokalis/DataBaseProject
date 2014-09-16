<!DOCTYPE html>

<?php require("projFuncs.php");
	  session_start();
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
	
	<h3> Chris Portokalis </h3>
	<h3> Drop Table</h3>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">	
	
		<form action = "dropTable.php" method = "post">
			<input type = "submit" name = "sub" method = "post" value = "Drop Tables">
		</form>
	
		<?php
		
			$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
			$dbpass = trim($fileText);
			
			$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
		
			if(isset($_POST['sub']))
			{
				
				
				
				if(mysqli_connect_error())
				{
					echo 'connection error <br/>';
				
				}
				else
				{
						$textfile = "dropTables.txt";
						
						$text = file_get_contents($textfile, FILE_USE_INCLUDE_PATH);
						$dropBool = true;
						$error = "";
					
						$queries = explode(";", $text);
						
						foreach($queries as $qoff)
						{
							$qoff = trim($qoff) . ";";
					
							if($qoff != ";")
							{
								if(!$DB->query($qoff))
								{
									$dropBool = false;
								}
							
							}
						
							
						}
	
						if($dropBool)
						{
							echo '<br/> Tables Dropped';
						
						}
						else
						{
							echo '<br/> error dropping Tables';
						}
	
				}
		
			}
	
	
		?>
	
	
	</td>
	
</tr>

</table>

</body>
</html>