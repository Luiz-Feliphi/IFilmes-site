<?php
session_start();
include_once ('config.php');
if ((!isset($_SESSION['matricula']) == true)) {
    unset($_SESSION['matricula']);
    header('Location: ../login.html');
}

$logado = $_SESSION['matricula'];
// Verifica se o usuário é um administrador
$logado = $_SESSION['matricula'];

if ($logado != '19111413') {
    header('Location: home.php');
    exit();
}

$sql = "SELECT * FROM cadastrar_filmes ORDER BY id DESC";
$result = $conn->query($sql);
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>IFilmes Web Site</title>
</head>

<body class="bg-secondary-subtle">
    <div>
        <nav class="navbar navbar-expand-lg bg-secondary">
            <div class="container-fluid ">
                <a class="navbar-brand d-flex align-items-center text-white" href="home.php">
                    <img src="../img/movie.png" alt="Logo" width="64" height="64"
                        class="d-inline-block align-text-top bg-dark" id="logo">
                    IFilmes
                </a>
                <div class=" d-flex justify-content-center collapse navbar-collapse " id="navbarNavDropdown">
                    <ul class="navbar-nav ">
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
                            <li class="nav-item">
                                <a class="nav-link text-center text-warning" style="border-bottom: 5px solid white;"
                                    href="addF.php">Adicionar Filme</a>
                            </li>
                            <li class="nav-item opcao">
                                <a class="nav-link text-center text-warning" href="addM.php">Cadastrar Matriculas</a>
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
        <p class="text-center fw-bold fs-2">Filmes Sugeridos</p>

    </span>
    <div class="d-flex justify-content-end">
        <?php if ($result->num_rows > 0) {
            echo '<button id="toggleButton" class="me-5 d-flex btn btn-primary">
                    <i id="icon1" class="bi bi-caret-down-fill me-2" style="display: none" ;></i>
                    <i id="icon2" class="bi bi-caret-up-fill me-2" style="display: block;"></i>
                    Descrição
                </button>';
        } else {
            echo '<button id="toggleButton" class="me-5 d-flex btn btn-primary" disabled>
                    <i id="icon1" class="bi bi-caret-down-fill me-2" style="display: none" ;></i>
                    <i id="icon2" class="bi bi-caret-up-fill me-2" style="display: block;"></i>
                    Descrição
                </button>';
        }

        ?>
    </div>

    <div class="d-flex flex-wrap justify-content-evenly mt-5">
        <?php
        if ($result->num_rows > 0) {
            while ($info_filme = mysqli_fetch_assoc($result)) {
                echo '<div class="card border border-2 rounded bg-primary border-primary" style="width: 18rem;">';
                if ($logado == '19111413') {
                    echo '<div class="d-flex w-100 justify-content-end btn-group" role="group" style="background-color: #E2E3E5;" >';
                    echo '<a class="btn btn btn-outline-danger" style="border-bottom-left-radius:0%;" href="deleteSF.php?id=' . $info_filme['id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/></svg></a>';
                    echo '<a class="btn btn-outline-success confirm" style="border-bottom-right-radius:0%;" href="processa_filme.php?id=' . $info_filme['id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/></svg></a>';
                    echo '<a class="btn btn-outline-primary edit" style="border-bottom-right-radius:0%;" href="editSF.php?id=' . $info_filme['id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/></svg></a>';
                    echo '</div>';
                }
                echo '<img src="' . $info_filme["imagem_link"] . '" width="286px" height="286px" class="card-img-top rounded-0" alt="...">';
                echo '<div class="card-body bg-white">';
                echo '<h5 class="card-title">Nome: ' . $info_filme["nome"] . '</h5>';
                echo '<p class="card-text descricao" style="display: none;">Descrição: ' . $info_filme["descricao"] . '</p>';
                echo '</div>';
                echo '<ul class="list-group list-group-flush">';
                if ($info_filme["posto_por"] == '') {
                    echo '<li class="list-group-item">Inserido por: Anonimo</li>';
                } else {
                    echo '<li class="list-group-item">Inserido por: ' . $info_filme["posto_por"] . '</li>';
                }
                echo '</ul>';
                echo '</div>';
            }
        } else {
            echo '<div class="d-flex justify-content-center">';
            echo '<p class="text-center fw-bold fs-2 bg-primary p-2 rounded text-white">Nenhum filme sugerido</p>';
            echo '</div>';
        }
        ?>
    </div>

    </div>

    <div class="w-100 d-flex justify-content-end">
        <div class="d-flex align-items-center p-2 calender rounded-start-pill bg-primary">
            <i class="bi bi-film me-2 icon-filme"></i>
            <p id="dia-ifilmes"
                class="m-0 badge <?php echo $row['filme_AorF'] == 1 ? 'text-bg-success' : 'text-bg-danger'; ?> "></p>
        </div>
    </div>

    <script>
        $('.card-img-top').on('error', function () {
            console.log('A imagem falhou ao carregar.');
            $(this).attr('src', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png'); // Substitui a imagem por uma alternativa
        });
    </script>
    <script>
        const dia_ifilmes = document.getElementById('dia-ifilmes');
        const button_descricao = document.getElementById('toggleButton');
        const descricao = document.getElementsByClassName('descricao');

        function proximaSexta() {
            const hoje = new Date();
            let proximaSexta = new Date(hoje);
            proximaSexta.setDate(hoje.getDate() + (5 - hoje.getDay() + 7) % 7);
            const dia = proximaSexta.getDate();
            const mes = proximaSexta.getMonth() + 1;
            let diaFormatado = dia < 10 ? '0' + dia : dia;
            let mesFormatado = mes < 10 ? '0' + mes : mes;
            return diaFormatado + '/' + mesFormatado;
        }

        if (dia_ifilmes) {
            dia_ifilmes.innerText = proximaSexta();
        }

        button_descricao.addEventListener('click', function() {
            var icon1 = document.getElementById('icon1');
            var icon2 = document.getElementById('icon2');

            if (icon1.style.display === 'none') {
                icon1.style.display = 'block';
                icon2.style.display = 'none';
                for (let i = 0; i < descricao.length; i++) {
                    descricao[i].style.display = 'block';
                }
            } else {
                icon1.style.display = 'none';
                icon2.style.display = 'block';
                for (let i = 0; i < descricao.length; i++) {
                    descricao[i].style.display = 'none';
                }
            }
        });

        window.addEventListener('load', function() {
            
        });
        // Exibe o dia e o mês da próxima sexta-feira no elemento dia-ifilmes

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>