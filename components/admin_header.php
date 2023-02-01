<?php
    if(isset($message)){
        foreach($message as $message){
            echo '<div class="message"><span>'.$message.'</span><i class="fas fa-times" onclick="this.parentElemnt.remove();"></i></div>';
        }
    }
?>

<header class="header">
    <section class="flex">
        <a href="dashboard.php" class="logo">Painel <span>Administrativo</span></a>
        <nav class="navbar">
            <a href="dashboard.php">Home</a>
            <a href="products.php">Produtos</a>
            <a href="placed_orders.php">Pedidos</a>
            <a href="admin_accounts.php">Admins</a>
        </nav>
    </section>
</header>
