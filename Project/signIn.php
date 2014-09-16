<?php
session_start();
header('Cache-Control: max-age=900');
?>

<!DOCTYPE html>

<html leng = "en">
<head>
	<title> Project: Chris Portokalis </title>
	<link rel = "stylesheet" type ="text/css" href = "projStyle.css">
	<meta http-equiv="Content-Type" content="text/html" charset= "utf-8"/>
</head>

<body>
	
	<h1 id = "help"> Chris Portokalis </h1>
	
<br />
<br />
<br />

<table class = "gtable" style = "float: both">

<tr>
	<td class = "jhg">
	<form  method = "post" name = "loginform" id = "loginform">
		User Name: <input method = "post" align = "center" type = "text" name = "user"> </input> <br/>
		Password: <input  method = "post" align = "center" type = "password" name = "passw"> </input> <br/>
		User Type: <select method = "post" align = "center" id = "nada" name = "nada">
						<option> User Type </option>
						<option method = "post" name = "userT" value = "stu"> Student </option>
						<option method = "post" name = "userT" value = "instr"> Instructor </option>
						<option method = "post" name = "userT" value  = "admin"> Administrator </option>
					</select>

		<br/>
		<input type = "submit" onclick = "actionChange()" name = "login" value = "Login" method = "post"> </input> 
	
	</form>
	
	<br/> <br/>

	
	<script>
		
		function actionChange()
		{
			if(document.getElementById("nada").selectedIndex == 1)
			{
				document.getElementById("loginform").action = "stuPage.php";
			
			}
			else if(document.getElementById("nada").selectedIndex == 2)
			{
				document.getElementById("loginform").action = "instrPage.php";
			
			}
			else if (document.getElementById("nada").selectedIndex = 3)
			{
				document.getElementById("loginform").action = "adminPage.php";
			}
			else
			{
				document.getElementById("help") = "nope";
			
			}
			
		
		}
	
	
	
	</script>
	
	<?php
	
		/*if(isset($_POST['login']))
		{
				
				if($_POST['nada'] == "stu")
				{
					
					//header("Location: stuPage.php");
					$stuUser = "SELECT * FROM User WHERE student = true AND userName = '" . $user . "'";
					$table = $DB->query($stuUser);
					$row = $table->fetch_array(MYSQLI_NUM);
					
					
					if( $row[0] == $user )
					{
						$passw = $row[5] . $passw;
						$passw = hash('ripemd160', $passw);
						
						if($row[6] == $passw)
						{
						
							header("Location: stuPage.php");
							
							echo "yay!!!!!!";
						
						}
						else
						{
							echo "Incorrect User Name or Password, Try Again";
						
						}
							
					}
					else
					{
						echo "invalid User";
						echo '<br/>';
						echo $row[0];
					
					}
				
				//}
				else if($_POST['nada'] == "instr")
				{
					$instUser = "SELECT * FROM User WHERE instructor = true AND userName = '" . $user . "'";
					
					$table2 = $DB->query($instUser);
					$row = $table2->fetch_array(MYSQLI_NUM);
					
					echo "instr";
					
					if( $row[0] == $user )
					{
						$passw = $row[5] . $passw;
						$passw = hash('ripemd160', $passw);
						
						if($row[6] == $passw)
						{
							echo '<h1> yay! </h1>';
							header("Location: instrPage.php");
						
						}
						else
						{
							echo '<h1> Incorrect User Name or Password, Try Again </h1>';
						
						}
							
					}
					else
					{
						echo "invalid User";
					
					}
					
					header("Location: instrPage.php");
				}
				else if($_POST['nada'] == "admin")
				{
					
					$adminUser = "SELECT * FROM User WHERE administrator = true AND userName = '" . $user . "'";
					
					$table3 = $DB->query($adminUser);
					$row = $table3->fetch_array(MYSQLI_NUM);
								
					if( $row[0] == $user )
					{
						$passw = $row[5] . $passw;
						$passw = hash('ripemd160', $passw);
						
						if($row[6] == $passw)
						{
						
							header("Location: adminPage.php");
							echo 'yay';
						
						}
						else
						{
							echo "Incorrect User Name or Password, Try Again";
						
						}
							
					}
					
					header("Location: adminPage.php");
						
				}
		}	
				
			unset($_POST['login']);*/
			
		
		
	?>
	
	</td>
</tr>

</table>


</body>

</html>