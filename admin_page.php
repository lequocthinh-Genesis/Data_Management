<?php
    include 'config.php';
    session_start();
    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom admin css file link -->
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <?php
        include 'admin_header.php';
    ?>

    <!-- admin dashboard section starts  -->

    <section class="dashboard">

        <h1 class="title">Quản lý</h1>

        <div class="box-container">

            <div class="box">
                <p>
                    Đơn chưa xác nhận
                </p>
                <?php
                    $count = 0;
                    $select_pending = mysqli_query($conn, "SELECT count_orders_pending($count)") or die('query failed');
                    $fetch_pending = mysqli_fetch_assoc($select_pending);
                ?>
                <h3>
                    <?php 
                        echo $fetch_pending['count_orders_pending('.$count.')'];
                    ?>
                </h3>
                
            </div>

            <div class="box">
                <p>
                    Số tiền đã thanh toán
                </p>
                <?php

                    $total_completed = 0;
                    $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'đã xác nhận'") or die('query failed');
                    if(mysqli_num_rows($select_completed) > 0){
                        while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                            $total_price = $fetch_completed['total_price'];
                            $total_completed += $total_price;
                        };
                    };
                    
                ?>
                <h3 class="product-money">
                    <?php 
                        echo $total_completed; 
                    ?>
                </h3>
                
            </div>

            <div class="box">
                <p>
                    Số đơn hàng
                </p>
                <?php 
                    $select_orders = mysqli_query($conn, "SELECT count_orders($count)") or die('query failed');
                    $fetch_orders = mysqli_fetch_assoc($select_orders);
                ?>
                <h3>
                    <?php 
                        echo $fetch_orders['count_orders('.$count.')'];
                    ?>
                </h3>
                
            </div>

            <div class="box">
                <p>
                    Số Tour
                </p>
                <?php 
                    $select_tour = mysqli_query($conn, "SELECT count_product($count)") or die('query failed');
                    $fetch_tour = mysqli_fetch_assoc($select_tour);
                ?>
                <h3>
                    <?php 
                        echo $fetch_tour['count_product('.$count.')'];
                    ?>
                </h3>
                
            </div>

            <div class="box">
                <p>
                    Số user
                </p>
                <?php
                    $select_user = mysqli_query($conn, "SELECT count_user($count)") or die('query failed');
                    $fetch_user = mysqli_fetch_assoc($select_user);
                ?>
                <h3>
                    <?php
                        echo $fetch_user['count_user('.$count.')'];

                    ?>
                </h3>
                
            </div>

            <div class="box">
                <p>
                    Số admin
                </p>
                <?php 
                    $select_admin = mysqli_query($conn, "SELECT count_admin($count)") or die('query failed');
                    $fetch_admin = mysqli_fetch_assoc($select_admin);
                ?>
                <h3>
                    <?php
                        echo $fetch_admin['count_admin('.$count.')'];
                    ?>
                </h3>
                
            </div>

            <div class="box">
                <p>
                    Số tài khoản
                </p>
                <?php
                    $select_account = mysqli_query($conn, "SELECT count_account($count)") or die('query failed');
                    $fetch_account = mysqli_fetch_assoc($select_account);
                ?>
                <h3>
                    <?php
                        echo $fetch_account['count_account('.$count.')'];
                    ?>
                </h3>
                
            </div>

            <div class="box">
                <p>
                    Số vé
                </p>
                <?php
                    $select_ticket = mysqli_query($conn, "SELECT count_ticket($count)") or die('query failed');
                    $fetch_ticket = mysqli_fetch_assoc($select_ticket);
                ?>
                <h3>
                    <?php
                        echo $fetch_ticket['count_ticket('.$count.')'];
                    ?>
                </h3>
                
            </div>

        </div>

    </section>

    <!-- admin dashboard section ends -->
    <!-- Custom js file link -->
    <script src="js/admin_script.js"></script>
</body>
</html>