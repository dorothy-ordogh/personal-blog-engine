<?php
//VIEW POST
include_once 'mysql/functions.php';
include('blog_header.php');
//$id = db_input($_GET['id']);
//$post = db_select("SELECT * FROM posts WHERE id=".$id." LIMIT 1");
//
//if (!$post) {
//	echo 'Post #'.$id.' not found';
//	exit;
//}

//$row = $post[0];
echo '<h2>'.$row['title'].'</h2>';
//$post_title = $row['title'];
//$about_this_page = $row['about'];
echo '<em>Posted '.date('F j<\s\up>S</\s\up>, Y', $row['date']).'</em><br/>';
echo '<br/>'.nl2br($row['body']).'<br/>';

//$link_to_like = "http://www.dorothyordogh.com/blog/post_view.php?id=".$id;

if (is_in_session()) {
    echo '<a href="post_edit.php?id='.$id.'">Edit</a> | <a href="post_delete.php?id='.$id.'">Delete</a> | ';
}
echo '<a href="index.php">View All</a><br/>';
echo '<br/>';
include('social.php');
//echo <<<LIKE
//<div
//  class="fb-share-button"
//  data-href={$link_to_like}
//  data-layout="button">
//</div>
//LIKE;

echo '<hr/>';
$result = db_select("SELECT * FROM comments WHERE post_id=".$id." ORDER BY date DESC");
echo '<ol id="comments">';
$num_comments = count($result);
for ($count = $num_comments - 1; $count >= 0; $count--) {
    $row = $result[$count];
    echo '<li id="post-'.$row['id'].'">';
    echo (empty($row['website'])?'<strong>'.$row['name'].'</strong>':'<a href="'.$row['website'].'" target="_blank">'.$row['name'].'</a>');
    if(login_check($mysqli) == true) {
        echo ' (<a href="comment_delete.php?id='.$row['id'].'&post='.$_GET['id'].'">Delete</a>)<br/>';
    }
    echo '<small>'.date('j-M-Y g:ia', $row['date']).'</small><br/>';
    echo nl2br($row['content']);
    echo '</li>';
}

echo '</ol>';

echo <<<HTML
<form method="post" action="comment_add.php?id={$_GET['id']}">
	<table>
		<tr>
			<td><label for="name">Name:</label></td>
			<td><input name="name" id="name" value="{$_COOKIE['name']}"/></td>
		</tr>
		<tr>
			<td><label for="email">Email:</label></td>
			<td><input name="email" id="email" value="{$_COOKIE['email']}"/></td>
		</tr>
		<tr>
			<td><label for="website">Website:</label></td>
			<td><input name="website" id="website" value="{$_COOKIE['website']}"/></td>
		</tr>
		<tr>
			<td><label for="content">Comment:</label></td>
			<td><textarea name="content" id="content"></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Post Comment"/></td>
		</tr>
	</table>
</form>
HTML;

include('blog_footer.php');
?>