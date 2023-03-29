<?php

    include 'config.php';

    session_start();

    $user_id = "guest";
    if(isset($_SESSION['user_id'])){
        
        $user_id = $_SESSION['user_id'];
    }

    if(isset($_POST['add_to_cart'])){

        $product_id = $_POST['product_id'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];
        $ticket = $_POST['ticket'];


        $select_ticket = mysqli_query($conn, "SELECT * FROM `ticket` WHERE expiry = '$ticket' ") or die('query failed');

        $fetch_ticket = mysqli_fetch_assoc($select_ticket);

        $ticket_id = $fetch_ticket['id'];
     
        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE tour_id = '$product_id' AND user_id = '$user_id'") or die('query failed');
        
        if(mysqli_num_rows($check_cart_numbers) > 0){
            $message[] = 'Sản phẩm đã tồn tại trong giỏ hàng ';
        }else{
            mysqli_query($conn, "INSERT INTO `cart`(tour_id, ticket_id, user_id, price, amount) VALUES('$product_id', '$ticket_id', '$user_id', '$product_price', '$product_quantity')") or die('query failed');

            $message[] = 'Thêm vào giỏ hàng thành công';
        }
     
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- custom css file link  -->
    <link rel="stylesheet" href="./css/style.css">

    <style>
        header .navbar a:nth-child(2) {
            color:var(--orange);
        }
    </style>

</head>
<body>
   
    <?php include 'header.php'; ?>

    <section class="search-form">
        <form action="" method="post">
            <input type="text" name="search" placeholder="Tìm kiếm" class="box">
            <input type="submit" name="submit" value="Tìm" class="btn">
        </form>
    </section>


    <section class="category">
    <form action="shop.php" method="post">
            <input type="submit" name="" value="Tất cả" class="btn">
        </form>
        <form action="" method="post">
            <input type="hidden" name="category_id" value="1">
            <input type="submit" name="category" value="Khu Vực Miền Bắc" class="btn">
        </form>

        <form action="" method="post">
            <input type="hidden" name="category_id" value="2">
            <input type="submit" name="category" value="Khu Vực Trung" class="btn">
        </form>

        <form action="" method="post">
            <input type="hidden" name="category_id" value="3">
            <input type="submit" name="category" value="Khu Vực Miền Nam" class="btn">
        </form>
    </section>

    <section class="products" style="padding-top: 0;">

        

        <section class="packages" id="packages">

            <div class="box-container">
                <?php
                    if(isset($_POST['category'])){
                        $category_id = $_POST['category_id'];
                        // $id = 1;
    
                        $stmt = $conn->prepare("CALL select_product_category(?)");
                        $stmt->bind_param('i', $category_id);
                        $stmt->execute();
    
                        $result = $stmt->get_result();
                        if($result != NULL){
                            while($fetch_product_category = $result->fetch_array(MYSQLI_BOTH)){
                ?>

                <form action="" method="post" class="box">
                    <img class="image" src="<?php echo $fetch_product_category['image_url']; ?>" alt="">
                    <div class="content">
                        <h3> <i class="fas fa-map-marker-alt"></i> <?php echo $fetch_product_category['name']; ?> </h3>

                        <p class="description"><?php echo $fetch_product_category['description']; ?></p>

                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    
                        <div class="price product-money"><?php echo $fetch_product_category['price']; ?></div>

                        <select name="ticket" class="ticket">
                            <option value="7" selected>Loại vé 7 ngày 70.000 đ</option>
                            <option value="10">Loại vé 10 ngày 100.000 đ</option>
                            <option value="14">Loại vé 14 ngày 140.000 đ</option>
                        </select>

                        <input type="number" name="product_quantity" value="1" min="0" class="qty">

                    
                        <input type="hidden" name="product_id" value="<?php echo $fetch_product_category['id']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product_category['price']; ?>">

                        <input type="hidden" name="product_name" value="<?php echo $fetch_product_category['name']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product_category['image_url']; ?>">
                        <?php
                                if($user_id == "guest"){  
                        ?>

                        
                        <a href="login.php" class="btn" onclick="return confirm('Bạn cần đăng nhập để thực hiện chức năng này. Bạn có muốn đăng nhập ngay ?');">
                                Thêm vào giỏ hàng
                        </a>

                        <?php
                                }
                                else{
                        ?>

                        <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">

        
                        <?php
                                }
                        ?>
                    </div>
                </form>
                

                <?php
                            }
                        }else{
                            echo '<p class="empty">Không tìm thấy</p>';
                        }
                    }
                    else if(isset($_POST['submit'])){
                        $search_item = $_POST['search'];
                        $select_products = mysqli_query($conn, "SELECT * FROM `tour` WHERE name LIKE '%{$search_item}%'") or die('query failed');
                        if(mysqli_num_rows($select_products) > 0){
                            while($fetch_product = mysqli_fetch_assoc($select_products)){
                ?>
                <form action="" method="post" class="box">
                    <img class="image" src="<?php echo $fetch_product['image_url']; ?>" alt="">
                    <div class="content">
                        <h3> <i class="fas fa-map-marker-alt"></i> <?php echo $fetch_product['name']; ?> </h3>

                        <p class="description"><?php echo $fetch_product['description']; ?></p>

                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    
                        <div class="price product-money"><?php echo $fetch_product['price']; ?></div>

                        <select name="ticket" class="ticket">
                            <option value="7" selected>Loại vé 7 ngày 70.000 đ</option>
                            <option value="10">Loại vé 10 ngày 100.000 đ</option>
                            <option value="14">Loại vé 14 ngày 140.000 đ</option>
                        </select>

                        <input type="number" name="product_quantity" value="1" min="0" class="qty">

                    
                        <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">

                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image_url']; ?>">
                        <?php
                                if($user_id == "guest"){  
                        ?>
                        
                        <a href="login.php" class="btn" onclick="return confirm('Bạn cần đăng nhập để thực hiện chức năng này. Bạn có muốn đăng nhập ngay ?');">
                                Thêm vào giỏ hàng
                        </a>

                        <?php
                                }
                                else{
                        ?>

                        <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">

        
                        <?php
                                }
                        ?>
                    </div>
                </form>

        
                <?php
                            }
                        }else{
                            echo '<p class="empty">Không tìm thấy</p>';
                        }
                    }else{
                        $select_products = mysqli_query($conn, "SELECT * FROM `tour`") or die('query failed');
                        if(mysqli_num_rows($select_products) > 0){
                            while($fetch_products = mysqli_fetch_assoc($select_products)){
            
                ?>
                
                <form action="" method="post" class="box">
                    <img class="image" src="<?php echo $fetch_products['image_url']; ?>" alt="">
                    <div class="content">
                        <h3> <i class="fas fa-map-marker-alt"></i> <?php echo $fetch_products['name']; ?> </h3>

                        <p class="description"><?php echo $fetch_products['description']; ?></p>

                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    
                        <div class="price product-money"><?php echo $fetch_products['price']; ?> </div>

                        <select name="ticket" class="ticket">
                            <option value="7" selected>Loại vé 7 ngày 70.000 đ</option>
                            <option value="10">Loại vé 10 ngày 100.000 đ</option>
                            <option value="14">Loại vé 14 ngày 140.000 đ</option>
                        </select>

                        <input type="number" name="product_quantity" value="1" min="0" class="qty">

                    
                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">

                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image_url']; ?>">

                        <?php
                                if($user_id == "guest"){  
                        ?>

                        
                        <a href="login.php" class="btn" onclick="return confirm('Bạn cần đăng nhập để thực hiện chức năng này. Bạn có muốn đăng nhập ngay ?');">
                                Thêm vào giỏ hàng
                        </a>

                        <?php
                                }
                                else{
                        ?>

                        <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">

        
                        <?php
                                }
                        ?>
                    </div>
                </form>
                        
                <?php
                            }
                        }else{
                            echo '<p class="empty">no products added yet!</p>';
                        }
                    }
                ?>
            </div>

        </section>

    </section>


    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>
</html>