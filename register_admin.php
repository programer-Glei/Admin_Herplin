<?php
    header('Content-Type: text/html; charset=utf-8');
    include 'components/connect.php';
    session_start();

    if(isset($_SESSION['admin_id'])){
        $admin_id = $_SESSION['admin_id'];
    }else{
        $admin_id = '';
    }

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        $cpass = $_POST['cpass'];
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

        $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
        $select_admin->execute([$name]);

        if($select_admin->rowCount() > 0){
            $message[] = 'Usuário já existe!';
        }else{
            if($pass != $cpass){
                $message[] = 'Confirmação da senha tá diferente!';
            }else{
                $insert_admin = $conn->prepare("INSERT INTO `admin`(name, password) VALUES(?,?)");
                $insert_admin->execute([$name,$cpass]);
                $message[] = 'Novo administrador registrado!';
                header('location:dashboard.php');
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Criar login - Herplim</title>
</head>
<body>
    
</body>
</html>
