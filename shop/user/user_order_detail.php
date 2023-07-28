<?php
include_once '../../config/config.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:../dang_nhap.php');
}
if (isset($_POST['logout-btn'])) {
    session_destroy();
    header('location:../dang_nhap.php');
}
// click s
if (isset($_POST['submit_receive_order'])) {
    $id_orders = mysqli_real_escape_string($conn, $_POST['id_order']);

    $receive = $_POST['receive'];

    mysqli_query($conn, "UPDATE `order` SET payment_status='$receive' WHERE id = $id_orders");

    header('location:./user_order.php');
}


if (isset($_POST['submit_cancel_order'])) {
    $id_orders = mysqli_real_escape_string($conn, $_POST['id_order']);

    $cancel_order = $_POST['cancel_order'];

    mysqli_query($conn, "UPDATE `order` SET payment_status='$cancel_order' WHERE id = $id_orders") or die('query failed');

    header('location:./user_order.php');
}

if (isset($_POST['comback_order'])) {


    header('location:./user_order.php');
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
        text-align: center;
        width: 100%;
    }

    .banner .detail {
        position: absolute;
        padding: 7rem 0;
        top: 4%;
        left: 35%;
        text-align: center;
        z-index: 200;
    }
</style>

<body>
    <?php
    include './user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>ORDER</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, tenetur.</p>
            <a href="">home</a>/<span> order</span>
        </div>
    </div>
    <div class="line"></div>
    <!-- pay -->
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
    <div class="order-section">
        <h1 class="title">CHI TIẾT ĐẶT HÀNG</h1>


        <div class="row" style="margin-left:20rem">
            <div class="col-sm-8 col-md-7 col-md-offset-1">
                <table class="table table-hover" style="border:1px solid black;">
                    <thead style="margin:auto;text-align:center">
                        <tr>
                            <th>Stt</th>
                            <!-- <th class="text-center">HÌNH</th> -->
                            <th class="text-center">TÊN SẢN PHẨM</th>
                            <th class="text-center">SỐ LƯỢNG</th>
                            <!-- <th class="text-center">THANH TOÁN</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        $STT = 1;

                        if (isset($_GET['detail'])) {
                            $order_id_pay = $_GET['detail'];
                            $select_orders = mysqli_query($conn, "SELECT*FROM `order_pay` WHERE id_order= '$order_id_pay'") or die('query failed');
                            if (mysqli_num_rows($select_orders) > 0) {
                                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) { ?>
                                    <tr>
                                        <td class="col-sm-1 col-md-1">
                                            <?php echo $STT++ ?> </span>

                                        </td>
                                        <!-- 
                                            <td class="col-sm-1 col-md-1" style="text-align: center">
                                                <h4 class="media-heading"><img src="../hinh/<?php
                                                                                            // echo $fetch_orders['image_product']  
                                                                                            ?>" alt=""></h4>
                                            </td> -->


                                        <!-- <?php
                                                // $view_product = null;
                                                // $select_products = mysqli_query($conn, "SELECT * FROM `product`") or die('query failed');
                                                // while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                                                //     $view_product = $fetch_products['id'];
                                                //     $product_name = $fetch_products['name'];

                                                //     $product_url = "./user_view_page.php?pid=" .  $product_name;
                                                // }

                                                ?> -->

                                        <td class="col-sm-1 col-md-2 text-center">
                                            <!-- <a href="<?php echo    $product_url  ?>"><strong><?php echo $fetch_orders['name'] ?></strong></a> -->
                                            <strong><?php echo $fetch_orders['name'] ?></strong>
                                        </td>

                                        <td class="col-sm-1 col-md-1 text-center">
                                            <strong> <?php echo $fetch_orders['quantity'] ?></strong>
                                        </td>
                                    </tr>
                        <?php
                                }
                            } else {
                                echo '<p class="empty">no products added yet!</p>';
                            }
                        }
                        ?>

                        </tr>
                    </tbody>

                </table>
                <form method="post">


                    <?php
                    // $fetch_orders = null;
                    if (isset($_GET['detail'])) {
                        $order_id = $_GET['detail'];
                        $select_orders = mysqli_query($conn, "SELECT * FROM `order` WHERE id=$order_id") or die('query failed');

                        while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                            $order_ids = $fetch_orders['id'];?>

                            <input type="hidden" name="id_order" value="<?php echo $order_ids ?>">
                            <input type="hidden" name="receive" value="receive">
                            <input type="hidden" name="cancel_order" value="cancelorder">

                        <?php
                        if ($fetch_orders['payment_status'] == "complete") { ?>
                            <!-- đã nhận hàng -->
                            <input type="submit" value="Đã Nhận Hàng" name="submit_receive_order">
                            <a href="./user_order.php">
                                <input type="submit" value="Quay lại" name ='comback_order'>
                            </a>
                            <!-- hủy đơn hàng -->
                            <input type="submit" value="Hủy Đơn" name="submit_cancel_order">
                        <?php
                        } else if ($fetch_orders['payment_status'] =="receive" || $fetch_orders['payment_status'] == "cancelorder") {
                        ?>
                            <a href="./user_order.php">
                                <input type="submit" value="Quay lại" name ='comback_order'>
                            </a>
                    <?php
                        }     }
                    }
                    ?>
                   
                </form>
            </div>
        </div>
        <?php


        ?>
    </div>
    <div class="line"></div>
    <?php include '../user/user_footer.php'; ?>

    <!-- slick slider link -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>