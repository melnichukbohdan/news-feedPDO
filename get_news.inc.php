<?php

require_once 'configDB.php';

$items = $db->getNews();

if (empty($items)) {
    $errMsg = 'None news';
} else {
    $errMsg = 'Hot news!!!';
}

echo "<br>" . "<h3>$errMsg</h3>" ;

if (!empty($items)) {
foreach ($items as $item) {
    $dt = date("Y-M-D h:m:s", $item['datetime']);
    $id = $item['id'];
    //news output
    echo "<h2>" . $item['title'] . "</h2>";
    echo "<h4>" . $item['description'] . "</h4>";
    echo "<h4>" . 'Category - ' . $item['category'] . "</h4>";
    echo "<h4>" . $item['source'] . ' @ ' . $dt . "</h4>";

    echo "<p>
            <a href=delete_news.inc.php?delete=$id method='get'>delete</a>
          </p><br>";
    }
}
