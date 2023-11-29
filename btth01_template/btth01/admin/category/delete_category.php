<?php

    include('../layout/header.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM theloai WHERE ma_tloai=$id;";
    try {
        $statement = $connect->prepare($sql);
        $statement->execute();
        header("Location: category.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>