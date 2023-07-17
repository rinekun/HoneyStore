<style>
    
</style>
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
    $product_quantity = 1;
    $cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name ='$product_name' AND user_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_number) > 0) {
        $message[] = 'product alreary in cart';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`( `user_id`, `pid`, `name`, `price`, `quantity`,`image`) VALUES ('$user_id','$product_id','$product_name','$product_price','$product_quantity','$product_image')");
        $message[] = 'product successfuly added in your cart';
    }
}
// delete product from wishlist
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE id='$delete_id'") or die('query failed');

    header('location:user_wishlist.php');
}
// delete product all from wishlist
if (isset($_GET['delete_all'])) {
    $delete_id = $_GET['delete_all'];
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE user_id='$user_id'") or die('query failed');
    header('location:user_wishlist.php');
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
            <h1>MY WISHLIST</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, tenetur.</p>
            <a href="">home</a>/<span>wishlist</span>
        </div>
    </div>
    <div class="line"></div>
    <!-- about us -->
    <section class="shop"> 
        <h1 class="title">products added in wishlist</h1>
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
            $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist`") or die('query failed');
            if (mysqli_num_rows($select_wishlist) > 0) {
                while ($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)) { ?>
                    <form method="post" class="box">
                        <div class="price">$<?php echo $fetch_wishlist['price'] ?></div>
                        <img src="../hinh/<?php echo $fetch_wishlist['image'] ?>" alt="">
                        <div class="name"><?php echo $fetch_wishlist['name'] ?></div>
                        <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['id'] ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['name'] ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['price'] ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['image']; ?>">
                        <div class="icon">
                            <a href="./user_view_page.php?pid=<?php echo $fetch_wishlist['id']; ?>" class="bi bi-eye-fill"></a>
                            <a href="user_wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" class="bi bi-x" onclick="return confirm('do you want to delete?')"></a>
                            <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                        </div>
                    </form>
            <?php
                    $grand_total += $fetch_wishlist['price'];
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
           </div>
        </div>
        <div class="wishlist_total">
            <p>total amount payable: <span>$<?php echo $grand_total; ?>/-</span> </p>
            <a href="./user_shop.php" class="btn">continue shopping</a>
            <a href="./user_wishlist.php?delete_all=<?php echo ($grand_total) ? '' : 'disabled' ?> onclick=" return confirm('do you want to delete all product?')">delete all</a>
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