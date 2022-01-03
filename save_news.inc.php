<?php

require_once 'configDB.php';

if(!empty($_POST['title']) && !empty($_POST['category']) && !empty($_POST['description']) && !empty($_POST['source'])) {

    try {

        //get data
        $title = $_POST['title'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $source = $_POST['source'];


        //save post in DB
        $db->beginTransaction();
        $db->saveNews($title, $category, $description, $source);
        $db->commit();
        header('Location: /news.php');
    } catch (PDOException $e) {
        echo $e->getMessage();
        $db->rollBack();
    }
}
