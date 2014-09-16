<!DOCTYPE html>

<?php 
	session_start();
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
	
	<h3> Chris Portokalis </h3>
	<h3> File Query </h3>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
	
		<form action = "runFQ.php" method = "post">
			<input type = "text" name = "fQuery" method = "post" > <br/>
			<input type = "submit" value = "File Query" name = "sub" /> <br/>
			
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
					$textfile = $_POST['fQuery'];
						
					$text = file_get_contents($textfile, FILE_USE_INCLUDE_PATH);
					
					$queries = explode(";", $text);
						
					foreach($queries as $qoff)
					{
						$qoff = trim($qoff) . ";";
					
						if($qoff != ";")
						{
							$DB->query($qoff);		
							
						}
						
							
					}
	
	
						echo '<br/> Submitted Queries';
	
				}
		
			}
	
	
		?>
	
	
	</td>
	
</tr>

</table>

</body>
</html>