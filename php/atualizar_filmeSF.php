<?php
session_start();
include_once ('config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['matricula'])) {
    header('Location: ../login.html');
    exit();
}

// Verifica se os dados do filme foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $filme_id = $_POST['filme_id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $sugerido_por = $_POST['sugerido_por'];
    $link_imagem = $_POST['imagem'];

    // Atualiza os dados do filme no banco de dados
    $sql = "UPDATE cadastrar_filmes SET nome = '$titulo', descricao = '$descricao', posto_por = '$sugerido_por', imagem_link = '$link_imagem' WHERE id = $filme_id";

    if ($conn->query($sql) === TRUE) {
        // Redireciona de volta para a página principal
        header('Location: addF.php');
    } else {
        // Em caso de erro, exibe uma mensagem de erro
        echo "Erro ao atualizar o filme: " . $conn->error;
    }
} else {
    // Se os dados não foram enviados via POST, redireciona de volta para a página principal
    header('Location: home.php');
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
