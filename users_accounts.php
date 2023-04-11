<?php
    include 'components/connect.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:index.php');
    }

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
        $delete_users->execute([$delete_id]);
        $delete_order = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
        $delete_order->execute([$delete_id]);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
