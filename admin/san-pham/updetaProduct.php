<?php
ob_start();
// Gộp tệp head.php
include '../index/head.php';

// Gộp tệp nav.php
include '../index/nav.php';

if (isset($_POST['update_product'])) {
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];
    $update_detail = $_POST['update_detail'];
    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = '../../hinh/' . $update_image;

    $update_query = mysqli_query($conn, "UPDATE `product` SET `id`='$update_id', `name`='$update_name',`price`='$update_price',
                                              `product_detail`='$update_detail',`image`='$update_image' WHERE id='$update_id' ")
        or die('query failed');
    if ($update_query) {
        move_uploaded_file($update_image_tmp_name, $update_image_folder);
        ob_end_clean(); // Xóa bỏ nội dung đã lưu trong bộ đệm
        header('location:listProduct.php');
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

                        <?php
                        if (isset($_GET['edit'])) {
                            $edit_id = $_GET['edit'];
                            $edit_query = mysqli_query($conn, "SELECT*FROM `product` WHERE id='$edit_id'") or die('query failed');
                            if (mysqli_num_rows($edit_query) > 0) {
                                while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
                        ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
                                        <div class="row justify-content-center">
                                            <div class="mb-3 col-lg-4">
                                                <label class="form-label" for="exampleFormControlInput1">Tên Sản Phẩm</label>
                                                <input type="text" name="update_name" class="form-control" id="exampleFormControlInput1" value="<?php echo $fetch_edit['name']; ?>">
                                            </div>
                                            <div class="mb-3 col-lg-4">
                                                <label class="form-label" for="exampleFormControlInput1">Đồng Giá</label>
                                                <input type="text" name="update_price" class="form-control" id="exampleFormControlInput1" value="<?php echo $fetch_edit['price']; ?>">
                                            </div>

                                            <div class="mb-3 col-lg-4">
                                                <label class="form-label" for="exampleFormControlInput1">Hình Ảnh</label>
                                                <input type="file" name="update_image" id="image" class="form-control" id="inputGroupFile01" value="<?php echo $fetch_edit['image']; ?>">

                                            </div>


                                            <div class="mb-12 col-lg-12 ">
                                                <label class="form-label" for="exampleFormControlInput1">Chi Tiết</label><br>
                                                <textarea name="update_detail" required rows="4" cols="106" value='<?php echo $fetch_edit['product_detail']; ?>'></textarea>

                                            </div>

                                        </div>
                                        <div class="mb-3">
                                            <input type="submit" name="update_product" class="btn btn-info" id="inputGroupFile01" style="float:right" value="CẬP NHẬT">
                                        </div>
                                    </form>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>


            </div>

        </div>

        <?php include '../index/footer.php' ?>