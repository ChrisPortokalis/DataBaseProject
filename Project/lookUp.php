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
	<h3> Look Up User</h3>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
	
		<form action = "lookUp.php" method = "post">
		<div class = "check">
			User<input type = "text" name = "user" method = "post"> <br/>
		</div>
			<br/>
			
			<input type = "submit" value = "Look Up User" name = "sub" /> <br/>
			<br/>
			<br/>
			<br/>
			
		</form>
	
		<?php
		
			$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
			$dbpass = trim($fileText);
			
			$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
		
			if(isset($_POST['sub']))
			{
				$user = $_POST['user'];
				
				if(mysqli_connect_error())
				{
					echo 'connection error <br/>';
				
				}
				else
				{
					$q = "SELECT * FROM User WHERE userName LIKE '" . (string)$user . "%'";
						
					
					if($table = $DB->query($q))
					{
						echo ' <br/> <br/>';
						echo "<table class = 'show' style = 'font-size:10px' align = 'center' border = '1' cellpadding = '10' >";
						echo "<th> userName </th> <th> userID </th> <th> student </th> <th> instructor </th> <th> admin </th> <th> salt </th> <th> hash </th>";
						genTable($table);
					}
					else
					{
						echo '</br> <br/> Unable to find user matching: ' . $user;
					
					}
					
					
				}
		
			}
	
	
		?>
	
	
	</td>
	
</tr>

</table>

</body>
</html>