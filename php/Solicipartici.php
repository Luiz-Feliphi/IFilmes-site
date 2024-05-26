<?php
    session_start();
    if(isset($_POST['submit']) && !empty($_POST['matricula2'])){
        include_once('config.php');
        $matricula = $_POST['matricula2'];   
        $sql = "SELECT * FROM login_tb";
        $result = $conn->query($sql);
        if($result ->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if($row['matricula'] == $matricula){
                    header('Location: ../participa.html');
                    exit();
                }
                else{
                    $sql_insert = "INSERT INTO cadastrar_matriculas (matricula_solici) VALUES ('$matricula')";
                    $result_insert = $conn->query($sql_insert);
                    header('Location: ../participa.html');
                    exit();
                }
            }
        }
    }
    else{
        header('Location: ../participa.html');
    }
?>
