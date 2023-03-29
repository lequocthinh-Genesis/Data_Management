<?php
    include 'config.php';
    if(isset($_POST['submit'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $image = $_POST['image'];
        $number = $_POST['number'];
        $address = $_POST['address'];

        $pass = mysqli_real_escape_string($conn, $_POST['password']);
        $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);

        $select_users = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass' ") or die('query failed');

        if(mysqli_num_rows($select_users) > 0){
            $message[] = 'Email đã đăng ký tài khoản';
        }
        else {
            if($pass != $cpass){
                $message[] = 'Mật khẩu nhập lại chưa chính xác';
            }
            else {
                mysqli_query($conn, "INSERT INTO `user`(username, email, password, role, avatar_url, phone, address) VALUES('$name','$email', '$cpass', 'user', '$image', '$number', '$address') ") or die('query failed');
                $message[] = 'Đăng ký thành công';
                header('location:login.php');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

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
                Đăng ký
            </h3>
            <input type="text" name="name" placeholder="Nhập tên của bạn" required class="box">
            <input type="email" name="email" placeholder="nhập địa chỉ email" required class="box">
            <input type="text" name="image" placeholder="Nhập url ảnh đại diện" required class="box">
            <input type="text" name="number" placeholder="Nhập số điện thoại" required class="box">
            <input type="text" name="address" placeholder="Nhập địa chỉ" required class="box">
            <input type="password" name="password" placeholder="Nhập mật khẩu" required class="box">
            <input type="password" name="cpassword" placeholder="Nhập lại mật khẩu" required class="box">
            <input type="submit" name="submit" value="Đăng ký ngay" class="btn">
            <p>
                bạn đã có tài khoản ?
                <a href="login.php">
                    đăng nhập ngay
                </a>
            </p>
        </form>
    </div>

    <?php include 'footer.php'; ?>
    <!-- custom js file link  -->
    <script src="./js/script.js"></script>

</body>
</html>