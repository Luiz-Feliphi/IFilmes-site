<?php
    session_start();
    if(isset($_POST['submit']) && !empty($_POST['matricula'])){
        include_once('config.php');
        $matricula = $_POST['matricula'];
        $matricula_error = $matricula;
        $sql = "SELECT * FROM login_tb WHERE matricula = '$matricula'";
        $result = $conn->query($sql);

        //print_r($result);
        if(mysqli_num_rows($result) < 1){
            unset($_SESSION['matricula']);
            // mande ele para a página de erro chamada errologin.php e passe a matricula como parâmetro
            header('Location: errologin.php?matricula_error='.$matricula_error);
        }
        else{
            $_SESSION['matricula'] = $matricula;
            header('Location: home.php');
        }
    }
    else{
        header('Location: ../login.html');
    }
    
?>