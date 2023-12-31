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
//adding product in wishlist
if (isset($_POST['add_to_wishlist'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $wishlist_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name ='$product_name' AND user_id ='$user_id'") or die('query failed');
    $cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name ='$product_name' AND user_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($wishlist_number) > 0) {
        $message[] = 'product alreary in wishlist';
    } else if (mysqli_num_rows($cart_number) > 0) {
        $message[] = 'product alreary in cart';
    } else {
        mysqli_query($conn, "INSERT INTO `wishlist`( `user_id`, `pid`, `name`, `price`, `image`) VALUES ('$user_id','$product_id','$product_name','$product_price','$product_image')");
        $message[] = 'product successfuly added in your wishlist';
    }
}
//adding product in cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    $cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name ='$product_name' AND user_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_number) > 0) {
        $message[] = 'product alreary in cart';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`( `user_id`, `pid`, `name`, `price`, `quantity`,`image`) VALUES ('$user_id','$product_id','$product_name','$product_price','$product_quantity','$product_image')");
        $message[] = 'product successfuly added in your cart';
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

<body>
    <?php
    include './user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Chi tiết sản phẩm</h1>
            <p>Nơi hiển thị các thông tin về mặt hàng và giá cả chi tiết</p>
            <a href="">Trang chủ</a>/<span>Xem_trang</span>
        </div>
    </div>
    <div class="line"></div>
    <!-- about us -->
    <section class="view_page">
        <h1 class="title">SHOP BEST SELLERS</h1>
        <?php
        if (isset($message)) {
            foreach ($message as $message) {
                echo
                '
              <div class="message">
               <span>
                 ' . $message . '
               </span>
               <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
              </div>
            ';
            }
        }

        ?>
        <div class="box-container">
            <?php
            if (isset($_GET['pid'])) {
                $pid = $_GET['pid'];
                $select_products = mysqli_query($conn, "SELECT * FROM `product` WHERE id = '$pid'") or die('query failed');
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_products = mysqli_fetch_assoc($select_products)) {

            ?>
                        <form method="post">
                            <img src="../hinh/<?php echo $fetch_products['image'] ?>" alt="">
                            <div class="detail">
                                <div class="name"><?php echo $fetch_products['name'] ?></div>
                                <div class="price"><?php echo $fetch_products['price'] ?> đ</div>
                                <div class="detail"><?php echo $fetch_products['product_detail'] ?></div>
                                <input type="hidden" name="product_id" value="<?php echo $fetch_products['id'] ?>">
                                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'] ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price'] ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                                <div class="icon">
                                    <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                                    <input type="number" name="product_quantity" value="1" min="1" class="quantity">
                                    <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                                </div>
                            </div>

                        </form>
            <?php
                    }
                }
            }
            ?>

        </div>
    </section>
    <div class="line"></div>
    <?php include '../user/user_footer.php'; ?>
    <!-- slick slider link -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>