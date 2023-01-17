<?php
    include 'components/connect.php';
    session_start();
    if(isset($_POST['submit'])){

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
        $select_admin->execute([$name, $pass]);

        if($select_admin->rowCount() > 0){
            $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
            $_SESSION['admin_id'] = $fetch_admin_id['id'];
            header('location:dashboard.php');
        }else{
            $message[] = 'Usuário ou senha incorretos!';
        }

    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
</head>
<body>
    <?php
        if(isset($message)){
            foreach($message as $message){
                echo'
                    <div class="message">
                        <span>'.$message'</span>
                        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                    </div>
                ';
            }
        }
    ?>
    <!-- admin login form section starts -->
    <section class="form-container">
        <form action="POST">
            <h3>Entrar</h3>
            <input type="text" name="name" maxlength="20" required placeholder="Digite seu email" class="box" oninput="this.value = this.value.replace(/\s/g,'')">
            <input type="password" name="pass" maxlength="20" required placeholder="Digite sua senha" class="box" oninput="this.value = this.value.replace(/\s/g,'')">
            <input type="submit" value="Login" class="btn" name="submit">
        </form>
    </section>
</body>
</html>
