<?php
//DELETE POST
include_once 'mysql/functions.php';
include_once 'rss_updater.php';
include('blog_header.php');

if (is_in_session()) {
    $success = false;
    $success = db_query("DELETE FROM posts WHERE id=".$_GET['id']." LIMIT 1");
    $success = db_query("DELETE FROM comments WHERE post_id=".$_GET['id']."");
    if ($success) {
        update_rss_doc();
        redirect('index.php');
    }
    echo '<a href="admin/logout.php">Logout</a>';
}
include('blog_footer.php');
?>