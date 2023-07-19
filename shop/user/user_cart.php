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
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script> -->
    <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <link rel="stylesheet" href="../css/main.css">
    <title>Home page</title>
</head>
<style>
    sup {
        margin-top: 6.6rem;
        margin-left: -3rem;
    }

    .row {
        display: block;
        grid-template-columns: repeat(auto-fit, minmax(25rem, 1rem));
        justify-content: center;
        align-items: center;
    }

    header .user-box {
        margin-left: 94rem;
    }
</style>

<body>
    <?php
    include './user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>MY CART</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, tenetur.</p>
            <a href="">home</a>/<span> cart</span>
        </div>
    </div>
    <div class="line"></div>
    <!-- about us -->
    
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
    <div class="container">

        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grand_total = 0;
                        $select_cart = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                        if (mysqli_num_rows($select_cart) > 0) {
                            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) { ?>
                                <tr>
                                    <td class="col-sm-8 col-md-6">
                                        <div class="media">
                                            <a class="thumbnail pull-left" href="#"><img class="media-object" src="../hinh/<?php echo $fetch_cart['image'] ?>" style="width: 72px; height: 72px;"> </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="#"><?php echo $fetch_cart['name'] ?></a></h4>
                                                <!-- <h5 class="media-heading"> by <a href="#">Brand name</a></h5> -->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="col-sm-1 col-md-1" style="text-align: center">
                                        <form method="post">
                                            <input type="hidden" name="update_qty_id" value="<?php echo $fetch_cart['id']; ?>">
                                            <div class="qty">
                                                <input class="form-control" id="exampleInputEmail1" type="number" min="1" name="update_qty" value="<?php echo $fetch_cart['quantity']; ?>">
                                                <input type="submit" name="update_qty_btn" value="update">
                                            </div>
                                        </form>

                                    </td>
                                    <td class="col-sm-1 col-md-2 text-center"><strong ><?php echo $fetch_cart['price'] ?> đ</strong></td>
                                    <td class="col-sm-1 col-md-1 text-center"><strong> <?php echo $total_amt = ($fetch_cart['price'] * $fetch_cart['quantity']) ?> đ</strong></td>
                                    <td class="col-sm-1 col-md-1">
                                        <button type="button" class="btn btn-danger">
                                            <a style=" text-decoration: none;" class="glyphicon glyphicon-remove" href="user_cart.php?delete=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('do you want to delete?')"> Remove</a>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                                $grand_total += $total_amt;
                            }

                            ?>
                        <?php
                        } else {
                            echo '<p class="empty">no products added yet!</p>';
                        }
                        ?>

                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td>
                                <h3>Remove all</h3>
                            </td>
                            <td class="text-right">
                                <h3><strong><a style=" text-decoration: none;" href="user_cart.php?delete_all" class="btn2" onclick="return confirm('do you want to delete all item in your cart?')">Delete all</a></strong></h3>
                            </td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td>
                                <h3>Total</h3>
                            </td>
                            <td class="text-right">
                                <h3><strong><?php echo $grand_total; ?> đ</strong></h3>
                            </td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td>
                                <button type="button" class="btn btn-default">
                                    <a style=" text-decoration: none;" href="./user_shop.php"><span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping</a>
                                </button>
                            </td>
                            <td>
                                <a href="./checkout.php" class="btn" <?php echo ($grand_total > 1) ? '' : 'disabled' ?> onclick="return confirm('do you want to checkout to pay?')">procced to checkout</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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