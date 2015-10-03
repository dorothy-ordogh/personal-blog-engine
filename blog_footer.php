<?php
include_once 'mysql/functions.php';

if (is_in_session()) {
    echo '<a href="admin/logout.php">Logout</a>';
} else {
    echo '<a href="admin/login.php">Login</a> to make changes.';
}

echo '<br />';

$year = date("Y");
echo "<br id='copyright' />Copyright &copy; ".$year." Dorothy Ordogh <br />";

echo '<br />';

?>