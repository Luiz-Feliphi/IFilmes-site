<?php
session_start();
include_once ('config.php');

if ((!isset($_SESSION['matricula']) == true)) {
    unset($_SESSION['matricula']);
    header('Location: ../login.html');
}

// sistema de deleta o filme da tabela filmes_tb aquando aperta o botão de deletar e ele realiza um DELETE na tabela
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM anuncios_tb WHERE id = $id";
    $result = $conn->query($sql);
    header('Location: news.php');
} else {
    header('Location: home.php');
    exit();
}

?>