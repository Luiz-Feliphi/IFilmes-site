<?php
session_start();
include_once ('config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['matricula'])) {
    header('Location: ../login.html');
    exit();
}

// Obtém a matrícula do usuário logado
$logado = $_SESSION['matricula'];
//configuração
$sql_config = "SELECT * FROM config_tb WHERE id = 1";
$result_config = $conn->query($sql_config);
$row = mysqli_fetch_assoc($result_config);

if (isset($_GET['sugerir_AorF'])) {
    $sugerir_AorF = $_GET['sugerir_AorF'];
    $sql_config = "UPDATE config_tb SET sugerir_AorF = $sugerir_AorF WHERE id = 1";
    $result_config = $conn->query($sql_config);
    header('Location: sugeriF.php');
} else if (isset($_GET['sugerir_AorF']) == FALSE) {
    $sql_config = "SELECT * FROM config_tb WHERE id = 1";
    $result_config = $conn->query($sql_config);
}
//configuração
$sql_matricula_sugi = "SELECT * FROM sugeri_envi WHERE matricula = '$logado'";
$result_matricula_sugi = $conn->query($sql_matricula_sugi);
if($result_matricula_sugi->num_rows > 0){
    $row_matricula_sugi = mysqli_fetch_assoc($result_matricula_sugi);
    if($row_matricula_sugi['matricula'] == $logado || $row['sugerir_AorF'] == 0){
        $sugeri_C_disabled = 'disabled';
        $sugeri_disabled = 'disabled';
    } else {
        $sugeri_C_disabled = '';
        $sugeri_disabled = 'required';
    }
} else if($row['sugerir_AorF'] == 0){
    $sugeri_C_disabled = 'disabled';
    $sugeri_disabled = 'disabled';
} else {
    $sugeri_C_disabled = '';
    $sugeri_disabled = 'required';
}
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
    <title>IFilmes Web Site</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        <li class="nav-item">
                            <a class="nav-link text-white text-center" style="border-bottom: 5px solid white;"
                                href="#">Sugerir Filme</a>
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
                        <?php endif; ?>
                        <!-- Para ADMs -->
                    </ul>
                </div>
            </div>
            <?php if ($logado == '19111413'): ?>
                <!--Fechar-->
                <?php if ($row['sugerir_AorF'] == 1): ?>
                    <a href="sugeriF.php?sugerir_AorF=0"
                        class="navbar-brand d-flex align-items-center me-2 ms-2 text-white btn btn-danger close"
                        id="fecharInputs" style="font-size: smaller;">Fechar</a>
                <?php else: ?>
                    <a href="sugeriF.php?sugerir_AorF=1"
                        class="navbar-brand d-flex align-items-center me-2 ms-2 text-white btn btn-success close"
                        id="fecharInputs" style="font-size: smaller;">Abrir</a>
                <?php endif; ?>
                <!--Fechar-->
            <?php endif; ?>
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
        <p class="text-center fw-bold fs-2 bg-primary p-2 text-white w-100">Alguma Sugestão ?</p>
    </span>
    <!--Sugestão de Filme-->
    <div class="d-flex flex-wrap justify-content-center mt-5">
        <div class="card border border-3 rounded bg-primary border-primary" style="width: 18rem;">
            <form method="post" action="processar_sugestao.php?matricula=<?php echo $logado?>">
                <input type="text" class="form-control mt-2" name="imagem_link" placeholder="Link da Imagem"
                    aria-label="Username" aria-describedby="basic-addon1" <?php echo $sugeri_disabled;?>>
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png"
                    width="286px" height="286px" class="card-img-top rounded-0" alt="...">
                <div class="card-body bg-white">
                    <ul class="list-group list-group-flush">
                        <h5 class="card-title"><input type="text" class="form-control" name="nome" placeholder="Nome"
                                aria-label="Username" aria-describedby="basic-addon1" <?php echo $sugeri_disabled;?>></h5>
                        <span class="input-group-text">Descrição</span>
                        <textarea name="descricao" class="form-control" type="text" placeholder=" " aria-label="Disabled input example" <?php echo $sugeri_disabled;?>> </textarea>
                        <h5 class="card-title">
                            <input type="text" class="form-control mt-2" name="posto_por" placeholder="Sugerido Por"
                                aria-label="Username" aria-describedby="basic-addon1" <?php echo $sugeri_C_disabled; ?>>
                            <h6 style="font-size: 9pt;" class="text-body-tertiary d-flex justify-content-end">
                                <div class="text-body-emphasis">
                                    <input class="form-check-input anonymo" type="checkbox" value=""
                                        id="flexCheckDefault" <?php echo $sugeri_C_disabled; ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Anonymo
                                    </label>
                                </div>
                            </h6>
                        </h5>
                        <input type="submit"
                            class="list-group-item btn w-100 h-100 rounded-0 rounded-bottom btn-primary sugestao"
                            value="Sugerir" <?php echo $sugeri_disabled;?>>
                    </ul>
                </div>
            </form>
        </div>
    </div>
    <!--Sugestão de Filme-->
    <!--DIA DO FILME-->
    <div class="w-100 d-flex justify-content-end">
        <div class="d-flex align-items-center p-2 calender rounded-start-pill bg-primary">
            <i class="bi bi-film me-2 icon-filme"></i>
            <p id="dia-ifilmes"
                class="m-0 badge <?php echo $row['filme_AorF'] == 1 ? 'text-bg-success' : 'text-bg-danger'; ?> "></p>
        </div>
    </div>
    <!--DIA DO FILME-->

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
            var inputs = document.querySelectorAll('input, textarea, button');

            // verifica se os inputs e o textarea estão vazios, se sim o botão de enviar a sugestao é desabilitado
            inputs.forEach(function (input) {
                input.addEventListener('input', function () {
                    var nome = document.querySelector('input[name="nome"]').value.trim();
                    var descricao = document.querySelector('textarea[name="descricao"]').value.trim();
                    var postoPor = document.querySelector('input[name="posto_por"]').value.trim();
                    var imagemLink = document.querySelector('input[name="imagem_link"]').value.trim();
                    var botaoSugerir = document.querySelector('.sugestao');
                    botaoSugerir.setAttribute('disabled', 'disabled');
                    if (nome === '' || descricao === '' || imagemLink === '') {
                        botaoSugerir.setAttribute('disabled', 'disabled');
                    } else {
                        botaoSugerir.removeAttribute('disabled');
                    }

                    if (postoPor === '') {
                        postoPor.value = 'Anonymo';
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            var checkbox = document.querySelector('.anonymo');
            var input = document.querySelector('input[name="posto_por"]');

            checkbox.addEventListener('change', function () {
                if (checkbox.checked) {
                    input.value = 'Anonymo';
                    input.setAttribute('disabled', 'disabled');
                } else {
                    input.value = '';
                    input.removeAttribute('disabled');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            var imagemInput = document.querySelector('input[name="imagem_link"]');
            var imagemPreview = document.querySelector('.card-img-top');

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
</body>

</html>