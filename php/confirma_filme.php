<?php
session_start();
include_once ('config.php');

if ((!isset($_SESSION['matricula']) == true)) {
    unset($_SESSION['matricula']);
    header('Location: ../login.html');
}

if(isset($_GET['id'])){
    $filme_id = $_GET['id'];
    $sql_update = "UPDATE filmes_tb SET SorN = '1' WHERE id = $filme_id";
    $result = $conn->query($sql_update);
    header('Location: home.php');
} else {
    header('Location: home.php');
    exit();
}
?>