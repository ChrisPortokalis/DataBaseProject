<!DOCTYPE html>
<?php 
	  session_start();
	  require("projFuncs.php");
	  menuBar();
	  header('Cache-Control: max-age=900');
	  
?>

<html leng = "en">
<head>
	<title> Project: Chris Portokalis </title>
	<link rel = "stylesheet" type ="text/css" href = "projStyle.css">
	<meta http-equiv="Content-Type" content="text/html" charset= "utf-8"/>
</head>

<body>
	<?php 
		if(isset($_POST['user']))
		{
			studentInfo($_POST['user']);
		}
		else if(isset($_SESSION['User']))
		{
			studentInfo($_SESSION['User']);
		}
	
	?>
	
	<h1> Chris Portokalis </h1>
	<h1> Student Page </h1>
<br />
<br />
<br />

<table class = "gtable" align = "center">
<tr>
	<td class = "jhg">
		<table class = "menu" border = "1">
			<th> Menu </th>
			<tr> 
				<td>
					<ul>
						
						<div class = "check">
						<li> <a href = "viewSchedule.php"> View Schedule</a></li>
						<li> <a href = "stuChangePass.php"> Change Password </a></li>
						<li> <a href = "enroll.php"> Enroll </a>  </li>
						<li> <a href = "unenroll.php"> Unenroll </a> </li>
						<li> <a href = "grades.php"> Grades </a>  </li>
						</div>
						
					
					</ul>
				</td>
			
			</tr>
		</table>
		</div>
		
		<br/>
		
		<br/>
		<br/>
		

		<br/>
	
		<?php
			

			
			$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
			$dbpass = trim($fileText);
			
			$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
			

					
		if(mysqli_connect_error())
		{
		
		}
		else
		{
		
			if(!isset($_SESSION['User']))
			{
				$user = $_POST['user'];
				$passw = $_POST['passw'];
				$stuUser = "SELECT * FROM User WHERE student = true AND userName = '" . $user . "'";
				$table = $DB->query($stuUser);
				$row = $table->fetch_array(MYSQLI_NUM);
						
				if( $row[0] == $user )
				{
					$passw = $passw . $row[5];
					$passw = hash('sha256', $passw);
							
					if($row[6] == $passw)
					{
						$_SESSION['User'] = $user;
						$_SESSION['pass'] = $passw;
						
						$checkCreds = "SELECT userId, student, instructor, administrator FROM User WHERE userName = '". $user ."'";
						$table2 = $DB->query($checkCreds);
						$credRow = $table2->fetch_array(MYSQLI_NUM);
						
						if($credRow[1] == 1)
						{
						
							$_SESSION['student'] = true;
						
						}
						if($credRow[2] == 1)
						{
						
							$_SESSION['instructor'] = true;
						
						}
						if($credRow[3] == 1)
						{
						
							$_SESSION['admin'] = true;
						
						}
						
						$_SESSION['Id'] = $credRow[0];
						
					}
					else
					{
						header("Location: signIn.php");
						echo 'bad pass';
					}
								
				}
				else
				{
					echo "invalid User";
					echo '<br/>';
					echo $row[0];
					header("Location: signIn.php");
						
				}
			}
			
			
		}
		
		if(isset($_POST['signOut']))
		{
				session_destroy();
				header("Location: signIn.php");
		}
		
		checkLogin('student');
		
		
		?>
	
	
	
	</td>
	
</tr>

</table>

</body>
</html>