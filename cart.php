<?php

    include 'config.php';

    session_start();

    $user_id = "guest";
    if(isset($_SESSION['user_id'])){
        
        $user_id = $_SESSION['user_id'];
    }

    if($user_id == "guest"){
        header('location:login.php');
    }

    

    if(isset($_POST['update_cart'])){
        $cart_id = (int)$_POST['cart_id'];
        $ticket = $_POST['ticket'];

        $cart_quantity = (int)$_POST['cart_quantity'];
        mysqli_query($conn, "SELECT update_amount_product_cart($cart_quantity, $cart_id) ") or die('query failed');
        $message[] = 'Cập nhật thành công';

        $select_ticket = mysqli_query($conn, "SELECT * FROM `ticket` WHERE expiry = '$ticket'") or die('query failed');
        $fetch_ticket = mysqli_fetch_assoc($select_ticket);

        $ticket_id = (int)$fetch_ticket['id'];
        mysqli_query($conn, "SELECT update_ticket_product_cart($ticket_id, $cart_id) ") or die('query failed');
    }

    if(isset($_POST['delete_product_cart'])){
        $delete_id = (int)$_POST['cart_id'];
        mysqli_query($conn, "SELECT delete_product_cart($delete_id) ") or die('query failed');

        header('location:cart.php');
    }

    if(isset($_GET['delete_all'])){
        mysqli_query($conn, "SELECT delete_all_product_cart($user_id) ") or die('query failed');
        header('location:cart.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
    <?php include 'header.php'; ?>

    <section class="shopping-cart">

        <h1 class="title">Tour trong giỏ</h1>

        <div class="box-container">
            <?php
                $grand_total = 0;

                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select_cart) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){

                        // tour_id lấy từ cart
                        $tour_id = $fetch_cart['tour_id'];
                        $select_tour = mysqli_query($conn, "SELECT * FROM `tour` WHERE id = '$tour_id'") or die('query failed');
                        $fetch_tour = mysqli_fetch_assoc($select_tour);

                        // ticket_id lấy từ cart
                        $ticket_id = $fetch_cart['ticket_id'];
                        $select_ticket = mysqli_query($conn, "SELECT * FROM `ticket` WHERE id = '$ticket_id'") or die('query failed');
                        $fetch_ticket = mysqli_fetch_assoc($select_ticket);


                        if($fetch_ticket['expiry'] == 7){
                            $ticket_price = 70000;
                        }
                        else if($fetch_ticket['expiry'] == 10){
                            $ticket_price = 100000;
                        }
                        else if($fetch_ticket['expiry'] == 14){
                            $ticket_price = 140000;
                        }
                        else {
                            $ticket_price = 0;
                        }

            ?>
            <div class="box">
                <form action="" method="post" >
                    <input type="submit" value="X" class="fas fa-times" onclick="return confirm('Bạn có muốn xóa sản phẩm này khỏi giỏ hàng ?');" name="delete_product_cart" >
                    <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
                </form>
                <div class="name"><?php echo $fetch_tour['name']; ?></div>
                <img src="<?php echo $fetch_tour['image_url']; ?>" alt="">
                <div class="price product-money"><?php echo $fetch_cart['price']; ?></div>
                <form action="" method="post">
                    <select name="ticket" class="ticket">
                        <option disabled selected value="">Loại vé <?php echo $fetch_ticket['expiry']; ?> ngày <span class="product-money"><?php echo $ticket_price; ?></span></option>
                        <option value="7">Loại vé 7 ngày 70.000 đ</option>
                        <option value="10">Loại vé 10 ngày 100.000 đ</option>
                        <option value="14">Loại vé 14 ngày 140.000 đ</option>
                    </select>
                    <input type="hidden" name="expiry" value="<?php echo $fetch_ticket['expiry']; ?>">


                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                    <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['amount']; ?>">
                    <input type="submit" name="update_cart" value="Cập nhật" class="btn">
                </form>
                <div class="sub-total"> Tổng cộng : <span class="product-money"><?php echo $sub_total = ($fetch_cart['amount'] * $fetch_cart['price']) + $ticket_price; ?>/-</span> </div>
            </div>
            <?php
                        $grand_total += $sub_total;
                    }
                }else{
                    echo '<p class="empty">Chưa có tour nào được thêm vào</p>';
                }
            ?>
        </div>

        <div style="margin-top: 2rem; text-align:center;">
            <a href="cart.php?delete_all" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Bạn có muốn xóa tất cả khỏi giỏ hàng');">Xóa tất cả</a>
        </div>

        <div class="cart-total">
            <p>Tổng đơn hàng : <span class="product-money"><?php echo $grand_total; ?></span></p>
            <div class="flex">
                <a href="shop.php" class="btn">Tiếp tục mua sắm</a>
                <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Thanh toán</a>
            </div>
        </div>

    </section>

    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>
</html>