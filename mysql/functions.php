<?php
//MYSQL FUNCTIONS and extras
function db_connect() {
    static $connection;
    if (!isset($connection)) {
        $config = parse_ini_file('config.ini');
     $connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);
    }
    if ($connection === false) {
        return mysqli_connect_error();
    }
    return $connection;
}

function db_query($query) {
    $connection = db_connect();
    $result = mysqli_query($connection,$query);
    return $result;
}

function db_error() {
    $connection = db_connect();
    return mysqli_error($connection);
}

function db_select($query) {
    $rows = array();
    $result = db_query($query);
    if (is_bool($result)) {
        if ($result === false) {
            return false;
        }
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }
    return $rows;
}

function db_input($value) {
    $connection = db_connect();
    if (empty($value)) {
        return 'NULL';
    }
    elseif (is_numeric($value)) {
        return $value;
    } else {
    return "'" . mysqli_real_escape_string($connection, $value) . "'";
    }
}

function redirect($uri) {
    header('location:' . $uri);
    exit;
}

function is_in_session() {
    session_start();
    if (empty($_SESSION['login_user'])) {
        return false;
    }
    $user = db_input($_SESSION['login_user']);
    $row = db_select("SELECT email FROM member WHERE email = ".$user." LIMIT 1");
    if (sizeof($row) > 0) {
        $result = $row[0];
        $login_session = $result['email'];
        if (!empty($login_session)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
?>