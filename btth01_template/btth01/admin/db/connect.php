<?php
    define("DATABASE_SERVER", "localhost");
    define("DATABASE_USER", "root");
    define("DATABASE_PASSWORD", "");
    define("DATABASE_NAME", "BTTH01_CSE485");
    $connect = null;

    try {
        $connect = new PDO("mysql:host=".DATABASE_SERVER.";dbname=".DATABASE_NAME, DATABASE_USER, DATABASE_PASSWORD);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Error: ".$e->getMessage();
        $connect = null;
    }
?>