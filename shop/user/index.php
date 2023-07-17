

<?php
include_once '../config/config.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:../dang_nhap.php');
}
if (isset($_POST['logout-btn'])) {
    session_destroy();
    header('location:../dang_nhap.php');
}
//adding product in wishlist
if(isset($_POST['add_to_wishlist'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

$wishlist_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name ='$product_name' AND user_id ='$user_id'") or die('query failed');
$cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name ='$product_name' AND user_id ='$user_id'") or die('query failed');
if(mysqli_num_rows($wishlist_number)>0){
    $message[] = 'product alreary in wishlist';
}else if(mysqli_num_rows($cart_number)>0){
    $message[] = 'product alreary in cart';
}else{
    mysqli_query($conn,"INSERT INTO `wishlist`( `user_id`, `pid`, `name`, `price`, `image`) VALUES ('$user_id','$product_id','$product_name','$product_price','$product_image')");
    $message[] = 'product successfuly added in your wishlist';
}
}
//adding product in cart
if(isset($_POST['add_to_cart'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
$cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name ='$product_name' AND user_id ='$user_id'") or die('query failed');
if(mysqli_num_rows($cart_number)>0){
    $message[] = 'product alreary in cart';
}else{
    mysqli_query($conn,"INSERT INTO `cart`( `user_id`, `pid`, `name`, `price`, `quantity`,`image`) VALUES ('$user_id','$product_id','$product_name','$product_price','$product_quantity','$product_image')");
    $message[] = 'product successfuly added in your cart';
}
}

?>
<style type="text/css">
    <?php
    // include './shop/';
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
    <link rel="stylesheet" href="../css/main.css">
    <title>Home page</title>
</head>

<body>
    <?php
    include './user_header.php'; ?>
    <!--home slider -->
    <div class="container-fluid">
        <div class="hero-slider">
            <!-- <div class="slider-item">
                <img src="../hinh/banner1.jpg" alt="">
                <div class="slider-caption">
                    <span>Test The Quality</span>
                    <h1>Onbfrnfb <br>Honey </h1>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicin <br> xbvcgdvcgv</p>
                    <a href="./user_shop.php" class="btn">shop now</a>
                </div>
            </div> -->
            <div class="slider-item">
                <img src="../hinh/banner3.jpg" alt="">
            </div>
        </div>
        <div class="controls">
            <i class="bi bi-chevron-left prev"></i>
            <i class="bi bi-chevron-right next"></i>
        </div>
    </div>
    <div class="services">
        <div class="row">
            <div class="box">
                <img src="../hinh/shipping.jpg" alt="">
                <div>
                    <h1>Free Shipping Fast</h1>
                    <p>Free shipping with orders within Saigon city</p>
                </div>
            </div>
            <div class="box">
                <img src="../hinh/money.jpg" alt="">
                <div>
                    <h1>Money Back $ Guarantee</h1>
                    <p>Refund if the product is defective or does not match the product introduced</p>
                </div>
            </div>
            <div class="box">
                <img src="../hinh/online_support.jpg" alt="">
                <div>
                    <h1>Online Support 24/24</h1>
                    <p>Always support 24/7 for customers</p>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="line2"></div> -->
    <div class="story">
        <div class="row">
            <div class="box">
                <span>our story</span>
                <h1>Production of natural honey since 2003</h1>
                <p>Pure natural honey contains many nutrients to nourish consumers</p>
                <a href="shop.php" class="btn">shop now</a>
            </div>
            <div class="box">
                <img src="../hinh/0.png" alt="">
            </div>
        </div>
    </div>
    <!-- <div class="line2"></div> -->
    <!-- testimonial lời chứng thực -->
    <div class="line3"></div>
    <div class="testimonial-fluid">
        <h1 class="title">What Our Customes Say's</h1>
        <div class="testimonial-slider">
            <div class="testimonial-item">
                <img src="../hinh/profile.jpg" alt="">
                <div class="testimonial-caption">
                    <span>Member</span>
                    <h1>Organic Premium Honey</h1>
                    <p>Supply chain management and product preservation</p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="../hinh/profile1.jpg" alt="">
                <div class="testimonial-caption">
                    <span>Member</span>
                    <h1>Organic Premium Honey</h1>
                    <p>Taking care of customers and managing orders to consumers</p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="../hinh/profile2.jpg" alt="">
                <div class="testimonial-caption">
                    <span>Member</span>
                    <h1>Organic Premium Honey</h1>
                    <p>Website administration and system maintenance</p>
                </div>
            </div>
            <div class="testimonial-item">
                <img src="../hinh/profile3.jpg" alt="">
                <div class="testimonial-caption">
                    <span>Leader</span>
                    <h1>Organic Premium Honey</h1>
                    <p>Leader manages and operates the product chain from the producer</p>
                </div>
            </div>
        </div>
        <div class="controls">
            <i class="bi bi-chevron-left prev1"></i>
            <i class="bi bi-chevron-right next1"></i>
        </div>
    </div>
    <?php include './user_homeshop.php'; ?>
    <div class="line2"></div>
    <div class="newslatter">
        <h1 class="title">Join Our to Newsletter</h1>
        <p>Please contact us if you have questions about the problems you have with the product</p>
        <input type="text" name="" placeholder="your email address...">
        <button>subscribe now</button>
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