<head>
<title>Blog</title>
<link href='blogstyle.css' rel='stylesheet' type='text/css' />
</head>

<?php
//BLOG LANDING PAGE
include_once 'mysql/functions.php';
include('blog_header.php');

echo "<em>Welcome to my blog, where topics appear in no particular order</em><hr/>";

$result = db_select('SELECT * FROM posts ORDER BY date ASC');

if (!$result) {
	echo 'We cannot show any posts because there was either an error or none exist.';
} else {
    $num_posts = count($result);
    for ($count = $num_posts - 1; $count >= 0; $count--) {
        $row = $result[$count];
        echo '<h2><a href="post_view.php?id='.$row['id'].'">'.$row['title'].'</a></h2><br/>';
        $body = substr($row['body'], 0, 300);
        echo nl2br($body).'...<br/>';
        echo '<a href="post_view.php?id='.$row['id'].'">Read More</a> | ';
        echo '<a href="post_view.php?id='.$row['id'].'#comments">'.$row['num_comments'].' comments</a>';
        echo '<hr/>';
    }
}

if (is_in_session()) {
    echo '<a href="post_add.php">+ New Post</a>';
}
include('blog_footer.php');
?>