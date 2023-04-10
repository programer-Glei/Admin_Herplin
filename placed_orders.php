
<?php
    header('Content-Type: text/html; charset=utf-8');
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
        $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
        $delete_order->execute([$delete_id]);
        header('location:placed_orders.php');
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
    <title>Pedidos</title>
</head>
<body>
    <?php include 'components/admin_header.php' ?>

    <!--  placed orders section starts  -->
    <section class="placed-orders">
        <h1 class="heading">Pedidos Feitos</h1>
        <div class="box-container">
            <?php
                $select_orders = $conn->prepare("SELECT * FROM `orders`");
                $select_orders->execute();
                if($select_orders->rowCount() > 0){
                    while($fecth_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
            ?>

            <div class="box">
                <p>ID do usuário: <span><?= $fecth_orders['user_id'];?></span></p>
                <p>Data: <span><?= $fecth_orders['placed_on'];?></span></p>
                <p>Nome: <span><?= $fecth_orders['name'];?></span></p>
                <p>Email: <span><?= $fecth_orders['email'];?></span></p>
                <p>Número: <span><?= $fecth_orders['number'];?></span></p>
                <p>Endereço: <span><?= $fecth_orders['address'];?></span></p>
                <p>Total de produtos: <span><?= $fecth_orders['total_products'];?></span></p>
                <p>Valor total do pedido: <span><?= $fecth_orders['total_price'];?></span></p>
                <p>Tipo de pagamento: <span><?= $fecth_orders['method']; ?></span></p>
                <form action="" method="POST">
                    <input type="hidden" name="order_id" value="<?= $fecth_orders['id'];?>">
                    <select name="payment_status" id="" class="drop-dow">
                        <option value="" selected disabled><?= $fecth_orders['payment_status'];?></option>
                        <option value="pending">Pendente</option>
                        <option value="completed">Pago</option>
                    </select>
                    <div class="flex-btn">
                        <input type="submit" value="Atualizar" class="btn" name="update_payment">
                        <a href="placed_orders.php?delete=<?= $fecth_orders['id'];?>" class="delete-btn" onclick="return confirm('Deletar este pedido?');">Deletar</a>
                    </div>
                </form>
            </div>
            <?php
                    }
                }else{
                    echo '<p class="empty">Nenhum pedido feito ainda!</p>';
                }
            ?>
        </div>
    </section>
    <!-- placed orders section ends  -->

    <!-- custom js file link -->
    <script src="java/admin_script.js"></script>
</body>
</html>
