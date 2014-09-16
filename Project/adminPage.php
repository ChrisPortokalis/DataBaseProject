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
	
	<h1> Chris Portokalis </h1>
	<h1> Administrator Page </h1>
	
<br />
<br />
<br />

<table class = "gtable" align = "center">

<tr>
	<td class = "jhg">
			
			
		<table class = "menu" cellpadding = "10" border = "1">
			<th bgcolor= "#585858" > Admin Features </th>
			<tr>
			<td>
			<ul> 
			<div class = "check">
				<li> <a href = "genQ.php"> General Query </a> </li>
				<li> <a href = "runFQ.php"> File Query </a> </li>
				<li> <a href = "createTables.php"> Create Tables </a> </li>
				<li> <a href = "dropTable.php"> Drop Tables </a> </li>
				<li> <a href = "NewUser.php"> New User </a> </li>
				<li> <a href = "dropUser.php"> Delete User </a> </li>
				<li> <a href = "changePass.php"> Change Password </a> </li>
				<li> <a href = "lookUp.php"> Look Up User </a> </li>
			</div>
			</ul>
			</td>
			</tr>
			<th bgcolor= "#585858" > Instructor Features </th>
			<tr>
			<td>
			<ul>
			<div class = "check">
				<li> <a href = "findInstr.php"> Instructor List </a> </li>
				<li> <a href = "classes.php"> Courses By Instructor </a> </li>
				<li> <a href = "assignClass.php"> Assign Class </a> </li>
				<li> <a href = "removeInstr.php"> Remove Instructor From Class </a> </li>
			</div>
			</ul>
			</td>
			</tr>
			<th> Student Features </th>
			<tr>
			<td>
			<ul>
			<div class = "check">
				<li> <a href = "students.php"> View Students </a> </li>
				<li> <a href = "stuClasses.php"> View Students Classes </a> </li>
			
			</div>
			</ul>
			</td>
			</tr>
			<th bgcolor = "#585858" > Class Features </th>
			<tr>
			<td>
			<ul>
			<div class = "check">
				<li> <a href = "viewClasses.php"> View Classes </a> </li>
				<li> <a href = "addClass.php"> Add Class </a> </li>
				<li> <a href = "viewPreReq.php"> View Prerequisites </a> </li>
				<li> <a href = "changePreReq.php"> Add or Delete Prerequisite </a> </li>
			</div>
			</ul>
			</td>
			<tr>
		</table>
			
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
					
					$instUser = "SELECT * FROM User WHERE administrator = true AND userName = '" . $user . "'";
					
					$table2 = $DB->query($instUser);
					$row = $table2->fetch_array(MYSQLI_NUM);
				
				
					if( $row[0] == $user )
					{
						$passw = $passw . $row[5];
						$passw= hash('sha256', $passw);
						

						if($row[6] == $passw)
						{
							$_SESSION['User'] = $user;
							$_SESSION['pass'] = $passw;
							
							$checkCreds = "SELECT student, instructor, administrator, userId FROM User WHERE userName = '". $user ."'";
							$table2 = $DB->query($checkCreds);
							$credRow = $table2->fetch_array(MYSQLI_NUM);
							
							if($credRow[0] == true)
							{
							
								$_SESSION['student'] = true;
							
							}
							if($credRow[1] == true)
							{
							
								$_SESSION['instructor'] = true;
							
							}
							if($credRow[2] == true)
							{
							
								$_SESSION['admin'] = true;
							
							
							}
							
							$_SESSION['Id'] = $credRow[3];
							
						}
						else
						{
							header("Location: signIn.php");
						
						}
							
					}
					else
					{
						header("Location: signIn.php");
					
					}
				
				}
				else
				{
					checkLogin('admin');
				
				}
		
			
			}
			
			
			
			
			if(isset($_POST['delete']))
			{
						$textfile = "dropTables.txt";
						
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
						
						echo "Tables Dropped";
			
			
			}
			else if(isset($_POST['signOut']))
			{
				session_destroy();
				header("Location: signIn.php");
			}
			else if(isset($_POST['fQuery']))
			{
			
						$textfile = $_POST['file'];
						
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
						echo '<br/> Succesful Query <br/>';
			
			}
			
			checkLogin('admin');
		
		?>
	
	</td>
	
</tr>

</table>

</body>
</html>