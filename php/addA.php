<?php
session_start();
include_once ('config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['matricula'])) {
    header('Location: ../login.html');
    exit();
}

// Verifica se o usuário é um administrador
$logado = $_SESSION['matricula'];

if ($logado != '19111413') {
    header('Location: home.php');
    exit();
}
//configuração
$sql_config = "SELECT * FROM config_tb WHERE id = 1";
$result_config = $conn->query($sql_config);
$row = mysqli_fetch_assoc($result_config);
//configuração
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/scss/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="../img/movie.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>IFilmes Web Site</title>
</head>

<body class="bg-secondary-subtle">
    <div>
        <nav class="navbar navbar-expand-lg bg-secondary">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center text-white" href="home.php">
                    <img src="../img/movie.png" alt="Logo" width="64" height="64"
                        class="d-inline-block align-text-top bg-dark" id="logo">
                    IFilmes
                </a>
                <div class="d-flex justify-content-center collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item opcao">
                            <a class="nav-link active text-white text-center" aria-current="page"
                                href="home.php">Home</a>
                        </li>
                        <li class="nav-item opcao">
                            <a class="nav-link text-white text-center" href="voto.php">Votar</a>
                        </li>
                        <li class="nav-item opcao">
                            <a class="nav-link text-white text-center" href="sugeriF.php">Sugerir Filme</a>
                        </li>
                        <li class="nav-item opcao">
                            <a class="nav-link text-center text-white" href="news.php">Anúncios</a>
                        </li>
                        <!-- Para ADMs -->
                        <?php if ($logado == '19111413'): ?>
                            <li class="nav-item opcao">
                                <a class="nav-link text-center text-warning" href="addF.php">Adicionar Filme</a>
                            </li>
                            <li class="nav-item opcao">
                                <a class="nav-link text-center text-warning" href="addM.php">Cadastrar Matriculas</a>
                            </li>
                            <li class="nav-item opcao">
                                <a class="nav-link text-center text-warning" href="#">Adicionar Sugestão</a>
                            </li>
                        <?php endif; ?>
                        <!-- Para ADMs -->
                    </ul>
                </div>
            </div>
            <a class="navbar-brand d-flex align-items-center me-2 ms-2 text-white btn btn-danger sair"
                href="sair.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                    <path fill-rule="evenodd"
                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                </svg></a>
        </nav>
    </div>

    <span class="d-flex justify-content-center">
        <p class="text-center fw-bold fs-2 bg-primary p-2 mt-2 rounded w-50 text-white">Adicionar Anuncio</p>
    </span>

    <div class="d-flex justify-content-start">
        <a id="toggleButton" href="home.php" class="ms-5 d-flex btn btn-primary icon-link icon-link-hover"
            style="--bs-icon-link-transform: translate3d(-.125rem, 0, 0);">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path
                    d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
            </svg>
            Voltar
        </a>
    </div>
    <!--Ilustração Previa da Imagem Inserida-->
    <div class="d-flex justify-content-center">
        <img id="previewImage" src="" width="286px" height="286px" class="rounded mx-auto d-block" alt="Preview">
    </div>
    <!--Ilustração Previa da Imagem Inserida-->
    <div class="d-flex flex-wrap justify-content-center mt-5">
        <!-- Aqui você pode adicionar o formulário para editar os dados do filme -->
        <form class="row g-3" method="POST" action="processa_anuncio.php">
            <!--Titulo-->
            <div class="col-md-6">
                <label for="titulo" class="form-label">Título do Anúncio</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-card-text"></i></span>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título"
                        aria-label="Título" aria-describedby="basic-addon1">
                </div>
            </div>
            <!--Titulo-->
            <!--Link da Imagem-->
            <div class="col-md-6">
                <label for="imagem" class="form-label">Link da Imagem do Anúncio</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-image"></i></span>
                    <input type="text" class="form-control" id="imagem" name="imagem_link"
                        placeholder="URL da imagem do filme" aria-label="URL da imagem do filme"
                        aria-describedby="basic-addon1">
                </div>
            </div>
            <!--Link da Imagem-->
            <!--Descrição-->
            <div class="col-12">
                <label for="descricao" class="form-label">Descrição</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-clipboard2-fill"></i></span>
                    <textarea class="form-control" id="descricao" name="descricao" aria-label="Descrição"></textarea>
                </div>
            </div>
            <!--Descrição-->
            <!--Sugerido Por-->
            <div class="col-md-6">
                <label for="sugerido_por" class="form-label">Anúnciado Por</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" id="sugerido_por" name="sugerido_por"
                        placeholder="Anúnciado Por" aria-label="Sugerido Por" aria-describedby="basic-addon1">
                </div>
            </div>
            <!--Sugerido Por-->
            <!--Botão de Enviar Edição-->
            <div class="col-12">
                <button type="submit" name="enviar" class="btn btn-primary w-100"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                    </svg>Adicionar Anuncio</button>
            </div>
            <!--Botão de Enviar Edição-->
        </form>
    </div>

    <div class="w-100 d-flex justify-content-end">
        <div class="d-flex align-items-center p-2 calender rounded-start-pill bg-primary">
            <i class="bi bi-film me-2 icon-filme"></i>
            <p id="dia-ifilmes" class="m-0 badge <?php echo $row['filme_AorF'] == 1 ? 'text-bg-success' : 'text-bg-danger';?> "></p>
        </div>
    </div>

    <script>
        $('.d-block').on('error', function () {
            console.log('A imagem falhou ao carregar.');
            $(this).attr('src', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png'); // Substitui a imagem por uma alternativa
        });
        // Função para atualizar a imagem em tempo real enquanto o usuário digita o URL da imagem
        document.getElementById('imagem').addEventListener('input', function () {
            var imgElement = document.getElementById('previewImage');
            var inputValue = this.value.trim();

            if (inputValue) {
                imgElement.src = inputValue;
            } else {
                imgElement.src = 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';
            }
        });
    </script>
    <script src="../js/script-home_.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var imagemInput = document.querySelector('input[name="imagem_link"]');
            var imagemPreview = document.querySelector('.d-block');

            imagemInput.addEventListener('input', function () {
                var imagemLink = imagemInput.value.trim();
                if (imagemLink !== '') {
                    imagemPreview.src = imagemLink;
                } else {
                    // Se o campo estiver vazio, exiba a imagem de placeholder
                    imagemPreview.src = 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png';
                }
            });
        });
    </script>
</body>

</html>