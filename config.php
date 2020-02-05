<?php
$mysqlsunucu = "localhost";
$mysqlkullanici = "root";
$mysqlsifre = "";
$mysqldatabase= "site";
$mysqlcharset= "utf8";

try {
    $connection = new PDO("mysql:host=$mysqlsunucu;dbname=$mysqldatabase;charset=$mysqlcharset", $mysqlkullanici, $mysqlsifre);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection error: " . $e->getMessage();
    }
    