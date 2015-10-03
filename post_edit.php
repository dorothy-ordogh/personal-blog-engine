<head>
<title>Edit a Post</title>
<link href='blogstyle.css' rel='stylesheet' type='text/css' />
</head>
<?php
//EDIT A POST
include_once 'mysql/functions.php';
include_once 'rss_updater.php';
include('blog_header.php');

if (is_in_session()) {
    $title = db_input($_POST['title']);
    $body = db_input($_POST['body']);
    $about = db_input($_POST['about']);
    $date = db_input(($_POST['date']);
    //$date = db_input(time());

    if (!empty($_POST)) {
    	if (db_query("UPDATE posts SET title=".$title.", body=".$body.", date=".$date.", about=".$about." WHERE id=".$_GET['id']."")) {
    	    update_rss_doc();
       		redirect('post_view.php?id='.$_GET['id']);
       	} else {
       		echo db_error();
        }
    }

    $result = db_select("SELECT * FROM posts WHERE id=".$_GET['id']."");

    if (!$result) {
      	echo 'Post #'.$_GET['id'].' not found';
       	exit;
    }

    $row = $result[0];

    echo <<<HTML
    <form method="post">
       	<table>
       		<tr>
       			<td><label for="title">Title</label></td>
       			<td><input name="title" id="title" value="{$row['title']}" /></td>
       		</tr>
       		<tr>
       			<td><label for="body">Body</label></td>
       			<td><textarea name="body" id="body">{$row['body']}</textarea></td>
       		</tr>
       		<tr>
                <td><label for="about">Descripton</label></td>
                <td><input name="about" id="about" value="{$row['about']}" /></td>
            </tr>
       		<tr>
       			<td></td>
       			<td><input type="submit" value="Save"/></td>
       		</tr>
       	</table>
    </form>
HTML;

    echo '<a href="admin/logout.php">Logout</a>';
}
include('blog_footer.php');
?>