<?php
//ADD COMMENT
include_once 'mysql/functions.php';

$expire = time()+60*60*24*30;
setcookie('name', $_POST['name'], $expire, '/');
setcookie('email', $_POST['email'], $expire, '/');
setcookie('website', $_POST['website'], $expire, '/');

$id = db_input($_GET['id']);
$name = db_input($_POST['name']);
$email = db_input($_POST['email']);
$website = db_input($_POST['website']);
$content = db_input($_POST['content']);
$date = db_input(time());

db_query("INSERT INTO comments (post_id,name,email,website,content,date) VALUES (".$id.",".$name.",".$email.",".$website.",".$content.",".$date.")");
db_query("UPDATE posts SET num_comments=num_comments+1 WHERE id=".$id." LIMIT 1");
redirect('post_view.php?id='.$id.'#post-'.mysqli_insert_id(db_connect()));