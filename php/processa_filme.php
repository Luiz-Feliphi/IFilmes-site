<?php
session_start();
include_once ('config.php');

if ((!isset($_SESSION['matricula']) == true)) {
    unset($_SESSION['matricula']);
    header('Location: ../login.html');
}

// sistema que cadastra o filme na tabela filmes_tb
if(isset($_GET['id'])){
    $filme_id = $_GET['id'];
    
    // Busca os dados do filme com base no ID
    $sql = "SELECT * FROM cadastrar_filmes WHERE id = $filme_id";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = mysqli_fetch_assoc($result)){
            $titulo = $row['nome'];
            $descricao = $row['descricao'];
            $posto_por = $row['posto_por'];
            $imagem_link = $row['imagem_link'];
            if($posto_por == ''){
                $posto_por = 'Anonimo';
            }
            // Insere o filme na tabela filmes_tb
            $sql_insert = "INSERT INTO filmes_tb (nome, descricao, posto_por, imagem_link) VALUES ('$titulo', '$descricao', '$posto_por', '$imagem_link')";
            $result_insert = $conn->query($sql_insert);
            // Deleta o filme da tabela cadastrar_filmes
            $sql_delete = "DELETE FROM cadastrar_filmes WHERE id = $filme_id";
            $result_delete = $conn->query($sql_delete);
            header('Location: addF.php');
        }
    }
} else {
    header('Location: home.php');
    exit();
}

?>