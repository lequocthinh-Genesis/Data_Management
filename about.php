<?php

    include 'config.php';

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        header .navbar a:nth-child(3) {
            color:var(--orange);
        }
    </style>

</head>
<body>
   
    <?php include 'header.php'; ?>

    <section class="about">

        <div class="flex">

            <div class="image">
                <img src="./images/cty.jpg" alt="">
            </div>

            <div class="content">
                <h3>
                    Về chúng tôi
                </h3>
                <p>
                    FNG là tổ chức sáng lập ra bởi Lê Quốc Thịnh vào năm 2014, trãi qua nhiều khó khăn công ty đã dần hoàn thiện bộ máy tổ chức và bươc đầu tạo được chổ đứng cũng như thương hiệu trong thị trường du lịch trong nước việt nam và trên thế giới.
                </p>
                <p>
                    Nếu bạn có gặp vấn đề khó khăn hay muốn tìm hiểu về cách thức hoạt động, chất lượng dịch vụ,... của chúng tôi thì bạn có thể liên hệ trực tiếp qua email ngay tại đây   
                </p>
                <a href="contact.php" class="btn">
                    Liên Hệ
                </a>
            </div>

        </div>

    </section>

    <section class="reviews">
        <h1 class="heading">
            <span>n</span>
            <span>h</span>
            <span>â</span>
            <span>n</span>
            <span>v</span>
            <span>i</span>
            <span>ê</span>
            <span>n</span>

        </h1>

        <div class="box-container">

            <div class="box">
                <img src="images/pic-1.png" alt="">
                <p>
                    Hướng dẫn viên
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>
                    Justin
                </h3>
            </div>

            <div class="box">
                <img src="images/pic-2.png" alt="">
                <p>
                    Thư ký
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>
                    Asuna
                </h3>
            </div>

            <div class="box">
                <img src="images/pic-3.png" alt="">
                <p>
                    Hướng dẫn viên
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>
                    Joyce
                </h3>
            </div>

            <div class="box">
                <img src="images/pic-4.png" alt="">
                <p>
                    Nhân viên tư vấn
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>
                    Keisha
                </h3>
            </div>

            <div class="box">
                <img src="images/pic-5.png" alt="">
                <p>
                    Hướng dẫn viên
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>
                    rick
                </h3>
            </div>

            <div class="box">
                <img src="images/pic-6.png" alt="">
                <p>
                    Kế toán
                </p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>
                    Elysia
                </h3>
            </div>

        </div>

    </section>  

    <section class="authors">

        <h1 class="heading">
            <span>q</span>
            <span>u</span>
            <span>ả</span>
            <span>n</span>
            <span>t</span>
            <span>r</span>
            <span>ị</span>

        </h1>

        <div class="box-container">

            <div class="box">
                <img src="./images/author-1.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>
                    Genesis
                </h3>
            </div>

            <div class="box">
                <img src="images/author-2.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>
                    Quốc Thịnh
                </h3>
            </div>

            <div class="box">
                <img src="images/author-3.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Lucifer</h3>
            </div>

            <div class="box">
                <img src="images/author-4.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Egnaro</h3>
            </div>

            <div class="box">
                <img src="images/author-5.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Nguyễn Nam</h3>
            </div>

            <div class="box">
                <img src="images/author-6.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Anh Nam</h3>
            </div>

        </div>

    </section>


    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>
</html>