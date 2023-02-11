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
            <a href="admin_accounts.php">Administradores</a>
            <a href="user_accounts.php">Usuários</a>
            <a href="messages.php">Mensagens</a>
        </nav>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>
        <div class="profile">
            <?php
                $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
                $select_profile->execute([$admin_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <p><?=$fetch_profile['name'];?></p>
            <a href="update_profile.php" class="btn">Detalhes do perfil</a>
            <a href="components/admin_logout.php" onclick="return confirm('Sair deste site');" class="delete-btn">Sair</a>
        </div>
    </section>
</header>
