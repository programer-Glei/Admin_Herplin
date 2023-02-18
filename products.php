<?php
    header('Content-Type: text/html; charset=utf-8');
    include 'components/connect.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:index.php');
    };

    if(isset($_POST['add_product'])){

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);
        $category = $_POST['category'];
        $category = filter_var($category, FILTER_SANITIZE_STRING);

        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img'.$image;

        $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
        $select_products->execute([$name]);

        if($select_products->rowCount() > 0){
            $message[] = 'Produto já existe!';
        }else{
            if($image_size > 2000000){
                $message[] = 'O tamanho da imagem é muito grande';
            }else{
                move_uploaded_file($image_tmp_name,$image_folder);

                $insert_product = $conn->prepare("INSERT INTO `products`(name, category, price, image) VALUES(?,?,?,?)");
                $insert_product->execute([$name,$category,$price,$image]);

                $message[] = 'Novo produto adicionado!';
            }
        }
    }

    if(isset($_GET['delete'])){

        $delete_id = $_GET['delete'];
        $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $delete_product_image->execute([$delete_id]);
        $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
        unlink('uploaded_img').$fetch_delete_image['image'];
        $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
        $delete_product->execute([$delete_id]);
        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
        $delete_cart->execute([$delete_id]);
        header('location:products.php');
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
    <title>Produtos</title>
</head>
<body>
    <?php include 'components/admin_header.php' ?>

    <!-- add products section starts -->
    <section class="add-products">
        <form action="" method="POST" enctype="multipart/form-data">
            <h3>Adicionar produto</h3>
        </form>
    </section>
</body>
</html>
