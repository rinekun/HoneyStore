<?php include '../index/head.php' ?>
<?php include '../index/nav.php';


//adding the products to database
if (isset($_POST['add_product'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['price']);
    $product_detail = mysqli_real_escape_string($conn, $_POST['detail']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../../hinh/' . $image;


    $select_product_name =  mysqli_query($conn, "SELECT name FROM `product` WHERE name='$product_name'") or die('query failed');

    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'tên sản phẩm đã tồn tại';
    } else {
        $insert_product = mysqli_query($conn, "INSERT INTO `product`(`name`,`price`,`product_detail`,`image`) 
       VALUES ('$product_name','$product_price','$product_detail','$image')") or die('query failed');

        if ($insert_product) {
            if ($image_size > 2000000) {
                $message[] = 'kích thước hình ảnh quá lớn';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'thêm sản phẩm thành công';
            }
        }
    }
}

?>

<section class="main_content dashboard_part">
    <?php
    include '../index/userAdmin.php';

    ?>



    <div class="main_content_iner ">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">

                <div class="col-lg-12">
                    <div class="white_box mb_30">
                        <div class="box_header ">
                            <div class="main-title">
                                <h3 class="mb-0">Loại Sản Phẩm</h3>
                            </div>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row justify-content-center">
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="exampleFormControlInput1">Tên Sản Phẩm</label>
                                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="exampleFormControlInput1">Đồng Giá</label>
                                    <input type="text" name="price" class="form-control" id="exampleFormControlInput1">
                                </div>
                                <!-- <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="exampleFormControlInput1">Giảm Giá</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1">
                                </div> -->

                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="exampleFormControlInput1">Hình Ảnh</label>
                                    <input type="file" name="image" id="image" class="form-control" id="inputGroupFile01">

                                </div>

                                <!-- <div class="mb-3 col-lg-4 ">
                                    <label class="form-label" for="exampleFormControlInput1">Ngày Đăng</label>
                                    <input type="date" class="form-control" id="exampleFormControlInput1">
                                </div> -->


                                <!-- <div class="mb-3 col-lg-4 ">
                                    <label class="form-label" for="exampleFormControlInput1">Tên loại</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1">
                                </div> -->
                                <!-- <div class="mb-3 col-lg-4 ">
                                    <label class="form-label" for="exampleFormControlInput1">Loại Hàng</label>
                                    <select class="form-select form-control-sm ">
                                        <option>Small select</option>
                                    </select>
                                </div> -->

                                <div class="mb-12 col-lg-12 ">
                                    <label class="form-label" for="exampleFormControlInput1">Chi Tiết</label><br>
                                    <textarea name="detail" required rows="4" cols="106"></textarea>

                                </div>

                            </div>
                            <div class="mb-3">
                                <input type="submit" name="add_product" class="btn btn-info" id="inputGroupFile01" style="float:right" value="CẬP NHẬT">
                            </div>
                        </form>
                    </div>
                </div>


            </div>

        </div>

        <?php include '../index/footer.php' ?>