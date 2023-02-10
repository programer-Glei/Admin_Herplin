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
                <a href="update_profile.php" class="btn">Atualizar Perfil</a>
            </div>
            <div class="box">
                <?php
                    $total_pendings = 0;
                    $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                    $select_pendings->execute(['pending']);
                    while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                        $total_pendings += $fetch_pendings['total_price'];
                    }
                ?>
                <h3><span>R$</span><?= $total_pendings; ?></h3>
                <p>Total de pendentes</p>
                <a href="placed_orders.php" class="btn">Ver pedidos</a>
            </div>
            <div class="box">
                <?php
                    $total_completes = 0;
                    $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                    $select_completes->execute(['completed']);
                    while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                        $total_completes += $fetch_completes['total_price'];
                    }
                ?>
                <h3><span>R$</span><?= $total_completes;?></h3>
                <p>total concluído</p>
                <a href="placed_orders.php" class="btn">Ver pedidos</a>
            </div>
            <div class="box">
                <?php
                    $select_orders = $conn->prepare("SELECT * FROM `orders`");
                    $select_orders->execute();
                    $number_of_orders = $select_orders->rowCount();
                ?>
                <h3><?= $number_of_orders;?></h3>
                <p>Pedidos totais</p>
                <a href="placed_orders.php" class="btn">Ver pedidos</a>
            </div>
            <div class="box">
                <?php
                    $select_products = $conn->prepare("SELECT * FROM `products`");
                    $select_products->execute();
                    $number_of_products = $select_products->rowCount();
                ?>
                <h3><?= $number_of_products;?></h3>
                <p>produtos adicionados</p>
                <a href="products.php" class="btn">ver produtos</a>
            </div>
        </div>
    </section>
</body>
</html>
