<?php

    include 'config.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location:login.php');
    }

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "SELECT delete_user($delete_id) ") or die('query failed');
        header('location:admin_users.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
    <?php include 'admin_header.php'; ?>

    <section class="users">

        <h1 class="title"> Tài khoản người dùng </h1>

        <div class="box-container">
            <?php
                $select_users = mysqli_query($conn, "CALL select_user()") or die('query failed');
                while($fetch_users = mysqli_fetch_assoc($select_users)){
            ?>
            <div class="box">
                <img src="<?php echo $fetch_users['avatar_url']; ?>" alt="" class="avatar">
                <p> user id : <span><?php echo $fetch_users['id']; ?></span> </p>
                <p> name : <span><?php echo $fetch_users['username']; ?></span> </p>
                <p> email : <span><?php echo $fetch_users['email']; ?></span> </p>
                <p> user type : <span style="color:<?php if($fetch_users['role'] == 'admin'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['role']; ?></span> </p>
                <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Bạn có muốn xóa user này ?');" class="delete-btn">Xóa user</a>
            </div>
            <?php
                };
            ?>
        </div>

    </section>

    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>
</html>