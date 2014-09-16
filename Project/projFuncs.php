<?php

	function checkLogin($userType)
	{
			if(!isset($_SESSION['User']))
			{
				
				header("Location: signIn.php");
				echo 'wrong login';
												
			}
			else if($_SESSION[$userType] != true)
			{
			
				header("Location: signIn.php");
				
				echo 'no creds';
			}
			
	}
	
	function LogOut()
	{
		if(isset($_POST['signOut']))
		{
			session_destroy();
			header("Location: signIn.php");
		}
	}
	
	
	function genTable($table)
	{
		while($content = $table->fetch_array(MYSQLI_NUM))
		{
			echo "<tr>";
			foreach($content as $key => $value)
			{
				echo "<td>" . $value . "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	
	}
	
	function cacheCheck()
	{
		header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
		header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
		header("Cache-Control: post-check=0, pre-check=0",false);
		session_cache_limiter("must-revalidate");
	
	}
	
	function studentInfo($user)
	{
		$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
		$dbpass = trim($fileText);
			
		$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
		
		//$user = $_SESSION['Id'];
		
		
		
		$q = "SELECT * FROM Student WHERE userId IN (SELECT userId FROM User WHERE userName = '" . $user . "')";
		
		
		$table = $DB->query($q);
		
		$row = $table->fetch_array(MYSQLI_ASSOC);
		
		
		$_SESSION['name'] = $row['name'];
		$_SESSION['major'] = $row['major'];
		$_SESSION['year'] = $row['year'];
		$_SESSION['userId'] = $row['userId'];
		
		
	
		echo "<div class = 'sInfo'> <b> Name: </b>";
		echo $_SESSION['name'];
		echo " <br/> <b> User Id: </b>";
		echo $_SESSION['userId'];
		echo " <br/> <b> Major: </b> ";
		echo $_SESSION['major'];
		echo " <br/> <b> Year: </b>";
		echo $_SESSION['year'];
		echo "</div>";
		
	}
	
	function instrInfo($user)
	{
		$fileText = file_get_contents('../../dbpass.txt', FILE_USE_INCLUDE_PATH);
		$dbpass = trim($fileText);
			
		$DB = new mysqli("cs.okstate.edu","portoka", $dbpass, "portoka");
		
		//$user = $_SESSION['Id'];
		
		
		
		$q = "SELECT * FROM Instructor WHERE userId IN (SELECT userId FROM User WHERE userName = '" . $user . "')";
		
		
		$table = $DB->query($q);
		
		$row = $table->fetch_array(MYSQLI_ASSOC);
		
		
		$_SESSION['name'] = $row['name'];
		$_SESSION['department'] = $row['department'];
		$_SESSION['userId'] = $row['userId'];
		
		
	
		echo "<div class = 'sInfo'>";
		echo " <br/> <b> User Id: </b>";
		echo $_SESSION['userId'];
		echo " <br/> <b> Name: </b> ";
		echo $_SESSION['name'];
		echo " <br/> <b> Department: </b>";
		echo $_SESSION['department'];
		echo "</div>";
	
	
	}
	
	
	
	
	function menuBar()
	{
		echo '<div class = "top"> ';
		echo  '<form method = "post" action = "signOut.php"> ';
		echo 	'<input type = "submit" value = "Log Out" name = "signOut" method = "post"/> ';
		echo ' </form> </div> ';
		echo '<br/> <br/> <br/>';
	}
	

?>