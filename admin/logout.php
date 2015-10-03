<?php
include_once '../mysql/functions.php';

if (is_in_session()) {
    session_unset();
    if (session_destroy()) {
        redirect('../index.php');
    }
} else {
    redirect('../index.php');
}
?>
