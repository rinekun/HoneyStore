<?php
include_once '../config/config.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:./dang_nhap.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:./dang_nhap.php');
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
            <h1>ORDER</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, tenetur.</p>
            <a href="">home</a>/<span>order</span>
        </div>
    </div>
    <!-- pay -->
    <div class="order-section">
        <div class="box-container">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `order` WHERE user_id ='$user_id'") or die('query failed');
            if (mysqli_num_rows($select_orders) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {

            ?>
                    <div class="box">
                        <p>planced on: <span><?php echo $fetch_orders['place_on']; ?></span> </p>
                        <p>name: <span><?php echo $fetch_orders['name']; ?></span> </p>
                        <p>number: <span><?php echo $fetch_orders['number']; ?></span> </p>
                        <p>email: <span><?php echo $fetch_orders['email']; ?></span> </p>
                        <p>address: <span><?php echo $fetch_orders['address']; ?></span> </p>
                        <p>payment method: <span><?php echo $fetch_orders['method']; ?></span> </p>
                        <p>your order: <span><?php echo $fetch_orders['total_product']; ?></span> </p>
                        <p>total price: <span><?php echo $fetch_orders['total_price']; ?></span> </p>
                        <p>payment ststus: <span><?php echo $fetch_orders['payment_status']; ?></span> </p>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
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