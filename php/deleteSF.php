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
    $sql = "DELETE FROM cadastrar_filmes WHERE id = $id";
    $result = $conn->query($sql);
    header('Location: addF.php');
} else {
    header('Location: home.php');
    exit();
}

?>