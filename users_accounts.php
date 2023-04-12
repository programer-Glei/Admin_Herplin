<?php
    header('Content-Type: text/html; charset=utf-8');
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
    <!-- font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- custom css file link -->
    <link rel="stylesheet" href="css/estilo.css">
    <title>Contas de usuários</title>
</head>
<body>
    <?php include 'components/admin_header.php' ?>

    <!-- user accounts section starts -->
    <section class="accounts">
        <h1 class="heading">Contas de usuários</h1>
        <div class="box-container">
            <?php
                $select_accounts = $conn->prepare("SELECT * FROM `users`");
                $select_accounts->execute();
                if($select_accounts->rowCount() > 0){
                    while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="box">
                <p>Id do usuário: <span><?= $fetch_accounts['id']; ?></span></p>
                <p>Nome: <span><?= $fetch_accounts['name']; ?></span></p>
                <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('Deletar esta conta?');">Deletar</a>
            </div>
            <?php
                    }
                }else{
                    echo '<p class="empty">Nenhuma conta disponível!</p>';
                }
            ?>
        </div>
    </section>
    <!-- user accounts section ends -->

    <!-- custom js file link -->
    <script src="java/admin_script.js"></script>
</body>
</html>
