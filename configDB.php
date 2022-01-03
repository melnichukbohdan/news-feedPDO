<?php

include 'NewsDB.php';

//connect to the db;

$db = new NewsDB('mysql:host=localhost; dbname=news; charset=UTF8', 'root', '');
