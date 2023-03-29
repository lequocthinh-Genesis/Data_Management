<?php

    include 'config.php';

    session_start();

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
    }

    if(isset($_POST['order_btn'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $number = $_POST['number'];
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $method = mysqli_real_escape_string($conn, $_POST['method']);
        $address = mysqli_real_escape_string($conn, $_POST['street'].', '. $_POST['state'].', '. $_POST['city'].', '. $_POST['country'] );
        $placed_on = date('d-M-Y');

        $cart_total = 0;
        $cart_products[] = '';

        $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($cart_query) > 0){
            while($cart_item = mysqli_fetch_assoc($cart_query)){
                // tour_id lấy từ cart
                $tour_id = $cart_item['tour_id'];
                $select_tour = mysqli_query($conn, "SELECT * FROM `tour` WHERE id = '$tour_id'") or die('query failed');
                $fetch_tour = mysqli_fetch_assoc($select_tour);


                $cart_products[] = $fetch_tour['name'].' ('.$cart_item['amount'].') ';
                $sub_total = ($cart_item['price'] * $cart_item['amount']);
                $cart_total += $sub_total;
            }
        }

        $total_products = implode(', ',$cart_products);

        if($cart_total == 0){
            $message[] = 'Không có sản phẩm trong giỏ hàng';
        }else{
            mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, address, total_products, total_price, payment_status, method) VALUES('$user_id', '$name', '$number', '$email', '$address', '$total_products', '$cart_total', 'đang chờ xác nhận ', '$method')") or die('query failed');
            $message[] = 'Đặt hàng thành công';
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        }
   
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
    <?php include 'header.php'; ?>

    <section class="display-order">

        <?php  
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    $total_price = ($fetch_cart['price'] * $fetch_cart['amount']);
                    $grand_total += $total_price;

                    // tour_id lấy từ cart
                    $tour_id = $fetch_cart['tour_id'];
                    $select_tour = mysqli_query($conn, "SELECT * FROM `tour` WHERE id = '$tour_id'") or die('query failed');
                    $fetch_tour = mysqli_fetch_assoc($select_tour);
        ?>
        <p> <?php echo $fetch_tour['name']; ?> (<span class="product-money"><?php echo $fetch_cart['price']; ?></span> <?php echo ' x '. $fetch_cart['amount']; ?>) </p>
        <?php
                }
            }else{
                echo '<p class="empty">chưa có vé nào</p>';
            }
        ?>
        <div class="grand-total"> Tổng giá trị : <span class="product-money"><?php echo $grand_total; ?></span> </div>

    </section>

    <section class="checkout">

        <form action="" method="post">
            <h3>Thông tin đơn hàng</h3>
            <div class="flex">
                <div class="inputBox">
                    <span>Tên của bạn :</span>
                    <input type="text" name="name" required placeholder="Nhập vào tên của bạn">
                </div>
                <div class="inputBox">
                    <span>Số điện thoại của bạn :</span>
                    <input type="number" name="number" required placeholder="Nhập vào số điện thoại">
                </div>
                <div class="inputBox">
                    <span>Email của bạn :</span>
                    <input type="email" name="email" required placeholder="Nhập vào email">
                </div>
                <div class="inputBox">
                    <span>Quốc gia :</span>
                    <input type="text" name="country" required placeholder="Nhập vào quốc gia">
                </div>
                <div class="inputBox">
                    <span>Thành Phố :</span>
                    <input type="text" name="city" required placeholder="Nhập vào thành phố">
                </div>
                <div class="inputBox">
                    <span>Quận/huyện :</span>
                    <input type="text" name="state" required placeholder="Nhập vào quận/huyện">
                </div>
                <div class="inputBox">
                    <span>Xã, Tên đường, số nhà :</span>
                    <input type="text" name="street" required placeholder="Nhập vào xã, tên đường, số nhà">
                </div>

                <div class="inputBox">
                    <span>Phương thức thanh toán :</span>
                    <select name="method">
                        <option value="Thanh toán khi nhận vé">Thanh toán khi nhận vé</option>
                        <option value="Thanh toán qua thẻ tín dụng">Thanh toán qua thẻ tín dụng</option>
                        <option value="Thanh toán qua ví Momo">Thanh toán qua ví Momo</option>
                        <option value="Thanh toán qua zalo pay">Thanh toán qua zalo pay</option>
                    </select>
                </div>        
            </div>
            <input type="submit" value="Đặt vé" class="btn" name="order_btn">
        </form>
    </section>

    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>
</html>