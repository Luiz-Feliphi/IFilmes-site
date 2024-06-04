<?php
session_start();
include_once('config.php');

$logado = $_SESSION['matricula'];
$sql_sugestao = "SELECT * FROM sugeri_envi WHERE matricula = '$logado'";
$result_sugestao = $conn->query($sql_sugestao);
$row_sugestao = mysqli_fetch_assoc($result_sugestao);
$data_sugestao = $row_sugestao['data'];
$data_atual = date('Y-m-d');
$diff = abs(strtotime($data_atual) - strtotime($data_sugestao));
$diff_dias = $diff / (60 * 60 * 24);
// Obtém os dados do formulário
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$posto_por = $_POST['posto_por'];
$imagem_link = $_POST['imagem_link'];

// Insere os dados no banco de dados
$sql = "INSERT INTO cadastrar_filmes (nome, descricao, posto_por, imagem_link, matricula) VALUES ('$nome', '$descricao', '$posto_por', '$imagem_link', '$logado')";
$result = $conn->query($sql);

// Verifica se a inserção foi bem-sucedida
if($result) {
    // Armazena a data e hora da sugestão na sessão
    $sql_segestao_envi = "INSERT INTO sugeri_envi (matricula, data) VALUES ('$logado', '$data_atual')";
    $result_sugestao_envi = $conn->query($sql_segestao_envi);
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
if($diff_dias >= 3){
    $sql_deletar = "DELETE FROM sugeri_envi WHERE matricula = '$logado'";
    $result_deletar = $conn->query($sql_deletar);
} else {
    $_SESSION['erro'] = "Você já enviou uma sugestão nos últimos 3 dias. Por favor, aguarde.";
    header('Location: sugeriF.php');
    exit();
}
?>
