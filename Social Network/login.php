<?php
include ('classes/Overall/header.php');
include('classes/DB.php');

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	
            if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {

                if (password_verify($password, DB::query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])) {


                    $cstrong = true;
                    $token = bin2hex(openssl_random_pseudo_bytes (64, $cstrong));
                    $user_id = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0]['id'];
                    DB::query('INSET INTO login_tokens VALUES (null, :token, :user_id)', array(':token'=>sha1($token), 'user_id'=>$user_id));

                    echo 'logged in!';

                } else {
                    echo 'Incorrect Password';
                }

            } else {
                echo 'user not registerd!';
            }
}




?>

<h1>login in</h1>
<form action="login.php" method="post">
	<input type="text" name="username" value="" placeholder="Username..."><br>
	<input type="password" name="password" value="" placeholder="Password..."><br>
	<input type="submit" name="login" value="login">	
</form>