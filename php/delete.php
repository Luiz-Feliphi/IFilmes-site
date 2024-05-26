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
    $sql = "DELETE FROM filmes_tb WHERE id = $id";
    $result = $conn->query($sql);
    $sql_delete_voto = "DELETE FROM votos_usuarios WHERE id = $id";
    $result_delete_voto = $conn->query($sql_delete_voto);
    header('Location: home.php');
} else {
    header('Location: home.php');
    exit();
}

?>