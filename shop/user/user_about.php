<?php
include_once '../../config/config.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:../dang_nhap.php');
}
if (isset($_POST['logout-btn'])) {
    session_destroy();
    header('location:../../dang_nhap.php');
}
?>
<style type="text/css">
    <?php
    include '../css/main.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- slick slider link -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <!--  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Home page</title>
</head>

<body>
    <?php
    include './user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>VỀ CHÚNG TÔI</h1>
            <p>Đây là toàn bộ thông tin và định hướng của shop hiện tại và tương lai</p>
            <a href="index.php">Trang chủ</a>/<span>Về chúng tôi</span>
        </div>
    </div>
    <div class="line"></div>
    <!-- about ut -->
    <div class="about-ut">
        <div class="row">
            <div class="box">
                <div class="title">
                    <span>GIỚI THIỆU CÂU CHUYỆN TRỰC TUYẾN CỦA CHÚNG TÔI</span>
                    <h1>Mật ong nguyên chất và tự nhiên</h1>
                </div>
                <p>Mong muốn của chúng tôi không gì khác là được phục vụ những sản phẩm mật ong chất lượng nhất đến tay người tiêu dùng</p>
            </div>
            <div class="img-box">
                <img src="../hinh/doi_tac.jpg" alt="">
            </div>
        </div>
    </div>
    <div class="line"></div>
    <!-- about ut end -->
    <!-- features -->
    <div class="features">
        <div class="title">
            <h1>Hoàn thành ý tưởng của khách hàng</h1>
            <span>tính năng tốt nhất</span>
        </div>
        <div class="row">
            <div class="box">
                <img src="../hinh/icon.png" alt="">
                <h4>24 x 7</h4>
                <p>Online support 24/24</p>
            </div>
            <div class="box">
                <img src="../hinh/icon.png" alt="">
                <h4>24 x 7</h4>
                <p>Online support 24/24</p>
            </div>
            <div class="box">
                <img src="../hinh/icon.png" alt="">
                <h4>24 x 7</h4>
                <p>Online support 24/24</p>
            </div>
            <div class="box">
                <img src="../hinh/icon.png" alt="">
                <h4>24 x 7</h4>
                <p>Online support 24/24</p>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <!-- team section -->
    <div class="team">
        <div class="title">
            <h1>Đội ngũ khả thi của chúng tôi</h1>
            <span>đội tốt nhất</span>
        </div>
        <div class="row">
            <div class="box">
                <div class="img-box">
                    <img src="../hinh/profile3.jpg" alt="">
                </div>
                <div class="detail">
                    <span>Leader</span>
                    <h4>Nguyễn Hoàng Minh</h4>
                    <div class="social-link">
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-behance"></i>
                        <i class="bi bi-whatsapp"></i>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="../hinh/profile1.jpg" alt="">
                </div>
                <div class="detail">
                    <span>Member</span>
                    <h4>Phạm Minh Vương</h4>
                    <div class="social-link">
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-behance"></i>
                        <i class="bi bi-whatsapp"></i>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="../hinh/profile2.jpg" alt="">
                </div>
                <div class="detail">
                    <span>Member</span>
                    <h4>Phạm Duy Khang</h4>
                    <div class="social-link">
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-behance"></i>
                        <i class="bi bi-whatsapp"></i>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="../hinh/profile.jpg" alt="">
                </div>
                <div class="detail">
                    <span>Member</span>
                    <h4>Nguyễn Khánh Huy</h4>
                    <div class="social-link">
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-behance"></i>
                        <i class="bi bi-whatsapp"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="project">
        <div class="title">
            <h1>Dự án tốt nhất của chúng tôi</h1>
            <span>làm thế nào nó hoạt động</span>
            <div class="row">
                <div class="box">
                    <img src="../hinh/doi_tac_1.jpg" alt="">
                </div>
                <div class="box">
                    <img src="../hinh/doi_tac_2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="ideas">
        <div class="title">
            <h1>Câu chuyện về hành trình hình thành</h1>
            <span>Các tính năng của chúng tôi</span>
        </div>
        <div class="row">
            <div class="box">
                <i class="bi bi-stack"></i>
                <div class="detail">
                    <h2>Những gì chúng tôi thực sự làm</h2>
                    <p>Chúng tôi thực sự mong muốn mang đến nguồn mật ong chất lượng cho người tiêu dùng</p>
                </div>
            </div>
            <div class="box">
                <i class="bi bi-grid-1x2-fill"></i>
                <div class="detail">
                    <h2>Lịch sử bắt đầu</h2>
                    <p>Với tâm huyết đó, chúng tôi ấp ủ dự án và hôm nay đã thực hiện để mang lại nguồn mật ong ngon cho người tiêu dùng.</p>
                </div>
            </div>
            <div class="box">
                <i class="bi bi-tropical-storm"></i>
                <div class="detail">
                    <h2>Tầm nhìn của chúng tôi</h2>
                    <p>Trong tương lai chúng tôi mong muốn trở thành thương hiệu mang mật ong sạch đến tay người tiêu dùng</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <?php include '../user/user_footer.php'; ?>
    <!-- slick slider link -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>
</html>