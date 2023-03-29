<?php

    include 'config.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:login.php');
    }

    if(isset($_POST['update_order'])){

        $order_update_id = $_POST['order_id'];
        $update_payment = $_POST['update_payment'];
        mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
        $message[] = 'Cập nhật thành công';
     
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
    <?php include 'admin_header.php'; ?>


    <section class="orders">

        <h1 class="title">Danh sách đơn hàng</h1>

        <div class="box-container">
            <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                if(mysqli_num_rows($select_orders) > 0){
                    while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            ?>
            <div class="box">
                <p> user id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
                <p> Tên khách hàng : <span><?php echo $fetch_orders['name']; ?></span> </p>
                <p> Số điện thoại : <span><?php echo $fetch_orders['number']; ?></span> </p>
                <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                <p> Địa chỉ : <span><?php echo $fetch_orders['address']; ?></span> </p>
                <p> Số tour đã đặt : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                <p> Tổng giá trị : <span class="product-money"><?php echo $fetch_orders['total_price']; ?></span> </p>
                <p> Phương thức thanh toán : <span><?php echo $fetch_orders['method']; ?></span> </p>
                <form action="" method="post">
                    <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                    <select name="update_payment">
                        <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                        <option value="đang chờ xác nhận">Đang chờ xác nhận</option>
                        <option value="đã xác nhận">Đã xác nhận</option>
                    </select>
                    <input type="submit" value="Cập nhật" name="update_order" class="option-btn">
                </form>
            </div>
            <?php
                    }
                }else{
                    echo '<p class="empty">no orders placed yet!</p>';
                }
            ?>
        </div>

    </section>
    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>
</html>