<?php
include_once ('config.php');

if (isset($_POST['confirmar'])) {
    $id = $_POST['id'];
    $matricula = $_POST['matricula'];

    // Inserir a matrícula na tabela login_tb
    $insert_sql = "INSERT INTO login_tb (matricula) VALUES ('$matricula')";
    if ($conn->query($insert_sql) === TRUE) {
        // Deletar a matrícula da tabela cadastrar_matriculas
        $delete_sql = "DELETE FROM cadastrar_matriculas WHERE id = '$id'";
        if ($conn->query($delete_sql) === TRUE) {
            header('Location: addM.php');
            exit();
        } else {
            echo "Erro ao deletar a matrícula: " . $conn->error;
        }
    } else {
        echo "Erro ao inserir a matrícula: " . $conn->error;
    }
} else {
    if (isset($_POST['editar'])) {
        $id = $_POST['id'];
        $matricula = $_POST['matricula'];
        header('Location: editM.php?id=' . $id . '&matricula=' . $matricula);
        exit();
    } else {
        if (isset($_POST['excluir'])) {
            $id = $_POST['id'];

            // Deletar a matrícula da tabela cadastrar_matriculas
            $delete_sql = "DELETE FROM cadastrar_matriculas WHERE id = '$id'";
            if ($conn->query($delete_sql) === TRUE) {
                header('Location: addM.php');
                exit();
            } else {
                echo "Erro ao deletar a matrícula: " . $conn->error;
            }
        } else {
            // de matriculas já cadastradas
            if (isset($_POST['editar_e'])) {
                $id_e = $_POST['id_e'];
                $matricula_e = $_POST['matricula_e'];
                header('Location: editM_E.php?id_e=' . $id_e . '&matricula_e=' . $matricula_e);
                exit();
            } else {
                if (isset($_POST['excluir_e'])) {
                    $id_e = $_POST['id_e'];

                    // Deletar a matrícula da tabela login_tb
                    $delete_sql = "DELETE FROM login_tb WHERE id = '$id_e'";
                    if ($conn->query($delete_sql) === TRUE) {
                        header('Location: addM.php');
                        exit();
                    } else {
                        echo "Erro ao deletar a matrícula: " . $conn->error;
                    }
                } else {
                    header('Location: addM.php');
                    exit();
                }
            } 
        }

    }

}

?>