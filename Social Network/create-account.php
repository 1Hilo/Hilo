<?php
include ('classes/Overall/header.php');
include('classes/DB.php');

if (isset($_POST['createaccount'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email 	  = $_POST['email'];
	
	if (!DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {

		if (strlen($username) >= 3 && strlen($username) <= 32) {
			if (preg_match('/[a-zA-Z0-9_]+/', $username)){

                if (strlen($password) >= 6 && strlen($password) <= 60){

                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                                DB::query('INSERT INTO users VALUES (null, :username, :password, :email)', array(':username'=>$username, ':password'=> password_hash($password, CRYPT_BLOWFISH), ':email'=>$email));
                                echo 'success!';
                    } else {
                        echo 'invalid email!';
                    }

                } else {
                    echo 'Invalid password!';
                }

			} else {
				echo 'invalid username!';
			}

		} else {
			echo 'Invalid username!';
		}

	} else {
		echo 'user already exit!';
	}
}
?>  

<h1> Register</h1>
<form action="create-account.php" method="post">
<input type="text" name="username" value="" placeholder="username..."><br>
<input type="password" name="password" value="" placeholder="Password..."><br>
<input type="text" name="email" value="" placeholder="Email..."><br>
<input type="submit" name="createaccount" value="Create Account">
</form>