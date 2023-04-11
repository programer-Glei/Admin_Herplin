<?php

    include 'components/connect.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:index.php');
    }

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
        $delete_admin->execute([$delete_id]);
        header('location:admin_accounts.php');
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- custom css file link -->
    <link rel="stylesheet" href="css/estilo.css">
    <title>Contas de Administradores</title>
</head>
<body>
    <?php include 'components/admin_header.php' ?>
    <!-- admins accounts section strts -->
    <section class="accounts">
        <h1 class="heading">Contas de administradores</h1>
        <div class="box-container">
            <div class="box">
                <p>Criar novo administrador</p>
                <a href="register_admin.php" class="option-btn">Criar</a>
            </div>
        </div>
    </section>
</body>
</html>
