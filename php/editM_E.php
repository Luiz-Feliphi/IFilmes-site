<?php
session_start();
include_once ('config.php');
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

$id = $_GET['id_e'];
$matricula = $_GET['matricula_e'];

// Atualizar a matrícula no banco de dados quando o formulário for submetido
if (isset($_POST['matricula_e'])) {
    $nova_matricula = $_POST['matricula_e'];
    $sql = "UPDATE login_tb SET matricula = '$nova_matricula' WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>alert('Matricula editada com sucesso!');</script>";
        header('Location: addM.php');
    } else {
        echo "<script>alert('Erro ao editar a matricula!');</script>";
        header('Location: addM.php');
    }
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
        <p class="text-center fw-bold fs-2 bg-primary p-2 mt-2 rounded w-50 text-white">Editar Matricula Cadastrada</p>
    </span>

    <div class="d-flex flex-wrap justify-content-evenly mt-5">
        <div class="card bg-primary text-white m-2" style="width: 18rem;">
            <div class="card-body">
                <a id="toggleButton" href="addM.php" class="d-flex justify-content-center btn btn-info icon-link icon-link-hover"
                    style="--bs-icon-link-transform: translate3d(-.125rem, 0, 0);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                        <path
                            d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                    </svg>
                    Voltar
                </a>
                <h5 class="card-title">Editar Matricula</h5>
                <form action="editM_E.php?id_e=<?php echo $id; ?>" method="POST">
                    <div class="mb-3">
                        <label for="matricula_e" class="form-label">Matricula</label>
                        <input type="text" class="form-control" id="matricula_e" name="matricula_e"
                            value="<?php echo $matricula; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-warning text-primary"><i
                            class='bi bi-pencil-fill me-2'></i>Editar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="w-100 d-flex justify-content-end">
        <div class="d-flex align-items-center p-2 calender rounded-start-pill bg-primary">
            <i class="bi bi-film me-2 icon-filme"></i>
            <p id="dia-ifilmes" class="m-0 badge <?php echo $row['filme_AorF'] == 1 ? 'text-bg-success' : 'text-bg-danger';?> "></p>
        </div>
    </div>

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