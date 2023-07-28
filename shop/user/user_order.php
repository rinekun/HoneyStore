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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <title>Home page</title>
</head>


<body>
    <?php
    include './user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>ĐƠN THANH TOÁN</h1>
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
        <h1 class="title">SHOP ORDER</h1>
        <div class="" style="padding: 0 10%;">
            <!-- <div class="col-sm-8 col-md-7 col-md-offset-1"> -->
            <div class="col-xl-10 col-lg-10 col-md-12 col-12">
                <table class="table table-hover" style="border:1px solid black;">
                    <thead style="margin:auto;text-align:center">
                        <tr>
                            <th>Stt</th>
                            <th class="text-center">NGƯỜI NHẬN</th>
                            <th class="text-center">SỐ ĐIỆN THOẠI</th>
                            <th class="text-center">TRẠNG THÁI</th>
                            <th class="text-center">GIÁ TIỀN</th>
                            <th class="text-center">ĐÃ MUA</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt = 1;
                        $select_orders = null;
                        $select_order_pay = mysqli_query($conn, "SELECT * FROM `order_pay`") or die('query failed');

                        while ($select_order_pays = mysqli_fetch_assoc($select_order_pay)) {
                            $order_id = $select_order_pays['id_order'];

                            $select_orders = mysqli_query($conn, "SELECT * FROM `order` WHERE `id` = $order_id");
                        }
                        $select_orders = mysqli_query($conn, "SELECT * FROM `order` ");
                        if (mysqli_num_rows($select_orders) > 0) {
                            while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {

                        ?>


                                <tr>
                                    <td class="col-sm-1 col-md-1">

                                        <?php echo $stt++; ?>

                                    </td>

                                    <td class="col-sm-1 col-md-1" style="text-align: center">
                                        <h4 class="media-heading"><?php echo $fetch_orders['name'] ?></h4>
                                    </td>

                                    <td class="col-sm-1 col-md-2 text-center">
                                        <strong><?php echo $fetch_orders['number'] ?></strong>
                                    </td>

                                    <td class="col-sm-1 col-md-1 text-center">
                                        <?php
                                        $pending = 'Chưa Giải Quyết';
                                        if ($fetch_orders['payment_status'] === 'complete') {
                                            $complete = 'Vận chuyển';
                                        ?>
                                            <strong> <?php echo  $complete ?></strong>
                                        <?php } else if ($fetch_orders['payment_status'] === 'receive') {
                                            $complete = 'Đã Nhận Hàng';
                                        ?>
                                            <strong> <?php echo '<p style="color:blue;">' . $complete . '</p>' ?></strong>
                                        <?php } else if ($fetch_orders['payment_status'] === 'cancelorder') {
                                            $complete = 'Đơn Bị Hủy';
                                        ?>
                                            <strong> <?php echo '<p style="color:red;">' . $complete . '</p>' ?></strong>
                                        <?php } else { ?>
                                            <strong> <?php echo   $pending ?></strong>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="col-sm-1 col-md-1 text-center">
                                        <strong> <?php echo $fetch_orders['total_price'] ?></strong>
                                    </td>
                                    <td class="col-sm-1 col-md-1">
                                        <a href="./user_order_detail.php?detail=<?php echo $fetch_orders['id'] ?>">Xem Chi Tiết</a>
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






<!-- 
                <style>
                    .container-table100 {
                        width: 100%;
                        min-height: 100vh;
                        background: #c850c0;
                        background: -webkit-linear-gradient(45deg, #4158d0, #c850c0);
                        background: -o-linear-gradient(45deg, #4158d0, #c850c0);
                        background: -moz-linear-gradient(45deg, #4158d0, #c850c0);
                        background: linear-gradient(45deg, #4158d0, #c850c0);
                        display: -webkit-box;
                        display: -webkit-flex;
                        display: -moz-box;
                        display: -ms-flexbox;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-wrap: wrap;
                        padding: 33px 30px
                    }

                    .wrap-table100 {
                        width: 1170px
                    }

                    table {
                        border-spacing: 1;
                        border-collapse: collapse;
                        background: #fff;
                        border-radius: 10px;
                        overflow: hidden;
                        width: 100%;
                        margin: 0 auto;
                        position: relative
                    }

                    table * {
                        position: relative
                    }

                    table td,
                    table th {
                        padding-left: 8px
                    }

                    table thead tr {
                        height: 60px;
                        background: #8EC702
                    }

                    table tbody tr {
                        height: 50px
                    }

                    table tbody tr:last-child {
                        border: 0
                    }

                    table td,
                    table th {
                        text-align: left
                    }

                    table td.l,
                    table th.l {
                        text-align: right
                    }

                    table td.c,
                    table th.c {
                        text-align: center
                    }

                    table td.r,
                    table th.r {
                        text-align: center
                    }

                    .table100-head th {
                        font-family: 'Lato', helvetica, arial, sans-serif;
                        ;
                        font-size: 16.5px;
                        color: #fff;
                        line-height: 1.2;
                        font-weight: unset
                    }

                    tbody tr:nth-child(even) {
                        background-color: #f5f5f5
                    }

                    tbody tr {
                        font-family: 'Lato', helvetica, arial, sans-serif;
                        ;
                        font-size: 13.5px;
                        color: gray;
                        line-height: 1.2;
                        font-weight: unset
                    }


                    table tbody tr:hover {
                        color: #507000;
                        background-color: #8fc702b1;
                        cursor: pointer
                    }

                    .column1 {
                        width: 10%;
                        padding-left: 10px
                    }

                    .column2 {
                        width: 25%
                    }

                    .column3 {
                        width: 10%
                    }

                    .column4 {
                        width: 30%;
                    }

                    .column5 {
                        width: 10%;
                    }

                    .column6 {
                        width: 7%;
                        /* padding-right: 62px */
                    }

                    @media screen and (max-width:992px) {
                        table {
                            display: block
                        }

                        table>*,
                        table tr,
                        table td,
                        table th {
                            display: block
                        }

                        table thead {
                            display: none
                        }

                        table tbody tr {
                            height: auto;
                            padding: 20px 5px
                        }

                        table tbody tr td {
                            padding-left: 40% !important;
                            margin-bottom: 10px
                        }

                        table tbody tr td:last-child {
                            margin-bottom: 0
                        }

                        table tbody tr td:before {
                            font-family: 'Lato', helvetica, arial, sans-serif;
                            ;
                            font-size: 14px;
                            color: #999;
                            line-height: 1.2;
                            font-weight: unset;
                            position: absolute;
                            width: 40%;
                            left: 30px;
                            top: 0
                        }

                        table tbody tr td:nth-child(1):before {
                            content: "STT"
                        }

                        table tbody tr td:nth-child(2):before {
                            content: "NGƯỜI NHẬN"
                        }

                        table tbody tr td:nth-child(3):before {
                            content: "SỐ ĐIỆN THOẠI	"
                        }

                        table tbody tr td:nth-child(4):before {
                            content: "TRẠNG THÁI	"
                        }

                        table tbody tr td:nth-child(5):before {
                            content: "GIÁ TIỀN"
                        }

                        table tbody tr td:nth-child(6):before {
                            content: "ĐÃ MUA"
                        }

                        .column4,
                        .column5,
                        .column6 {
                            text-align: left
                        }

                        .column4,
                        .column5,
                        .column6,
                        .column1,
                        .column2,
                        .column3 {
                            width: 100%
                        }

                        tbody tr {
                            font-size: 14px
                        }

                        table tbody tr:hover {
                            color: #999;
                            background-color: #ddddddc6;
                            cursor: pointer
                        }
                    }

                    /* @media(max-width:576px) {
                    .container-table100 {
                        padding-left: 15px;
                        padding-right: 15px
                    }
                } */
                </style>
                <div class="section-gap" style="overflow-x: auto;">
                    <table style="min-width: 100%;">
                        <thead>
                            <tr class="table100-head">
                                <th class="column1">STT</th>
                                <th class="column2">NGƯỜI NHẬN</th>
                                <th class="column3">SỐ ĐIỆN THOẠI</th>
                                <th class="column4">TRẠNG THÁI</th>
                                <th class="column5">GIÁ TIỀN</th>
                                <th class="column6">ĐÃ MUA</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $stt = 1;
                        $select_orders = null;
                        $select_order_pay = mysqli_query($conn, "SELECT * FROM `order_pay`") or die('query failed');

                        while ($select_order_pays = mysqli_fetch_assoc($select_order_pay)) {
                            $order_id = $select_order_pays['id_order'];

                            $select_orders = mysqli_query($conn, "SELECT * FROM `order` WHERE `id` = $order_id");
                        }
                        $select_orders = mysqli_query($conn, "SELECT * FROM `order` ");
                        if (mysqli_num_rows($select_orders) > 0) {
                            while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {

                        ?>
                            <tr>
                                <td><?php echo $stt++; ?></td>
                                <td><?php echo $fetch_orders['name'] ?></td>
                                <td><?php echo $fetch_orders['number'] ?></td>
                                <td>{{ $item->address }}</td>
                                <td><?php echo $fetch_orders['total_price'] ?></td>
                                <td>
                                    <a href="./user_order_detail.php?detail=<?php echo $fetch_orders['id'] ?>">Xem Chi Tiết</a>
                                </td>
                            </tr>
                            <?php
                            }
                        } else {
                            echo '<p class="empty">no products added yet!</p>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div> -->
















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