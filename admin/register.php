<?php
require 'password_compat-master/lib/password.php';
include_once '../mysql/functions.php';
$error_msg = "";

if (isset($_POST['email'], $_POST['password'], $_POST['confirmpassword'])) {
    //sanitize and validate the data passed in
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
        echo $error_msg;
    }

    $confirmpassword = $_POST['confirmpassword'];
    $password = $_POST['password'];
    //if passwords match, continue
    if ($password == $confirmpassword) {
        $email = db_input($email);
        $rows = db_select("SELECT id FROM member WHERE email = ".$email." LIMIT 1");
        if (sizeof($rows) == 1) {
            //a user with this email address already exists
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
            echo $error_msg;
        } else {
            echo $error_msg;
        }

        if (empty($error_msg)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $password = db_input($password);

            //insert the new user into the database
            $dbresult = db_query("INSERT INTO member (email, password) VALUES (".$email.",".$password.")");
            echo $dbresult;
            if ($dbresult) {
                echo "registration successful!!!";
            } else {
                echo "something went wrong. Try again";
            }
        }
    }
}
?>
<html>
    <head>
        <title>Register</title>
    </head>
    <body>
        <form name="registerform" method="post" action="">
            <table>
                <tr>
               	    <td><label for="email">Email</label></td>
               	    <td><input type="text" name="email"/></td>
                </tr>
               	<tr>
               	   	<td><label for="password">Password</label></td>
               	    <td><input type="password" name="password"/></td>
               	</tr>
               	<tr>
                    <td><label for="confirmpassword">Confirm password</label></td>
                    <td><input type="password" name="confirmpassword"/></td>
                </tr>
               	<tr>
               	  	<td></td>
               	    <td><input type="submit" value="Register"/></td>
               	</tr>
            </table>
        </form>
    </body>
</html>