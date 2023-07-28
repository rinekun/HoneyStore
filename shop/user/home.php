<?php
include_once '../../config/config.php';
session_start();
if (isset($_POST['dangky'])) {
    header('location:../../dang_ki.php');
}
if (isset($_POST['dangnhap'])) {
    header('location:../../dang_nhap.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
   

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- slick slider link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <!--  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/main.css">
    <title>Trang chủ</title>
</head>


<body>
    <header class="header">
        <div class="flex">
            <a href="./index.php" class="logo">
                <img src="../hinh/logo.png" alt="" width="30%">
            </a>

<<<<<<< HEAD
            <nav class="navbar">
=======
            <nav class="navbar>
>>>>>>> refs/remotes/origin/main
                <a href="./index.php">Trang chủ</a>
                <a href="./user_shop.php">Shop</a>
                <a href="./user_about.php">Về chúng tôi</a>
                <a href="./user_order.php">Đơn thanh toán</a>
                <a href="./user_contact.php">Liên hệ</a>
            </nav>

            <div class="icons">
                <i class="bi bi-person" id="user-btn"></i>
                <a href=""><i class="bi bi-heart"></i></a>
                <a href=""><i class="bi bi-cart"></i></a>
                <i class="bi bi-list" id="menu-btn"></i>
            </div>
            <div class="user-box">

                <form method="post">
                    <button type="submit" class="logout-btn" name="dangky">
                        Đăng ký
                    </button>

                    <button type="submit" class="logout-btn" name="dangnhap">
                        Đăng nhập
                    </button>
                </form>
            </div>

        </div>

    </header>
    <!-- services -->
    <div class="services">
        <div class="row">
            <div class="box">
                <img src="../hinh/shipping.jpg" alt="">
                <div>
                    <h1>Free ship nhanh</h1>
                    <p>Miễn phí vận chuyển với đơn hàng nội thành Sài Gòn</p>
                </div>
            </div>
            <div class="box">
                <img src="../hinh/money.jpg" alt="">
                <div>
                    <h1>Đảm bảo hoàn lại tiền $</h1>
                    <p>Hoàn tiền nếu sản phẩm bị lỗi hoặc không đúng với sản phẩm đã giới thiệu</p>
                </div>
            </div>
            <div class="box">
                <img src="../hinh/online_support.jpg" alt="">
                <div>
                    <h1>Online hỗ trợ 24/24</h1>
                    <p>Luôn hỗ trợ 24/7 cho khách hàng</p>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- story -->
    <div class="story">
        <div class="row">
            <div class="box">
                <span>Câu chuyện chúng tôi</span>
                <h1>Sản xuất mật ong tự nhiên từ năm 2003</h1>
                <p>Mật ong thiên nhiên nguyên chất chứa nhiều dưỡng chất bồi bổ cho người tiêu dùng</p>
                <a href="" class="btn">SHOP NOW</a>
            </div>
            <div class="box">
                <img src="../hinh/0.png" alt="">
            </div>
        </div>
    </div>

    <!-- testimonial lời chứng thực -->
    <div class="testimonial-fluid">
        <h1 class="title">Thông tin về chúng tôi</h1>
        <div class="testimonial-slider">
            <div class="testimonial-item">
                <img src="../hinh/profile.jpg" alt="">
                <div class="testimonial-caption">
                    <span>Thành viên</span>
                    <h1>Organic Premium Honey</h1>
                    <p>Quản lý chuỗi cung ứng và bảo quản sản phẩm</p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="../hinh/profile1.jpg" alt="">
                <div class="testimonial-caption">
                    <span>Thành viên</span>
                    <h1>Organic Premium Honey</h1>
                    <p>Chăm sóc khách hàng và quản lý đơn hàng đến tay người tiêu dùng</p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="../hinh/profile2.jpg" alt="">
                <div class="testimonial-caption">
                    <span>Thành viên</span>
                    <h1>Organic Premium Honey</h1>
                    <p>Quản trị website và bảo trì hệ thống</p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="../hinh/profile3.jpg" alt="">
                <div class="testimonial-caption">
                    <span>Nhóm trưởng</span>
                    <h1>Organic Premium Honey</h1>
                    <p>Leader quản lý và điều hành chuỗi sản phẩm từ nhà sản xuất</p>
                </div>
            </div>
        </div>
        <div class="controls">
            <i class="bi bi-chevron-left prev1"></i>
            <i class="bi bi-chevron-right next1"></i>
        </div>
    </div>
    <?php include './user_homeshop.php'; ?>
    <div class="newslatter">
        <h1 class="title">Tham gia bản tin của chúng tôi</h1>
        <p>Vui lòng liên hệ với chúng tôi nếu bạn có thắc mắc về các vấn đề bạn gặp phải với sản phẩm</p>
        <div class="thongtin">
            <input type="text" name="" placeholder="your email address...">
            <button>Theo dõi ngay</button>
        </div>
    </div>
   
    <div class="client">
        <div class="box">
            <img src="../hinh/client1.png" alt="">
        </div>
        <div class="box">
            <img src="../hinh/client2.png" alt="">
        </div>
        <div class="box">
            <img src="../hinh/client1.png" alt="">
        </div>
        <div class="box">
            <img src="../hinh/client1.png" alt="">
        </div>
        <div class="box">
            <img src="../hinh/client2.png" alt="">
        </div>
    </div>
    <?php include './user_footer.php';
    ?>
    <!-- slick slider link -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="../js/script2.js"></script>
</body>

</html>