<?php

require_once 'configDB.php';

try {
    $db->beginTransaction();
    $id = abs((int)$_GET['delete']);
    $db->deleteNews($id);
    $db->commit();
    header('Location: /news.php');
} catch (PDOException $e) {
        echo $e->getMessage();
    $db->rollBack();
}
