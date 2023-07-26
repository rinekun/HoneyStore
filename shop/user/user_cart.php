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
        // $grand_total += $total_amt;
        $update_value++;
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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

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
    /* .input-td{
        padding: 200px;
    } */
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
        


        <div class="row bootstrap snippets">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="col-lg-12 col-sm-12">
                    <span class="title">SHOPPING CART</span>
                </div>
                <div class="col-lg-12 col-sm-12 hero-feature">
                    <div class="table-responsive">
                        <table class="table table-bordered tbl-cart">
                            <thead>
                                <tr>
                                    <td class="hidden-xs">Hình</td>
                                    <td>Tên Sản Phẩm</td>

                                    <td class="td-qty">Số lượng</td>

                                    <td>Giá tiền</td>
                                    <!-- <td>Tổng tiền</td> -->

                                    <td>Xóa</td>


                                </tr>
                            </thead>
                            <tbody>


                                <?php
                                $grand_total = 0;
                                $select_cart = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                                if (mysqli_num_rows($select_cart) > 0) {
                                    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) { ?>
                                        <tr>
                                            <td class="hidden-xs">
                                                <a href="#">
                                                    <img src="../hinh/<?php echo $fetch_cart['image'] ?>" alt="Age Of Wisdom Tan Graphic Tee" title="" width="47" height="47">
                                                </a>
                                            </td>
                                            <td><a href="#"><?php echo $fetch_cart['name'] ?></a>
                                            </td>
                                            <td class="input-td">
                                                <form method="post">
                                                    <div class="input-group bootstrap-touchspin">
                                                        <span class="input-group-btn">
                                                            <input type="hidden" name="update_qty_id" value="<?php echo $fetch_cart['id']; ?>">

                                                            <input type="submit" name="update_qty_btn" class="btn btn-default bootstrap-touchspin-down" id="tru" value="-">
                                                        </span>
                                                        <span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>
                                                             <input type="text" name="update_qty" value="<?php echo $fetch_cart['quantity'] ?>" class="input-qty form-control text-center" id="soluong" style="display: block;">
                                                        <span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span>
                                                        
                                                        <span class="input-group-btn">
                                                            <input type="submit" name="update_qty_btn" class="btn btn-default bootstrap-touchspin-down" id='cong' value="+">
                                                        </span>
                                                    </div>
                                                </form>
                                            </td>
                                            <input type="hidden" value="<?php echo $total_amt = ($fetch_cart['price'] * $fetch_cart['quantity']) ?>">
                                            <td class="price">
                                                <p id="price"><?= $fetch_cart['price'] * $fetch_cart['quantity'] ?></p>
                                            </td>
                                            <!-- <td class="tong" id="tong"></td> -->

                                            <td class="text-center">
                                                <a href="user_cart.php?delete=<?php echo $fetch_cart['id'] ?>" class="remove_cart" rel="2">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                        $grand_total += $total_amt;
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="2" align="right">Tổng</td>
                                    <td class="total" colspan="2"><b><?php echo $grand_total ?></b>
                                    </td>
                                    <td class="total" colspan="1" align="center"><b><a style=" text-decoration: none;" href="user_cart.php?delete_all" class="btn2" onclick="return confirm('do you want to delete all item in your cart?')">Xóa tất cả</a></b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="btn-group btns-cart">
                        <a href="./user_shop.php">
                            <button type="button" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> TIẾP TỤC MUA</button>
                        </a>
                        <!-- <button type="button" class="btn btn-primary">Update Cart</button> -->
                        <a href="./checkout.php">
                            <button type="button" class="btn btn-primary" <?php echo ($grand_total > 1) ? '' : 'disabled' ?>>THANH TOÁN <i class="fa fa-arrow-circle-right"></i></button>
                        </a>

                    </div>

                </div>

            </div>
        </div>



    </div>
    <div class="line"></div>
    <?php include '../user/user_footer.php'; ?>

    <!-- slick slider link -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
    <script>
        // var tru = document.querySelectorAll('#tru');
        // var cong = document.querySelectorAll('#cong');
        // var soluong = document.querySelectorAll('#soluong');
        // var price = document.querySelector('#price');
        // var tong = document.querySelectorAll('#tong');

        // console.log(price);
        // // function tinh() {
        // //     for (let i = 0; i < cong.length; i++) {
        // //         cong

        // //     }
        // // }
        // // console.log(tinh()); 

        // for (let i = 0; i < cong.length; i++) {
        //     cong[i].addEventListener("click", () => {
        //         // for (let j = 0; j < soluong.length; j++) {
        //         var x = soluong[i].value++
        //         price.innerHTML *= x
        //         // }

        //     })
        // }




        // for (let i = 0; i < cong.length; i++) {
        //     tru[i].addEventListener("click", () => {
        //         // for (let j = 0; j < soluong.length; j++) {
        //         var x = soluong[i].value--
        //         price.innerHTML *= x
        //         // }

        //     })
        // }



        var tru = document.querySelectorAll('#tru');
        var cong = document.querySelectorAll('#cong');
        var soluong = document.querySelectorAll('#soluong');
        var price = document.querySelectorAll('#price');

        for (let i = 0; i < tru.length; i++) {
            tru[i].addEventListener("click", () => {
                var x = parseInt(soluong[i].value) - 1;
                if (x >= 1) {
                    soluong[i].value = x;
                    price[i].innerHTML = parseInt(price[i].innerHTML) / (x + 1);
                }
            });
        }

        for (let i = 0; i < cong.length; i++) {
            cong[i].addEventListener("click", () => {
                var x = parseInt(soluong[i].value) + 1;
                soluong[i].value = x;
                price[i].innerHTML = parseInt(price[i].innerHTML) * x;
            });
        }
    </script>
</body>


</html>