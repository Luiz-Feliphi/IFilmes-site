<?php
session_start();
include_once('config.php');

// Verifica se já se passaram 3 dias desde a última sugestão
if(isset($_SESSION['ultima_sugestao'])) {
    $ultima_sugestao = strtotime($_SESSION['ultima_sugestao']);
    $agora = time();
    $diferenca = $agora - $ultima_sugestao;
    
    // Se não se passaram 3 dias, redireciona de volta para a página de sugestão com uma mensagem de erro
    if($diferenca < (3 * 24 * 60 * 60)) {
        $_SESSION['erro'] = "Você só pode enviar uma sugestão a cada 3 dias.";
        header('Location: sugeriF.php');
        exit();
    }
}

// Obtém os dados do formulário
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$posto_por = $_POST['posto_por'];
$imagem_link = $_POST['imagem_link'];

// Insere os dados no banco de dados
$sql = "INSERT INTO cadastrar_filmes (nome, descricao, posto_por, imagem_link) VALUES ('$nome', '$descricao', '$posto_por', '$imagem_link')";
$result = $conn->query($sql);

// Verifica se a inserção foi bem-sucedida
if($result) {
    // Armazena a data e hora da sugestão na sessão
    $_SESSION['ultima_sugestao'] = date('Y-m-d H:i:s');
    // Redireciona de volta para a página de sugestão com uma mensagem de sucesso
    $_SESSION['sucesso'] = "Sugestão enviada com sucesso!";
    header('Location: sugeriF.php');
    exit();
} else {
    // Se houver um erro na inserção, redireciona com uma mensagem de erro
    $_SESSION['erro'] = "Erro ao enviar sugestão. Por favor, tente novamente.";
    header('Location: sugeriF.php');
    exit();
}
?>
