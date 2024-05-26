<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "ifilmes_db";

    $conn = mysqli_connect($host, $user, $password, $database);
    // Obtém a matrícula do usuário logado
    $logado = $_SESSION['matricula'];
