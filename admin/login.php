<head>
<title><?php echo "Login"; ?></title>
<link href='../blogstyle.css' rel='stylesheet' type='text/css' />
</head>

<?php
require 'password_compat-master/lib/password.php';
include_once '../mysql/functions.php';

ini_set('display_errors',1);
error_reporting(E_ALL);

$result = session_start();
$error = '';
if (count($_POST)>0) {
    $password = $_POST['password'];
    $email = $_POST['email'];
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = "you must fill out both email and password";
        echo $error;
    } else {
        $input_email = db_input($email);
        $row = db_select("SELECT password FROM member WHERE email = ".$input_email." LIMIT 1");
        if (sizeof($row) == 1) {
            $result = $row[0];
            $dbpass = $result['password'];
            if (password_verify($password, $dbpass)) {
                $_SESSION['login_user'] = $email;
                redirect('../index.php');
            } else {
                $error = "Email or password is invalid";
            }
        }
        echo $error;
    }
}
?>

<html>
    <head>
        <title>Log in</title>
    </head>
    <body id="login-form">
        <form name="loginform" method="post" action="" onsubmit="return validateLogin();">
            <table>
                <tr>
               	    <td><label for="emaill">Email</label></td>
               	    <td><input type="text" name="email"/></td>
                </tr>
               	<tr>
               	   	<td><label for="passwordl">Password</label></td>
               	    <td><input type="password" name="password"/></td>
               	</tr>
               	<tr>
               	  	<td></td>
               	    <td><input type="submit" value="Login"/></td>
               	</tr>
            </table>
        </form>
    </body>
</html>
