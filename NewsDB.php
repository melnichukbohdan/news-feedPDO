<?php

require_once 'INewsDB.php';
require_once 'configDB.php';

class NewsDB extends PDO implements INewsDB {

    function __destruct()
    {
        unset($this->db);
    }
    function __get($name)
    {
        if ($name == 'db') {
            return $this->db;
        } else {
            throw new Exception('Wrong property name');
        }
    }

    function __set($name, $value)
    {
        if ($name == 'db') {
            throw new Exception('Wrong property name');
        }
    }

    /**
     * InHerDoc
     */
    public function saveNews($title, $category, $description, $source)
    {
        $datatime = time();

        $stmt = $this->prepare("INSERT INTO message(title, category, description, source, datetime)
                                            VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $title, PDO::PARAM_STR);
        $stmt->bindParam(2, $category, PDO::PARAM_INT);
        $stmt->bindParam(3, $description, PDO::PARAM_STR);
        $stmt->bindParam(4, $source, PDO::PARAM_STR);
        $stmt->bindParam(5, $datatime, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * InHerDoc
     */
    public function getNews()
    {
        $stmt = $this->prepare("SELECT message.id as id, title, description, category.name as category, source,
                                             datetime
                                      FROM message, category
                                      WHERE category.id = message.category
                                      ORDER BY message.id DESC");
        $stmt->execute();

        $stmt->bindColumn(1, $items['title'], PDO::PARAM_STR);
        $stmt->bindColumn(2, $items['category'], PDO::PARAM_STR);
        $stmt->bindColumn(3, $items['description'], PDO::PARAM_STR);
        $stmt->bindColumn(4, $items['source'], PDO::PARAM_STR);
        $stmt->bindColumn(5, $items['datetime'], PDO::PARAM_INT);

    return $this->toArray($stmt);
    }

    //conversion of data from DB to associative array
    public function toArray($data)
    {
        $arr = [];
        while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
            $arr[] = $row;
        }
        return $arr;
    }

    /**
     * InHerDoc
     */
    public function deleteNews($id)
    {
        $stmt = $this->prepare("DELETE FROM message WHERE id = ?");
        $stmt->bindParam(1,$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
}
