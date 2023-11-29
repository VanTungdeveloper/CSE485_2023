<?php

    include('../layout/header.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM tacgia WHERE ma_tgia=$id;";
    try {
        $statement = $connect->prepare($sql);
        $statement->execute();
        header("Location: author.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>