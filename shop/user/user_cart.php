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
//updateing qty
if (isset($_POST['update_qty_btn'])) {
    $update_qty_id = $_POST['update_qty_id'];
    $update_value = $_POST['update_qty'];

    $update_query = mysqli_query($conn, "UPDATE `cart` SET `quantity` ='$update_value' WHERE id='$update_qty_id'") or die('query failed');
    if ($update_query) {
        header('location:user_cart.php');
    }
}
// delete product from cart
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id='$delete_id'") or die('query failed');

    header('location:user_cart.php');
}
// delete product all from wishlist
if (isset($_GET['delete_all'])) {
    $delete_id = $_GET['delete_all'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id='$user_id'") or die('query failed');

    header('location:user_cart.php');
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
            <h1>MY CART</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, tenetur.</p>
            <a href="">home</a>/<span>wishlist</span>
        </div>
    </div>
    <div class="line"></div>
    <!-- about us -->
    <section class="shop">
        <h1 class="title">products added in cart</h1>
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
            
            <div class="sanpham">
                <?php
                $grand_total = 0;
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                if (mysqli_num_rows($select_cart) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) { ?>
                        <div class="box">
                            <div class="icon">
                                <a href="./user_view_page.php?pid=<?php echo $fetch_cart['id']; ?>" class="bi bi-eye-fill"></a>
                                <a href="user_cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="bi bi-x" onclick="return confirm('do you want to delete?')"></a>
                                <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                            </div>
                            <div class="price">$<?php echo $fetch_cart['price'] ?></div>
                            <img src="../../hinh/<?php echo $fetch_cart['image'] ?>">
                            <div class="name"><?php echo $fetch_cart['name'] ?></div>
                            <form method="post" action="user_cart.php?action=submit">
                                <input type="hidden" name="update_qty_id" value="<?php echo $fetch_cart['id']; ?>">
                                <div class="qty">
                                    <input type="number" min="1" name="update_qty" value="<?php echo $fetch_cart['quantity']; ?>">
                                    <input type="submit" name="update_qty_btn" value="update">
                                </div>
                            </form>
                            <div class="total-amt">
                                Total Amuont: <span>
                                    <?php echo $total_amt = ($fetch_cart['price'] * $fetch_cart['quantity']) ?>
                                </span>
                            </div>
                        </div>
                    <?php
                        $grand_total += $total_amt;
                    }

                    ?>
                
            </div>
            <?php
                } else {
                    echo '<p class="empty">no products added yet!</p>';
                }
                ?>
        </div>
        
        <div class="dlt">
            <a href="user_cart.php?delete_all" class="btn2" onclick="return confirm('do you want to delete all item in your cart?')">Delete all</a>
        </div>
        <div class="wishlist_total">
            <p>total amount payable: <span>$<?php echo $grand_total; ?>/-</span> </p>
            <a href="./user_shop.php" class="btn">continue shopping</a>
            <a href="./checkout.php" class="btn" <?php echo ($grand_total > 1) ? '' : 'disabled' ?> onclick="return confirm('do you want to checkout to pay?')">procced to checkout</a>
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