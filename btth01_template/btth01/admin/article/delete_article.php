<?php

    include('../layout/header.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM baiviet WHERE ma_bviet=$id;";
    try {
        $statement = $connect->prepare($sql);
        $statement->execute();
        header("Location: article.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>