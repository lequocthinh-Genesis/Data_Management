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
?>

<header class="header">
    <div class="flex">

        <img class="logo" src="./images/logo_fng_1.png" alt="">

        <nav class="navbar">
            <a href="admin_page.php">Quản lý</a>
            <a href="admin_products.php">Tour</a>
            <a href="admin_orders.php">Đơn hàng</a>
            <a href="admin_users.php">Quản lý tài khoản</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="account-box">
            <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
        </div>
    </div>
</header>