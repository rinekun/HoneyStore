<?php
include_once '../../config/config.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:../dang_nhap.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:../dang_nhap.php');
}
if (isset($_POST['order-btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, 'flat no. ' . $_POST['flate'] . ',' . $_POST['street'] . ',' . $_POST['city'] . ',' . $_POST['state'] . ',' . $_POST['country'] . ',' . $_POST['pin']);
    $placed_on = date('d-M-Y');
    $cart_total = 0;
    $cart_product[] = '';
    $id_cart = array();
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id ='$user_id'");
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $id_cart[$cart_item['id']] = $cart_item;
            $cart_product[] = $cart_item['name'] . '(' . $cart_item['quantity'] . ')';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }
    /**
     *   $id_order = lấy id  của phần order để biết id của order của người đặt  
     *  
     */
    $id_order =  $_POST['id_order'];

    $message[] = 'order placed successfully';
    $total_products = implode(',', $cart_product);
    mysqli_query($conn, "INSERT INTO `order`( `user_id`, `name`, `number`, `email`, `method`, `address`, `total_product`, `total_price`, `place_on`) VALUES ('$user_id','$name','$number','$email','$method','$address','$total_product','$cart_total','$placed_on')");
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id='$user_id'") or die('query failed');
    header('location:checkout.php');


    $id_order +=1;
    
    foreach ($id_cart as $key => $value) {
        // $lấy value là lấy tât giá trị của nó ví dụ : name : 'mật ông', price : 2000;  key => name ; value : mật ông 
        // $product_select => lấy giá trị rỗng để trc
        $product_select = '';

        // $product_select .= có nghĩa lấy sản phẩm bao gồm id_order , user_id của user , $value['name'] tên sản phẩm , $value['quantity'] số lượng sản phẩm.....
        $product_select .= "('NULL', '$id_order', '$user_id','" . $value['name'] . "','" . $value['quantity'] . "','" . $value['price'] . "', '" . $value['image'] . "','" . date('Y-m-02') . "')";
        // khi lấy xong để vào VALUE ('.$product_select.') TƯƠNG ỨNG TỪ VỊ TRÍ
        mysqli_query($conn, "INSERT INTO `order_pay`(`id`,`id_order`,`id_user`,`name`,`quantity`,`price`, `image_product`,`dates`) VALUES " . $product_select . ";");
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
        grid-template-columns: repeat(auto-fit, minmax(25rem, 1rem));
        justify-content: center;
        align-items: center;
    }

    header .user-box {
        margin-left: 108rem;
    }

    .container {
        width: 100%;
        -js-display: flex;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-flow: row wrap;
        flex-flow: row wrap;
    }
</style>

<body>

    <?php
    include './user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>CHECKOUT</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, tenetur.</p>
            <a href="">home</a>/<span>checkout</span>
        </div>
    </div>
    <!-- checkout form -->
    <h1 class="title">payment</h1>
    <div class="container">

        <?php
        // if (isset($message)) {
        //     foreach ($message as $message) {
        //         echo
        //         '
        //       <div class="message">
        //        <span>
        //          ' . $message . '
        //        </span>
        //        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
        //       </div>
        //     ';
        //     }
        // }

        ?>
        <div class="large-5 col" style="width:59%">
            <div class="checkout-form">
                <form method="post">

                    <?php
                    $id_order_FP = null;
                    $id_order_pay = mysqli_query($conn, "SELECT * FROM `order`") or die('query failed');

                    while ($id_orders = mysqli_fetch_assoc($id_order_pay)) {
                        $id_order_FP = $id_orders['id'];
                        //$id_order_FP tìm kiếm  id ở vị trí nào 

                    ?>
                        <input type="hidden" name="id_order" value=" <?php echo $id_order_FP // lấy id thành công để chuyển về database 
                                                                        ?>">';
                    <?php   }

                    ?>


                    <div class="input-field">
                        <label for="">your name</label>
                        <input type="text" name="name" placeholder="enter your name">
                    </div>
                    <div class="input-field">
                        <label for="">your number</label>
                        <input type="number" name="number" placeholder="enter your number">
                    </div>
                    <div class="input-field">
                        <label for="">your email</label>
                        <input type="email" name="email" placeholder="enter your email">
                    </div>
                    <div class="input-field">
                        <label for="">select payment method</label>
                        <select name="method">
                            <option selected disabled>select payment method</option>
                            <option value="cash on delivery"> cash on delivery</option>
                            <option value="cradit card">cradit card</option>
                            <option value="paytm">paytm</option>
                            <option value="paypal">paypal</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <label for="">address line 1</label>
                        <input type="text" name="flate" placeholder="e.g flate no.">
                    </div>
                    <div class="input-field">
                        <label for="">address line 2</label>
                        <input type="text" name="flate" placeholder="e.g street name">
                    </div>
                    <div class="input-field">
                        <label for="">city</label>
                        <input type="text" name="city" placeholder="e.g delhi">
                    </div>
                    <div class="input-field">
                        <label for="">state</label>
                        <input type="text" name="state" placeholder="e.g new delhi">
                    </div>
                    <div class="input-field">
                        <label for="">country</label>
                        <input type="text" name="country" placeholder="e.g India">
                    </div>
                    <div class="input-field">
                        <label for="">pin code</label>
                        <input type="text" name="flate" placeholder="e.g 110012">
                    </div>
                    <input type="submit" name="order-btn" class="btn" value="order now">
                </form>
            </div>
        </div>
        <div class="large-7 col" style="width:41%;">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Number</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select_cart = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                        $total = 0;
                        $grand_total = 0;
                        if (mysqli_num_rows($select_cart) > 0) {
                            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                                $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                                $grand_total = $total += $total_price;
                        ?>

                                <!-- <input type="hidden" name="name_pay">
                             <input type="hidden" name="quantity_pay">
                             <input type="hidden" name="price_pay">
                             <input type="hidden" name="img_pay">
                             <input type="hidden" name="img_pay">    -->



                                <tr>
                                    <td class="col-sm-8 col-md-6">
                                        <div class="media">
                                            <a class="thumbnail pull-left" href="#"><img class="media-object" src="../hinh/<?php echo $fetch_cart['image'] ?>" style="width: 72px; height: 72px;"> </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="#"><?php echo $fetch_cart['name'] ?></a></h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="col-sm-1 col-md-1 text-center"><strong><?php echo $fetch_cart['quantity'] ?></strong></td>
                                    <td class="col-sm-1 col-md-1 text-center"><strong> <?= $total_price; ?> đ</strong></td>
                            <?php
                            }
                        }
                            ?>

                                </tr>
                                <tr>
                                    <td>
                                        <h3>Total</h3>
                                    </td>
                                    <td>   </td>
                                    <td class="text-right">
                                        <h3><strong><?php echo $grand_total; ?>đ</strong></h3>
                                    </td>

                                </tr>
                                <tr>
                                    <td>   </td>
                                    <td></td>
                                    <td></td>
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