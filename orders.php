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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
    <?php include 'header.php'; ?>

    <section class="placed-orders">

        <h1 class="title">Đơn hàng</h1>

        <div class="box-container">

            <?php
                $stmt = $conn->prepare("CALL select_orders(?)");
                $stmt->bind_param('i', $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if( $result != NULL){
                
                    while($fetch_orders = $result->fetch_array(MYSQLI_BOTH)){
            ?>
            <div class="box">
                <p> Tên khách hàng : <span><?php echo $fetch_orders['name']; ?></span> </p>
                <p> Số điện thoại : <span><?php echo $fetch_orders['number']; ?></span> </p>
                <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                <p> Địa chỉ : <span><?php echo $fetch_orders['address']; ?></span> </p>
                <p> Tour đã đặt : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                <p> Giá tiền : <span class="product-money"><?php echo $fetch_orders['total_price']; ?></span> </p>
                <p> Phương thức thanh toán : <span><?php echo $fetch_orders['method']; ?></span> </p>
                <p> Trạng thái đơn hàng : <span><?php echo $fetch_orders['payment_status']; ?></span> </p>
                
            </div>
            <?php
                    }
                }else{
                    echo '<p class="empty">no orders placed yet!</p>';
                }
            ?>
        </div>

    </section>

    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>
</html>