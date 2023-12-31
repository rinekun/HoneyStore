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
if (isset($_POST['submit-btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $select_massage = mysqli_query($conn, "SELECT * FROM `message` WHERE name ='$name' AND email ='$email' AND number='$number' AND message='$message'") or die('query failed');
    if (mysqli_num_rows($select_massage) > 0) {
        echo 'massage already send';
    } else {
        mysqli_query($conn, "INSERT INTO `message`( `user_id`, `name`, `email`, `number`, `message`) VALUES ('$user_id','$name','$email','$number','$message')") or die('query failed');
    }
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
    <title>Home page</title>
</head>
<style>

</style>

<body>
    <?php
    include './user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>LIÊN HỆ</h1>
            <p>Vui lòng liên hệ với chúng tôi nếu bạn có bất kỳ câu hỏi về các sản phẩm</p>
            <a href="">Trang chủ</a>/<span>Liên hệ</span>
        </div>
    </div>
    <!-- service -->
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
    <div class="form-container">
        <h1 class="title">leave a message</h1>
        <form method="post">
            <div class="input-field">
                <label for="">your name</label><br>
                <input type="text" name="name" id="">
            </div>
            <div class="input-field">
                <label>your email</label><br>
                <input type="text" name="email" id="">
            </div>
            <div class="input-field">
                <label for="">phone number</label><br>
                <input type="number" name="number" id="">
            </div>
            <div class="input-field">
                <label for="">your messag</label><br>
                <textarea name="message"></textarea>
            </div>
            <button type="submit" name="submit-btn">send message</button>
        </form>

    </div>
    <div class="line"></div>
    <div class="address">
        <h1 class="title">Liên hệ với chúng tôi</h1>
        <div class="row">
            <div class="box">
                <i class="bi bi-map-fill"></i>
                <div>
                    <h4>Địa chỉ</h4>
                    <p>To Ky,<br>street</p>
                </div>
            </div>
            <div class="box">
                <i class="bi bi-telephone-fill"></i>
                <div>
                    <h4>Số điện thoại</h4>
                    <p>090526447</p>
                </div>
            </div>
            <div class="box">
                <i class="bi bi-envelope-fill"></i>
                <div>
                    <h4>Email</h4>
                    <p>HoneyStore@gmail.com</p>
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