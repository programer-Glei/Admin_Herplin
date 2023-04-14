<?php
    include 'components/connect.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:index.php');
    }

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
        $delete_message->execute($delete_id);
        header('messages.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/estilo.css">
    <title>Mensagens</title>
</head>
<body>
    <?php include 'components/admin_header.php'  ?>

    <!-- messages section starts  -->
    <section class="messages">
        <h1 class="heading">Mensagens</h1>
        <div class="box-container">
            <?php
                $select_messages = $conn->prepare("SELECT * FROM `messages`");
                $select_messages->execute();
                if($select_messages->rowCount() > 0){
                    while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC))
                }else{

                }
            ?>
            <div class="box">
                <p>Nome: <span></span></p>
            </div>
        </div>
    </section>
</body>
</html>
