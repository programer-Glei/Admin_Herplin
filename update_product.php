<?php
    header('Content-Type: text/html; charset=utf-8');
    include 'components/connect.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:index.php');
    }

    if(isset($_POST['update'])){

        $pid = $_POST['pid'];
        $pid = filter_var($pid, FILTER_SANITIZE_STRING);
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);
        $category = $_POST['category'];
        $category = filter_var($category, FILTER_SANITIZE_STRING);

        $update_product = $conn->prepare("UPDATE `products` SET name = ?, category = ?, price = ? WHERE id = ?");
        $update_product->execute([$name, $category, $price, $pid]);

        $message[] = 'Produto atualizado';

        $old_image = $_POST['old_image'];
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uplaoded_img/'.$image;

        if(!empty($image)){
            if($image_size > 2000000){
                $message[] = 'imagem muito grande!';
            }else{
                $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
                $update_image->execute([$image, $pid]);
                move_uploaded_file($image_tmp_name, $image_folder);
                if(empty($old_image)){
                    $message[] = 'imagem atualizada!';
                }else{
                    unlink('uplaoded_img/'.$old_image);
                    $message[] = 'imagem atualizada!';
                }
            }
        }
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
    <title>Atualizar Produtos</title>
</head>
<body>
    <?php include 'components/admin_header.php' ?>

    <!-- update product section starts -->
    <section class="update-product">
        <h1 class="heading">Atualizar produto</h1>
        <?php
            $update_id = $_GET['update'];
            $show_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $show_products->execute([$update_id]);
            if($show_products->rowCount() > 0){
                while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
            <img src="uplaoded_img/<?= $fetch_products['image']; ?>" alt="">
            <span>Atualizar nome</span>
            <input type="text" required placeholder="Digitar nome do produto" name="name" maxlength="100" class="box" value="<?= $fetch_products['name']; ?>">
            <span>Atualizar preço</span>
            <input type="text" required placeholder="Digitar preço" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_products['price']; ?>">
            <span>Atualizar categoria</span>
            <select name="category" id="" class="box" required>
                <option selected value="<?= $fetch_products['category']; ?>"><?= $fetch_products['category']; ?></option>
                <option value="main dish">Prato principal</option>
                <option value="fast food">Comida rápida</option>
                <option value="drinks">Bebidas</option>
                <option value="desserts">Sobremesa</option>
            </select>
            <span>Atualizar Imagem</span>
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
            <div class="flex-btn">
                <input type="submit" value="Atualizar" class="btn" name="update">
                <a href="products.php" class="option-btn">Voltar</a>
            </div>
        </form>
        <?php
                }
            }else{
                echo '<p class="empty">Nenhum produto adicionado ainda!</p>';
            }
        ?>
    </section>
    <!-- update product section ends -->

    <!-- custom js file link -->
    <script src="java/admin_script.js"></script>
</body>
</html>
