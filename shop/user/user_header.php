<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<style>

</style>

<body>
    <header class="header">
        <div class="flex">
            <a href="./index.php" class="logo">
                <img src="../hinh/logo.png" alt="" width="30%">
            </a>

            <nav class="navbar">
            <a href="./index.php">Trang chủ</a>
            <a href="./user_shop.php">Shop</a>
            <a href="./user_about.php">Về chúng tôi</a>
            <a href="./user_order.php">Đơn thanh toán</a>
            <a href="./user_contact.php">Liên hệ</a>
            </nav>

            <div class="icons">
                <i class="bi bi-person" id="user-btn"></i>
                <?php
                $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist);
                ?>
                <a href="./user_wishlist.php"><i class="bi bi-heart"></i><sup><?php echo $wishlist_num_rows ?></sup> </a>
                <?php
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart);
                ?>
                <a href="./user_cart.php"><i class="bi bi-cart"></i><sup><?php echo $cart_num_rows ?></sup></a>
                <i class="bi bi-list" id="menu-btn"></i>
            </div>

            <div class="user-box">
                <p>Username : <span> <?php echo $_SESSION['user_name']; ?></span></p>
                <p>Email : <span> <?php echo $_SESSION['user_email']; ?></span></p>
                <form method="post">
                    <button type="submit" class="logout-btn" name="logout-btn">
                        logout
                    </button>
                </form>
            </div>
        </div>

    </header>


</body>

</html>