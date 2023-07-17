<?php include '../index/head.php' ?>
<?php include '../index/nav.php';


//adding the products to database

if (isset($_POST['add_user'])) {

    $user_name = mysqli_real_escape_string($conn, $_POST['name']);
    $user_email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_password = mysqli_real_escape_string($conn, $_POST['password']);
    $user_role =  mysqli_real_escape_string($conn, $_POST['role']);

    $select_user_email =  mysqli_query($conn, "SELECT email FROM `users` WHERE email='$user_email'") or die('query failed');
    $select_user_ten =  mysqli_query($conn, "SELECT name FROM `users` WHERE name='$user_name'") or die('query failed');

    if (mysqli_num_rows($select_user_email) > 0 || mysqli_num_rows($select_user_ten) > 0) {
        $message[] = 'Email hoặc Tên đã tồn tại';
    } else {
        mysqli_query($conn, "INSERT INTO `users`(`name`,`email`,`password`,`user_type`) 
      VALUES ('$$user_name','$user_email','$user_password','$user_role')") or die('query failed');
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
                                    <label class="form-label" for="exampleFormControlInput1">Họ Và Tên</label>
                                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="exampleFormControlInput1">Email</label>
                                    <input type="text" name="email" class="form-control" id="exampleFormControlInput1">
                                </div>
                                <!-- <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="exampleFormControlInput1">Giảm Giá</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1">
                                </div> -->

                                <div class="mb-3 col-lg-4">
                                    <label class="form-label" for="exampleFormControlInput1">Mật Khẩu</label>
                                    <input type="text" name="password" id="image" class="form-control" id="inputGroupFile01">
                                </div>

                                <div class="mb-3 col-lg-12 ">
                                    <label class="form-label" for="exampleFormControlInput1">Vai Trò</label><br>
                                    <input type="radio" name="role" value="user" class=""> <span>Khách hàng</span><br>
                                    <input type="radio" name="role" value="admin" class="" checked> <span>Nhân viên</span>
                                </div>


                            </div>
                            <div class="mb-3">
                                <input type="submit" name="add_user" class="btn btn-info" id="inputGroupFile01" style="float:right" value="CẬP NHẬT">
                            </div>
                        </form>
                    </div>
                </div>


            </div>

        </div>

        <?php include '../index/footer.php' ?>