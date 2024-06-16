<?php
session_start();
include_once ('config.php');
if ((!isset($_SESSION['matricula']) == true)) {
    unset($_SESSION['matricula']);
    header('Location: ../login.html');
    exit();
}

// Verifica se o usuário é um administrador
$logado = $_SESSION['matricula'];

if ($logado != '19111413') {
    header('Location: home.php');
    exit();
}

// Consulta a tabela cadastrar_matriculas
$sql = "SELECT * FROM cadastrar_matriculas ORDER BY id ASC";
$result = $conn->query($sql);
$sql2 = "SELECT * FROM login_tb ORDER BY id ASC";
$result2 = $conn->query($sql2);
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
                            <li class="nav-item">
                                <a class="nav-link text-center text-warning" href="addM.php"
                                    style="border-bottom: 5px solid white;">Cadastrar Matriculas</a>
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
        <p class="text-center fw-bold fs-2 bg-primary p-2 mt-2 rounded w-50 text-white">Cadastrar Matriculas Solicitadas
        </p>
    </span>

    <div class="d-flex flex-wrap justify-content-evenly mt-5">
        <table class="table table-dark table-bordered m-2 me-5 ms-5">
            <thead>
                <tr>
                    <th scope="col" class="rounded-bottom-0 rounded-end border-top border-0 text-center">Matriculas Não Registradas</th>
                    <th scope="col" class="bg-secondary-subtle border-top border-0"></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td width='80%' class='text-center'>{$row['matricula_solici']}</td>";
                        echo "<td class='d-flex p-0'>";
                        echo "<form action='processa_matricula.php' method='POST' class='w-100 d-flex'>";
                        echo "<input type='hidden' name='id' value='{$row['id']}'>";
                        echo "<input type='hidden' name='matricula' value='{$row['matricula_solici']}'>";
                        echo "<button type='submit' name='confirmar' class='p-2 w-100 rounded-0 btn btn-outline-success'><i class='bi bi-check-circle-fill'></i></button>";//confirmar a matricula
                        echo "<button type='submit' name='editar' class='p-2 w-100 rounded-0 btn btn-outline-primary'><i class='bi bi-pencil-fill'></i></button>";//editar matricula
                        echo "<button type='submit' name='excluir' class='p-2 w-100 rounded-0 btn btn-outline-danger'><i class='bi bi-trash3-fill'></i></button>";//deletar matricula
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Nenhuma matrícula solicitada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <!--\/Matriculas já cadastradas\/-->
        <table class="table table-dark table-bordered m-2 me-5 ms-5">
            <thead>
                <tr>
                    <th scope="col" class="rounded-bottom-0 rounded-end border-top border-0 text-center">Matriculas Registradas</th>
                    <th scope="col" class="bg-secondary-subtle border-top border-0"></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) {
                        if ($row['matricula'] == '19111413') {
                            echo "<tr>";
                            echo "<td width='80%' class='text-center'>{$row['matricula']}</td>";
                            echo "<td class='d-flex p-0'>";
                            echo "<form action='processa_matricula.php' method='POST' class='w-100 d-flex'>";
                            echo "<input type='hidden' name='id' value='{$row['id']}'>";
                            echo "<input type='hidden' name='matricula' value='{$row['matricula']}'>";
                            echo "<i class='p-2 w-100 rounded-0 text-white btn bg-primary'><i class='bi bi-person-fill-gear'></i></i>";//confirmar a matricula
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        } else {
                            echo "<tr>";
                            echo "<td width='80%' class='text-center'>{$row['matricula']}</td>";
                            echo "<td class='d-flex p-0'>";
                            echo "<form action='processa_matricula.php' method='POST' class='w-100 d-flex'>";
                            echo "<input type='hidden' name='id_e' value='{$row['id']}'>";
                            echo "<input type='hidden' name='matricula_e' value='{$row['matricula']}'>";
                            echo "<button type='submit' name='editar_e' class='p-2 w-100 rounded-0 btn btn-outline-primary'><i class='bi bi-pencil-fill'></i></button>";//editar matricula
                            echo "<button type='submit' name='excluir_e' class='p-2 w-100 rounded-0 btn btn-outline-danger'><i class='bi bi-trash3-fill'></i></button>";//deletar matricula
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Nenhuma matrícula solicitada encontrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <?php

        ?>
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