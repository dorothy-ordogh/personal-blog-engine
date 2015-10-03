<?php
//DELETE COMMENT
include_once 'mysql/functions.php';

if (is_in_session()) {
    $id = db_input($_GET['id']);
    $post = db_input($_GET['post']);
    db_query("DELETE FROM comments WHERE id=".$id." LIMIT 1");
    db_query("UPDATE posts SET num_comments=num_comments-1 WHERE id=".$post." LIMIT 1");
    redirect('post_view.php?id='.$post);
}