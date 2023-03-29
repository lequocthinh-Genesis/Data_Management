<?php
    include 'config.php';
    session_start();


    if(isset($_POST['submit'])){

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);

        $select_users = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass' ") or die('query failed');

        if(mysqli_num_rows($select_users) > 0){
            $row = mysqli_fetch_assoc($select_users);
            if($row['role'] == 'admin'){
                $_SESSION['admin_name'] = $row['username'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                header('location:admin_page.php');
            }
            else if($row['role'] == 'user'){
                $_SESSION['user_name'] = $row['username'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                header('location:index.php');
               
            }
        }
        else {
            $message[] = 'incorrect email or password!';
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom css file link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="form-container">
        <form action="" method="post">
            <h3>
                Đăng nhập
            </h3>
            <input type="email" name="email" placeholder="Nhập email của bạn" required class="box">
            <input type="password" name="password" placeholder="Nhập mật khẩu" required class="box">
            
            <input type="submit" name="submit" value="Đăng nhập" class="btn">
            <p>
                Bạn chưa có tài khoản ?
                <a href="register.php">
                    Đăng ký ngay
                </a>
            </p>
        </form>
    </div>

    <?php include 'footer.php'; ?>
    <!-- custom js file link  -->
    <script src="./js/script.js"></script>

</body>
</html>