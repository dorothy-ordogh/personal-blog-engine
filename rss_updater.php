<?php
include_once 'mysql/functions.php';

function update_rss_doc() {

$input = <<<RSS
<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<atom:link href="http://dorothyordogh.com/blog/rss.xml" rel="self" type="application/rss+xml" />
</channel>
</rss>
RSS;

    $xml = new SimpleXMLElement($input);
    $element = $xml->channel[0];
    $element->addChild('title', "Dot's Thoughts: Dorothy Ordogh's Blog");
    $element->addChild('link', 'http://dorothyordogh.com/blog/index.php');
    $element->addChild('description', "Welcome to Dorothy's blog!");

    $result = db_select('SELECT * FROM posts ORDER BY date ASC');
    if (!$result || !$xml) {
        //handle error
        echo "there was an error\n";
    } else {
        $num_posts = count($result);
        for ($count = $num_posts - 1; $count >= 0; $count--) {
            $row = $result[$count];
            $title = $row['title'];
            $desc = $row['about'];
            $id = $row['id'];
            $link = 'http://dorothyordogh.com/blog/post_view.php?id='.$id;

            if ($desc == null) {
                $desc = "Random idle thoughts.";
            }

            $element = $xml->channel[0];
            $item_elem = $element->addChild('item');
            $item_elem->addChild('title', $title);
            $item_elem->addChild('link', $link);
            $item_elem->addChild('description', $desc);
            $item_elem->addChild('guid', $link);
        }

        $xml->asXML('rss.xml');
    }
}