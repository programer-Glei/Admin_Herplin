<?php

    if(isset($message)){
        foreach($message as $message){
            echo '
            <div class="message">
                <span>'.$message.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>';
        }
    }

?>

<header class="header">

        <section class="flex">
            <a href="index.php" class="logo">Yum-yum</a>

            <nav class="navbar">
                <a href="index.php" class="logo">Home</a>
                <a href="about.php" class="logo">Sobre nós</a>
                <a href="menu.php" class="logo">Menu</a>
                <a href="orders.php" class="logo">Vendas</a>
                <a href="contact.php" class="logo">Contato</a>
            </nav>

            <div class="icons">
                <?php
                    $count_user_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $count_user_cart_items->execute([$user_id]);
                    $total_user_cart_items = $count_user_cart_items->rowCount();
                ?>
                <a href="search.php"><i class="fas fa-search"></i></a>
                <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_user_cart_items;?>)</span></a>
                <div id="user-btn" class="fas fa-user"></div>
                <div id="menu-btn" class="fas fa-bars"></div>
            </div>

            <div class="profile">
                <?php
                    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                    $select_profile->execute([$user_id]);
                    if($select_profile->rowCount() > 0){
                        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>

                <p class="name"><?= $fetch_profile['name']; ?></p>
                <div class="flex">
                    <a href="profile.php" class="btn">Perfil</a>
                    <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('Sair deste site?')">Sair</a>
                </div>

                <?php
                    }else{ 
                ?>
                <p class="acconut"><a href="login.php">Faça login</a> ou <a href="register.php">Cadastre-se</a> </p>
                <?php
                     }
                ?>
            </div>

        </section>
    </header>
