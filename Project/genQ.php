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
	<h3> General Query </h3>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
	
		<form action = "genQ.php" method = "post">
			<textarea class = "comment" name = "query" method = "post"></textarea> <br/>
			<input type = "submit" name = "sub" method = "post" value = "Submit Query">
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
					$query = $_POST['query'];
							

							if($table = $DB->query($query))
							{
								
								echo '<table cellpadding = "10" class = "show">';
								
								genTable($table);
								
								
								
								
								
							}
							else
							{
								echo '<br/> error with query';
							}
					
				}
		
			}
	
	
		?>
	
	
	</td>
	
</tr>

</table>

</body>
</html>