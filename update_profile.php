<?php
    header('Content-Type: text/html; charset=utf-8');
    include 'components/connect.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:index.php');
    }

    if(isset($_POST['submit'])){

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

    <title>atualização de perfil</title>
</head>
<body>
    <?php include 'components/admin_header.php' ?>

    <!-- admin profile update section starts -->
    <section class="form-container">
        <form action="" method="POST">

        </form>
    </section>
    <!-- admin profile update section ends -->

    <!-- custom js file link -->
    <script src="java/admin_script.js"></script>
</body>
</html>
