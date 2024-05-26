<?php
session_start();
include_once ('config.php');

if ((!isset($_SESSION['matricula']) == true)) {
    unset($_SESSION['matricula']);
    header('Location: ../login.html');
}

// sistema que cadastra o anuncio na tabela anuncios_tb
if (isset($_POST['enviar'])) {
    $titulo = $_POST['titulo'];
    $imagem_link = $_POST['imagem_link'];
    $descricao = $_POST['descricao'];
    $posto_por = $_POST['sugerido_por'];
    if ($posto_por == '') {
        $posto_por = 'Anonimo';
    }
    // Insere o anuncio na tabela anuncios_tb
    $sql_insert = "INSERT INTO anuncios_tb (nome, descricao, posto_por, imagem_link) VALUES ('$titulo', '$descricao', '$posto_por', '$imagem_link')";
    $result_insert = $conn->query($sql_insert);
    header('Location: news.php');
} else {
    if (isset($_POST['editar'])) {
        $id = $_POST['anuncio_id'];
        $titulo = $_POST['titulo'];
        $imagem_link = $_POST['imagem_link'];
        $descricao = $_POST['descricao'];
        $posto_por = $_POST['sugerido_por'];
        if ($posto_por == '') {
            $posto_por = 'Anonimo';
        }
        // Atualiza o anuncio na anuncios_tb
        $sql_update = "UPDATE anuncios_tb SET nome = '$titulo', descricao = '$descricao', posto_por = '$posto_por', imagem_link = '$imagem_link' WHERE id = $id";
        if ($conn->query($sql_update)){
            header('Location: news.php');
        } else {
            echo "Erro ao atualizar o anuncio: " . $conn->error;
        }
    } else {
        header('Location: news.php');
    }
}

?>