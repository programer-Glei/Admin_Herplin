<?php
    include 'components/connect.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:index.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- custom css file link -->
    <link rel="stylesheet" href="css/estilo.css">
    <title>Painel de controle</title>
</head>
<body>
    <?php include 'components/admin_header.php'?>
    <section class="dashboard">
        <h1 class="heading">Painel de controle</h1>
        <div class="box-container">
            <div class="box">
                <h3>Bem-vindo!</h3>
                <p><?=$fetch_profile['name']; ?></p>
            </div>
        </div>
    </section>
</body>
</html>
