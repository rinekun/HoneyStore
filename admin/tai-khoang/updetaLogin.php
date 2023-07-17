<?php
ob_start();
// Gộp tệp head.php
include '../index/head.php';

// Gộp tệp nav.php
include '../index/nav.php';

if (isset($_POST['update_login'])) {
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_email = $_POST['update_email'];
    $update_password = $_POST['update_password'];
    $update_role = $_POST['update_role'];



    $update_query = mysqli_query($conn, "UPDATE `users` SET `id`='$update_id', `name`='$update_name',`email`='$update_email',
                                              `password`='$update_password',`user_type`='$update_role' WHERE id='$update_id' ")
        or die('query failed');
    if ($update_query) {
        ob_end_clean(); // Xóa bỏ nội dung đã lưu trong bộ đệm
        header('location:listLogin.php');
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
                            $edit_query = mysqli_query($conn, "SELECT*FROM `users` WHERE id='$edit_id'") or die('query failed');
                            if (mysqli_num_rows($edit_query) > 0) {
                                while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
                        ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
                                        <div class="row justify-content-center">
                                            <div class="mb-3 col-lg-4">
                                                <label class="form-label" for="exampleFormControlInput1">Họ Và Tên</label>
                                                <input type="text" name="update_name" class="form-control" id="exampleFormControlInput1" value="<?php echo $fetch_edit['name']; ?>">
                                            </div>
                                            <div class="mb-3 col-lg-4">
                                                <label class="form-label" for="exampleFormControlInput1">Email</label>
                                                <input type="text" name="update_email" class="form-control" id="exampleFormControlInput1" value="<?php echo $fetch_edit['email']; ?>">
                                            </div>

                                            <div class="mb-3 col-lg-4">
                                                <label class="form-label" for="exampleFormControlInput1">Mật Khẩu</label>
                                                <input type="text" name="update_password" class="form-control" id="inputGroupFile01" value="<?php echo $fetch_edit['password']; ?>">
                                            </div>

                                            <div class="mb-3 col-lg-12 ">
                                                <label class="form-label" for="exampleFormControlInput1">Vai Trò</label><br>
                                                <input type="radio" name="update_role" value="user" class=""> <span>Khách hàng</span><br>
                                                <input type="radio" name="update_role" value="admin" class="" checked> <span>Nhân viên</span>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <input type="submit" name="update_login" class="btn btn-info" id="inputGroupFile01" style="float:right" value="CẬP NHẬT">
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