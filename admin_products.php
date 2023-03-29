<?php

    include 'config.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:login.php');
    }

    if(isset($_POST['add_product'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $price = $_POST['price'];
        $description = $_POST['details'];
        $amount = 100;
        $zone = $_POST['update_zone'];
        $image = $_POST['image'];

        
     
        $select_tour_name = mysqli_query($conn, "SELECT name FROM `tour` WHERE name = '$name'") or die('query failed');
     
        if(mysqli_num_rows($select_tour_name) > 0){
            $message[] = 'Tên sản phẩm đã tồn tại';
        }else{
            $add_product_query = mysqli_query($conn, "INSERT INTO `tour`(category_id, name, description, price, amount, image_url) VALUES('$zone', '$name', '$description', '$price', '$amount', '$image')") or die('query failed');
        }
    }
     
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM `cart` WHERE tour_id = '$delete_id'") or die('query failed');
        mysqli_query($conn, "SELECT delete_product_shop($delete_id) ") or die('query failed');
        header('location:admin_products.php');
    }
     
    if(isset($_POST['update_product'])){
     
        $update_p_id = $_POST['update_p_id'];
        $update_name = $_POST['update_name'];
        $update_price = $_POST['update_price'];
        $update_details = $_POST['details'];
        $update_zone = $_POST['update_zone'];


        
     
        mysqli_query($conn, "UPDATE `tour` SET category_id = '$update_zone', name = '$update_name', price = '$update_price', description = '$update_details' WHERE id = '$update_p_id'") or die('query failed');

        header('location:admin_products.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
    <?php include 'admin_header.php'; ?>

    <section class="add-products">

        <h1 class="title">Quản lý Tour</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Thêm Tour</h3>
            <input type="text" name="name" class="box" placeholder="Nhập vào tên tour" required>
            <input type="number" min="0" name="price" class="box" placeholder="Nhập vào giá" required>
            <textarea name="details" class="box" required placeholder="Nhập thông tin tour" cols="30" rows="10"></textarea>
            <input type="text" name="image" class="box" placeholder="Nhập vào url image" required>
            <select name="update_zone" class="update_zone">
                <option value="1" selected>Miền Bắc</option>
                <option value="2">Miền Trung</option>
                <option value="3">Miền Nam</option>
            </select>
            <input type="submit" value="Thêm tour" name="add_product" class="btn">
        </form>

    </section>

    <!-- show products  -->

    <section class="show-products">

        <div class="box-container">

            <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `tour`") or die('query failed');
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
                        $category_id = $fetch_products['category_id'];
                        $select_category = mysqli_query($conn, "SELECT * FROM `category` WHERE id = '$category_id'") or die('query failed');
                        $fetch_category = mysqli_fetch_assoc($select_category);
            ?>
            <div class="box">
                <img src="<?php echo $fetch_products['image_url']; ?>" alt="">
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <div class="price product-money"><?php echo $fetch_products['price']; ?></div>
                <div class="name"><?php echo $fetch_category['name'] ?></div>
                <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Cập nhật</a>
                <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Bạn có muốn xóa sản phẩm này ?');">Xóa</a>
            </div>
            <?php
                    }
                }else{
                    echo '<p class="empty">Chưa có sản phẩm nào</p>';
                }
            ?>
        </div>
    </section>

    <section class="edit-product-form">

        <?php
            if(isset($_GET['update'])){
                $update_id = $_GET['update'];
                $update_query = mysqli_query($conn, "SELECT * FROM `tour` WHERE id = '$update_id'") or die('query failed');
                if(mysqli_num_rows($update_query) > 0){
                    while($fetch_update = mysqli_fetch_assoc($update_query)){
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
            <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image_url']; ?>">
            <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Nhập vào tên sản phẩm">
            <input type="text" name="details" class="box" placeholder="Nhập thông tin sản phẩm" cols="30" rows="10" value="<?php echo $fetch_update['description']; ?>"></input>
            <input type="text" name="image" class="box" placeholder="Nhập vào url image" value="<?php echo $fetch_update['image_url']; ?>">
            <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="Nhập vào giá sản phẩm">
            <select name="update_zone" class="update_zone">
                <option value="1" selected>Miền Bắc</option>
                <option value="2">Miền Trung</option>
                <option value="3">Miền Nam</option>
            </select>
            <input type="submit" value="Cập nhật" name="update_product" class="btn">
            <input type="reset" value="Hủy" id="close-update" class="option-btn">
        </form>
        <?php
                    }
                }
            }else{
                echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
            }
        ?>

    </section>


    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

    <script>
        document.querySelector('#close-update').onclick = () =>{
            document.querySelector('.edit-product-form').style.display = 'none';
            window.location.href = 'admin_products.php';
        }
    </script>

</body>
</html>