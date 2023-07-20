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
        <?php
        $STT = 1 ;
        $select_orders = mysqli_query($conn, "SELECT * FROM `order` WHERE user_id ='$user_id'") or die('query failed');
        if (mysqli_num_rows($select_orders) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {

        ?>
                <div class="row" style="margin-left:20rem">
                    <div class="col-sm-8 col-md-7 col-md-offset-1">
                        <table class="table table-hover" style="border:1px solid black;">
                            <thead style="margin:auto;text-align:center">
                                <tr>
                                    <th>Stt</th>
                                    <th class="text-center">HÌNH</th>
                                    <th class="text-center">TÊN SẢN PHẨM</th>
                                    <th class="text-center">SỐ LƯỢNG</th>
                                    <!-- <th class="text-center">THANH TOÁN</th> -->

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $select_orders = mysqli_query($conn, "SELECT * FROM `order_pay`") or die('query failed');
                                if (mysqli_num_rows($select_orders) > 0) {
                                    while ($fetch_orders = mysqli_fetch_assoc($select_orders)) { ?>
                                        <tr>
                                            <td class="col-sm-1 col-md-1">
                                                <div class="media">
                                                    <span class="thumbnail pull-left" href="#"><?php $STT++?> </span>
                                                </div>
                                            </td>

                                            <td class="col-sm-1 col-md-1" style="text-align: center">
                                                <h4 class="media-heading"><img src="../hinh/<?php echo $fetch_orders['image_product']  ?>" alt=""></h4>
                                            </td>

                                            <td class="col-sm-1 col-md-2 text-center">
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
                                ?>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<p class="empty">no products added yet!</p>';
        }
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