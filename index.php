<?php
    include 'config.php';
    session_start();

    $user_id = "guest";
    if(isset($_SESSION['user_id'])){
        
        $user_id = $_SESSION['user_id'];
    }

    if(isset($_POST['add_to_cart'])){

        $product_id = (int)$_POST['product_id'];
        $product_price = (int)$_POST['product_price'];
        $product_quantity = (int)$_POST['product_quantity'];
        $ticket = $_POST['ticket'];

        // select ticket
        $select_ticket = mysqli_query($conn, "SELECT * FROM `ticket` WHERE expiry = '$ticket' ") or die('query failed');

        $fetch_ticket = mysqli_fetch_assoc($select_ticket);

        $ticket_id = (int)$fetch_ticket['id'];
     
        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE tour_id = '$product_id' AND user_id = '$user_id'") or die('query failed');
        
        if(mysqli_num_rows($check_cart_numbers) > 0){
            $message[] = 'Sản phẩm đã tồn tại trong giỏ hàng ';
        }else{
            mysqli_query($conn, "SELECT add_product_cart($product_id, $ticket_id, $user_id, $product_price, $product_quantity) ") or die('query failed');

            $message[] = 'Thêm vào giỏ hàng thành công';
        }
     
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="./css/style.css">

    <style>
        header .navbar a:nth-child(1) {
            color:var(--orange);
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Home -->

    <section class="home" id="home">

        <div class="content">
            <h3>
                Hướng đến trãi nghiệm tuyệt vời nhất
            </h3>
            <p>
                Hãy cùng chúng tôi bắt đầu chuyến hành trình ngay nào
            </p>
            <a href="#" class="btn">Đăng ký ngay</a>
        </div>

        <div class="controls">
            <span class="vid-btn active" data-src="images/vid-1.mp4"></span>
            <span class="vid-btn" data-src="images/vid-2.mp4"></span>
            <span class="vid-btn" data-src="images/vid-3.mp4"></span>
            <span class="vid-btn" data-src="images/vid-4.mp4"></span>
            <span class="vid-btn" data-src="images/vid-5.mp4"></span>
        </div>

        <div class="video-container">
            <video src="images/vid-1.mp4" id="video-slider" loop autoplay muted></video>
        </div>

    </section>

    <!-- Tour -->

    <section class="packages" id="packages">

        <h1 class="heading">
            <span>t</span>
            <span>o</span>
            <span>u</span>
            <span>r</span>
        </h1>

        <div class="box-container">
            <?php
                $select_products = mysqli_query($conn, "CALL select_product_home()") or die('query failed');
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form action="" method="post" class="box">
                <img class="image" src="<?php echo $fetch_products['image_url']; ?>" alt="">
                <div class="content">
                    <h3> <i class="fas fa-map-marker-alt"></i> <?php echo $fetch_products['name']; ?> </h3>

                    <p class="description"><?php echo $fetch_products['description']; ?></p>

                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    
                    <div class="price product-money"><?php echo $fetch_products['price']; ?> </div>

                    <select name="ticket" class="ticket">
                        <option value="7" selected>Loại vé 7 ngày 70.000 đ</option>
                        <option value="10">Loại vé 10 ngày 100.000 đ</option>
                        <option value="14">Loại vé 14 ngày 140.000 đ</option>
                    </select>

                    <input type="number" name="product_quantity" value="1" min="0" class="qty">

                    
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">

                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image_url']; ?>">

                    <?php
                        if($user_id == "guest"){  
                    ?>

                        
                    <a href="login.php" class="btn" onclick="return confirm('Bạn cần đăng nhập để thực hiện chức năng này. Bạn có muốn đăng nhập ngay ?');">
                        Thêm vào giỏ hàng
                    </a>

                    <?php
                        }
                        else{
                    ?>

                    <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">

        
                    <?php
                        }
                    ?>
                </div>
            </form>
            <?php
                    }
                }else{
                    echo '<p class="empty">no products added yet!</p>';
                }
            ?>
        </div>
        <div class="load-more" style="margin-top: 2rem; text-align:center">
            <a href="shop.php" class="btn">Xem Thêm</a>
        </div>
    </section>

    <!-- Dịch vụ -->

    <section class="services" id="services">

        <h1 class="heading">
            <span>d</span>
            <span>ị</span>
            <span>c</span>
            <span>h</span>
            <span>v</span>
            <span>ụ</span>
        </h1>

        <div class="box-container">

            <div class="box">
                <i class="fas fa-hotel"></i>
                <h3>
                    Khách sạn giá cả phải chăng
                </h3>
                <p>
                    Dịch vụ của chúng tôi đảm bảo rằng quý khách sẽ được nghỉ ngơi trong một khách sạn với giá cả hợp lý giúp cho quý khách có một trãi nghiệm thật tuyệt vời
                </p>
            </div>
            <div class="box">
                <i class="fas fa-utensils"></i>
                <h3>
                    Thức ăn và đồ uống
                </h3>
                <p>
                    Chất lượng dịch vụ ăn uống là mức phù hợp của sản phẩm dịch vụ ăn uống thoả mãn các yêu cầu đề ra hoặc định trước của thực khách. Chất lượng dịch vụ ăn uống là sự thoả mãn của khách hàng được xác định giữa chất lượng cảm nhận và chất lượng mong đợi.
                </p>
            </div>
            <div class="box">
                <i class="fas fa-bullhorn"></i>
                <h3>
                    Hướng dẫn an toàn
                </h3>
                <p>
                    Đảm bảo an toàn cho khách du lịch, khách sử dụng dịch vụ du lịch, cán bộ, hướng dẫn viên, nhân viên của các doanh nghiệp lữ hành, khu, điểm, cơ sở lưu trú du lịch và kinh doanh dịch vụ du lịch và người đến liên hệ, làm việc; người cung ứng vật tư, hàng hóa, dịch vụ cho cơ sở kinh doanh dịch vụ du lịch
                </p>
            </div>
            <div class="box">
                <i class="fas fa-globe-asia"></i>
                <h3>
                    Vòng quanh thế giới
                </h3>
                <p>
                    Hành trình sẽ bắt đầu tại Los Angeles, Mỹ, sau đó đi về hướng tây đến các điểm dừng như Hawaii, New Zealand, Australia, Nhật Bản, Việt Nam, Ấn Độ, Oman, Hy Lạp, Pháp và Iceland trước khi kết thúc ở New York, Mỹ.
                </p>
            </div>
            <div class="box">
                <i class="fas fa-plane"></i>
                <h3>
                    Du lịch nhanh nhất
                </h3>
                <p>
                    Chuyến hành trình trình sẽ bao gồm 24 kỳ nghỉ qua đêm tại các quốc gia như Myanmar, Singapore, Thái Lan và Indonesia,... nếu quý khách muốn đến bất cứ đâu chúng tôi sẽ hỗ trợ với tốc độ nhanh nhất
                </p>
            </div>
            <div class="box">
                <i class="fas fa-hiking"></i>
                <h3>
                    Cuộc phiêu lưu hấp dẫn
                </h3>
                <p>
                    Một sớm mai thức dậy, nhìn thấy những tia nắng đầu tiên vỗ về bãi cát trải dài lấp lánh, lắng nghe tiếng sóng biển rì rào, nghe được cả tiếng gió thổi qua tai và cảm nhận được cả hơi thở của biển cả, hơi mát rười rượi phả vào mặt giữa cái oi bức của ngày hè tháng 5, tháng 6..., được tận mắt thấy một cuộc sống đầy sắc màu và sống động hiện ra trước mắt, một vùng đất mới với những trải nghiệm đầy hứa hẹn sẽ thú vị và tuyệt vời
                </p>
            </div>

        </div>

    </section>

    <!-- Về chúng tôi -->

    <section class="about_home">

        <div class="flex">

            <div class="image">
                <img src="./images/cty.jpg"" alt="">
            </div>

            <div class="content">
                <h3>
                    Về chúng tôi
                </h3>
                <p>
                    FNG là tổ chức sáng lập ra bởi Lê Quốc Thịnh vào năm 2014, trãi qua nhiều khó khăn công ty đã dần hoàn thiện bộ máy tổ chức và bươc đầu tạo được chổ đứng cũng như thương hiệu trong thị trường du lịch trong nước việt nam và trên thế giới.
                </p>
                <a href="about.php" class="btn">Xem Thêm</a>
            </div>

        </div>

    </section>


    <!-- Liên hệ -->

    <section class="contact_home" id="contact">
    
        <h1 class="heading">
            <span>l</span>
            <span>i</span>
            <span>ê</span>
            <span>n</span>
            <span>h</span>
            <span>ệ</span>
        </h1>

        <div class="row">

            <div class="image">
                <img src="./images/Reading book-pana.png" alt="">
            </div>
            
            <div class="question">
                <h3>
                    Hãy liên hệ với chúng tôi
                </h3>
                <p>
                    Công ty của chúng tôi luôn luôn sẵn sàng lắng nghe các ý kiến của khách hàng về các dịch vụ của chúng tôi, nếu bạn có gặp vấn đề khó khăn hay muốn tìm hiểu về cách thức hoạt động, chất lượng dịch vụ,... của chúng tôi thì bạn có thể liên hệ trực tiếp qua email ngay tại đây
                </p>

                <a href="#" class="btn">
                    Liên Hệ
                </a>

            </div>

        </div>
    
    </section>

    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="./js/script.js"></script>
</body>
</html>