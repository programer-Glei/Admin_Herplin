
<?php
    include 'components/connect.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:index.php');
    }

    if(isset($_POST['update_payment'])){

        $order_id = $_POST['order_id'];
        $payment_status = $_POST['payment_status'];
        $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
        $update_status->execute([$payment_status, $order_id]);
        $message[] = 'Status de pagamento atualizado!';
    }

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
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
