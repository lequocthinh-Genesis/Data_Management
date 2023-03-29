<?php
    if(isset($message)){
        foreach($message as $message){
            echo '
                <div class="message">
                    <span>
                        '.$message.'
                    </span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
            ';
        }
    }

    $user_id = "guest";
    if(isset($_SESSION['user_id'])){
        
        $user_id = $_SESSION['user_id'];
    }
?>

<header>

    <div id="menu-bar" class="fas fa-bars"></div>
    <img class="logo" src="./images/logo_fng_1.png" alt="">
    <nav class="navbar">
        <a href="index.php">Trang chủ</a>
        <a href="shop.php">Tour</a>
        <a href="about.php">Về chúng tôi</a>
        <!-- <a href="contact.php">Liên hệ</a> -->
        <a href="orders.php">đơn hàng</a>
    </nav>

    <div class="icons">
        <a href="shop.php">
            <i class="fas fa-search" id="search-btn"></i>
        </a>
        <span>
            <i class="fas fa-user" id="user-btn"></i>
        </span>
        <?php
            $cart_rows_number = 0;
            if($user_id != "guest") {
                $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_rows_number = mysqli_num_rows($select_cart_number); 
            }
        ?>
        <a class="cart" href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
    </div>


    <?php
        if($user_id != "guest") {
            

    ?>
    <div class="user-box">
        <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
        <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
        <a href="logout.php" class="btn">Đăng xuất</a>
    </div>
    
    <?php
        }
        else {

    ?>
    <div class="user-box">
        <a href="register.php" class="btn">Đăng ký</a>
        <a href="login.php" class="btn">Đăng nhập</a>
    </div>

    <?php
        }

    ?>

</header>