//<head>
//<title>Add a Post</title>
//<link href='blogstyle.css' rel='stylesheet' type='text/css' />
//</head>
//<?php
////ADD A POST
//include_once 'mysql/functions.php';
//include('blog_header.php');
//
//if (is_in_session()) {
//    if (!empty($_POST)) {
//        $title = db_input($_POST['title']);
//        $body = db_input($_POST['body']);
//        $date = db_input(time());
//    	if (db_query("INSERT INTO posts (title, body, date) VALUES (" . $title ."," . $body . "," . $date . ")")) {
//    		echo 'Entry posted. <a href="post_view.php?id='.mysqli_insert_id(db_connect()).'">View</a>';
//    	} else {
//    		echo db_error();
//        }
//    }
//    echo <<<HTML
//            <form method="post">
//            	<table>
//            		<tr>
//            			<td><label for="title">Title</label></td>
//            			<td><input name="title" id="title" /></td>
//            		</tr>
//            		<tr>
//            			<td><label for="body">Body</label></td>
//            			<td><textarea name="body" id="body"></textarea></td>
//            		</tr>
//            		<tr>
//            			<td></td>
//            			<td><input type="submit" value="Post" /></td>
//            		</tr>
//            	</table>
//            </form>
//HTML;
//
//    echo '<a href="admin/logout.php">Logout</a>';
//
//}
//
//include('blog_footer.php');
//?>

<head>
<title>Add a Post</title>
<link href='blogstyle.css' rel='stylesheet' type='text/css' />
</head>
<?php
//ADD A POST
include_once 'mysql/functions.php';
include_once 'rss_updater.php';
include('blog_header.php');

if (is_in_session()) {
    if (!empty($_POST)) {
        $title = db_input($_POST['title']);
        $body = db_input($_POST['body']);
        $about = db_input($_POST['about']);
        $date = db_input(time());
    	if (db_query("INSERT INTO posts (title, body, about, date) VALUES (" . $title ."," . $body . ",". $about .",". $date . ")")) {
    		echo 'Entry posted. <a href="post_view.php?id='.mysqli_insert_id(db_connect()).'">View</a>';
    	} else {
    		echo db_error();
        }
    }
    echo <<<HTML
            <form method="post">
            	<table>
            		<tr>
            			<td><label for="title">Title</label></td>
            			<td><input name="title" id="title" /></td>
            		</tr>
            		<tr>
            			<td><label for="body">Body</label></td>
            			<td><textarea name="body" id="body"></textarea></td>
            		</tr>
            		<tr>
            		    <td><label for="aboutl">Description</label></td>
            		    <td><input name="about" id="about" /></td>
            		</tr>
            		<tr>
            			<td></td>
            			<td><input type="submit" value="Post" /></td>
            		</tr>
            	</table>
            </form>
HTML;

    echo '<a href="admin/logout.php">Logout</a>';

}

include('blog_footer.php');
?>