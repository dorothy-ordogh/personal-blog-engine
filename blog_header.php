<head>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
<?php
$script = $_SERVER['SCRIPT_NAME'];
$wantedpage = "post_view.php";
$contains = strpos($script, $wantedpage);
if (!($contains === false)) {
include_once 'mysql/functions.php';

$id = db_input($_GET['id']);
$post = db_select("SELECT * FROM posts WHERE id=".$id." LIMIT 1");

if (!$post) {
	echo 'Post #'.$id.' not found';
	exit;
}

$row = $post[0];
$post_title = $row['title'];
$about_this_page = $row['about'];

$titlecontent = 'content="'.$post_title.'"';
$link_to_like = 'http://dorothyordogh.com/blog/post_view.php?id='.$id;
$urlcontent = 'content="'.$link_to_like.'"';
$aboutcontent = 'content="'.$about_this_page.'"';

echo '<meta charset="UTF-8"/><meta property="og:type" content="article" /><meta property="og:title" '.$titlecontent.' /><meta property="og:url" '.$urlcontent.' /><meta property="og:image" content="http://dorothyordogh.com/blog/img/dologo.png" /><meta property="og:site_name" content="Blog of Dorothy Ordogh" />';
if (!$aboutcontent) {
    echo '<meta property="og:description" '.$aboutcontent.' />';
}
echo '<title>'.$post_title.'</title>';
}
?>
<link href='blogstyle.css' rel='stylesheet' type='text/css' />
</head>
<body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '435351163284543',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<?php
echo "<h1><a href='index.php'><b id='dottitle'>Dot's </b><b id='thoughtstitle'>Thoughts</b></a></h1>";
?>