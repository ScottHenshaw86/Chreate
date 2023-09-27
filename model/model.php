<?php

function dbConnect() {
    $HOST = "localhost";
    $DB = "wcoding";
    $USER = "root";
    $PWD = "root";
    return new PDO("mysql:host=$HOST;dbname=$DB;charset=utf8", $USER, $PWD);
}

