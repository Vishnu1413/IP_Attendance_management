<?php

if(isset($_POST['login']))
{
	//start of try block

	try{

		//checking empty fields
		if(empty($_POST['username'])){
			throw new Exception("Username is required!");
			
		}
		if(empty($_POST['password'])){
			throw new Exception("Password is required!");
			
		}
		//establishing connection with db and things
		include ('connect.php');
		
		//checking login info into database
		$row=0;
		$result=mysql_query("select * from admininfo where username='$_POST[username]' and password='$_POST[password]' and type='$_POST[type]'");

		$row=mysql_num_rows($result);

		if($row>0 && $_POST["type"] == 'teacher'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: teacher/index.php');
		}

		else if($row>0 &&  $_POST["type"] == 'student'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: student/index.php');
		}

		else if($row>0 && $_POST["type"] == 'admin'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: admin/index.php');
		}

		else{
			throw new Exception("Username,Password or Role is wrong, try again!");
			
			header('location: login.php');
		}
	}

	//end of try block
	catch(Exception $e){
		$error_msg=$e->getMessage();
	}
	//end of try-catch
}

?>

<!DOCTYPE html>
<html>
<head>

	<title>Online Attendance Management System</title>
	<link rel="stylesheet" type="text/css" href="./asserts/css/istyle.css" />
</head>

<body>
<center>


<?php
//printing error message
if(isset($error_msg))
{
	echo $error_msg;
}
?>

<!-- Old Version -->
<!-- 
<form action="" method="post">
	<table>
		<tr>
			<td>Username </td>
			<td><input type="text" name="username"></input></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password"></input></td>
		</tr>
		<tr>
			<td>Role</td>
			<td>
			<select name="type">
				<option name="teacher" value="teacher">Teacher</option>
				<option name="student" value="student">Student</option>
				<option name="admin" value="admin">Admin</option>
			</select>
			</td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
			<td><button><input type="submit" name="login" value="Login"></input></button></td>
			<td><button><input type="reset" name="reset" value="Reset"></button></td>
		</tr>
	</table>
</form>
-->
<h1> AM System </h1>
<div class="center">
    <h1>Login</h1>
	<form method="post">
        <div class="txt_field">
          <input type="text" id="username" name="username" required>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" id="password" name="password" required>
          <label>Password</label>
        </div>
        <div class="container">   
        <p>Role</p> 
        <ul>
        <li>
          <input type="radio" id="f-option" name="selector" value="student" checked>
          <label for="f-option">Student</label>        
          <div class="check"></div>
        </li>        
        <li>
          <input type="radio" id="s-option" name="selector" value="teacher">
          <label for="s-option">Teacher</label>         
          <div class="check"><div class="inside"></div></div>
        </li>
        <li>
          <input type="radio" id="t-option" name="selector" value="admin">
          <label for="t-option">Admin</label>       
          <div class="check"><div class="inside"></div></div>
        </li>
      </ul>
      </div>
        <div class="pass">Have forgot your password? <a href="reset.php">Reset here.</a></div>
         <input type="submit" value="Login" name="login" />
        <div class="signup_link">
            <p><strong>If you don't have any account,<br><a href="signup.php">Signup</a> here</strong></p>
        </div>
    </form>
	
</div>


</center>
</body>
</html>