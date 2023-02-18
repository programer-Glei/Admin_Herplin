<?php
    header('Content-Type: text/html; charset=utf-8');
    include 'components/connect.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:index.php');
    }

    if(isset($_POST['submit'])){

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        if(!empty($name)){
            $select_name = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
            $select_name->execute([$name]);
            if($select_name->rowCount() > 0){
                $message[] = 'email já utilizado';
            }else{
                $update_name = $conn->prepare("UPDATE `admin` SET name = ? WHERE id = ?");
                $update_name->execute([$name, $admin_id]);
            }
        }

        $new_pass = $_POST['new_pass'];
        $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
        $confirm_pass = $_POST['confirm_pass'];
        $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);
        

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
            <h3>Atualizar Perfil</h3>
            <input type="text" name="name" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')" placeholder="<?= $fetch_profile['name']; ?>">
            <input type="password" name="new_pass" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')" placeholder="Digitar nova senha">
            <input type="password" name="confirm_pass" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')" placeholder="Confirmar nova senha">
            <input type="submit" value="Atualizar" name="submit" class="btn">
        </form>
    </section>
    <!-- admin profile update section ends -->

    <!-- custom js file link -->
    <script src="java/admin_script.js"></script>
</body>
</html>
