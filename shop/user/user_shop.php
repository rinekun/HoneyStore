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
    $product_quantity = $_POST['product_quantity'];
    $cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name ='$product_name' AND user_id ='$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_number) > 0) {
        $message[] = 'product alreary in cart';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`( `user_id`, `pid`, `name`, `price`, `quantity`,`image`) VALUES ('$user_id','$product_id','$product_name','$product_price','$product_quantity','$product_image')");
        $message[] = 'product successfuly added in your cart';
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="../css/main.css">
    <title>Home page</title>
</head>

<body>
    <?php
    include './user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>SHOP</h1>
            <p>Sản phẩm mật ong nhà dự án tận tâm chất lượng và giá trị tốt nhất</p>
            <a href="index.php">Trang chủ</a>/<span>SHOP</span>
        </div>
    </div>
    <div class="line"></div>
    <!-- about us -->
    <section class="shop">
        <h1 class="title">SHOP BEST SELLERS</h1>
        <?php
        if (isset($message)) {
            foreach ($message as $message) {
                echo
                '
              <div class="message">
               <span>
                 ' . $message . '
               </span>
               <i class="bx bx-x-circle" onclick="this.parentElement.remove()"></i>
              </div>
            ';
            }
        }

        ?>

        <div class="box-container">
            <!-- phần tìm kiếm  -->
            <?php
            // $select_products = null;
            // lấy url name = ? 
            $search = isset($_GET['name']) ? $_GET['name']:'';
            /**
             * nếu có search thì vào if
             * 
             * còn ngược lại không tìm kiếm sẽ vào else
             */

            if ($search) {
                // tìm kiếm nếu có sản phẩm sẽ tìm ra - where điều kiện 
                //'name'-> lấy giá trị tên sản phẩm trên database
                //LiKe -> tìm kiếm trùng tên
                // % ->là tìm sản phẩm giá trị tương đối có thể tìm 2 hoặc 3 sản phẩm cùng tên ví dụ -> mật ong rừng -> mật ông rưng 2022 ,mật ông rừng 100%,.....
                // còn ko có % -> tìm sản phẩm tuyệt đối tìm 1 sản phẩm có tên 100% ví dụ : mật ông uống là chết  -> nếu có tên là ra nêu ko là ko ta  
                //$search -> tên đễ tìm sản phẩm 
                $select_products = mysqli_query($conn, "SELECT * FROM `product` WHERE `name` LIKE '%".$search . "%'");
            } else {
                
                // $select_products lấy tất cả sản phẩm ra 
                $select_products = mysqli_query($conn, "SELECT * FROM `product`");
            }
            ?>
            <form action="" method="GET">
                <div class="input-group">
                    <div id="search-autocomplete" class="form-outline">
                        <input type="search" id="form1" name='name' class="form-control" value="<?=isset($_GET['name']) ? $_GET['name']:''?>"/>
                    </div>

                    <input type="submit" class="form-outline" value="tim kiem"><i class='fas fa-search'></i>
                </div>
            </form>
            <div class="sanpham">
                <?php

            
                    while ($fetch_products = mysqli_fetch_assoc($select_products)) { ?>
                        <form method="post" class="box" enctype="multipart/form-data">
                            <img src="../hinh/<?php echo $fetch_products['image'] ?>" alt="">
                            <div class="name"><?php echo $fetch_products['name'] ?></div>
                            <div class="price"><?php echo $fetch_products['price'] ?> đ</div>
                            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id'] ?>">
                            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'] ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price'] ?>">
                            <input type="hidden" name="product_quantity" value="1" min="1">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                            <div class="icon">
                                <a href="user_view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="bi bi-eye-fill"></a>
                                <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                                <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                            </div>
                        </form>
                <?php
                
                    }
        
                ?>
            </div>

        </div>
    </section>
    <div class="line"></div>
    <?php include '../user/user_footer.php'; ?>

    <!-- slick slider link -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <script>
        const basicAutocomplete = document.querySelector('#search-autocomplete');
        const data = ['One', 'Two', 'Three', 'Four', 'Five'];
        const dataFilter = (value) => {
            return data.filter((item) => {
                return item.toLowerCase().startsWith(value.toLowerCase());
            });
        };

        new mdb.Autocomplete(basicAutocomplete, {
            filter: dataFilter
        });
    </script>
</body>

</html>