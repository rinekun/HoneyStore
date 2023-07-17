<style>
    .account-settings .user-profile {
        margin: 0 0 1rem 0;
        padding-bottom: 1rem;
        text-align: center;
    }

    .account-settings .user-profile .user-avatar {
        margin: 0 0 1rem 0;
    }

    .account-settings .user-profile .user-avatar img {
        width: 90px;
        height: 90px;
        -webkit-border-radius: 100px;
        -moz-border-radius: 100px;
        border-radius: 100px;
    }

    .account-settings .user-profile h5.user-name {
        margin: 0 0 0.5rem 0;
    }

    .account-settings .user-profile h6.user-email {
        margin: 0;
        font-size: 0.8rem;
        font-weight: 400;
        color: #9fa8b9;
    }

    .account-settings .about {
        margin: 2rem 0 0 0;
        text-align: center;
    }

    .account-settings .about h5 {
        margin: 0 0 15px 0;
        color: #007ae1;
    }

    .account-settings .about p {
        font-size: 0.825rem;
    }

    .form-control {
        border: 1px solid #cfd1d8;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        font-size: .825rem;
        background: #ffffff;
        color: #2e323c;
    }

    .card {
        background: #ffffff;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 0;
        margin-bottom: 1rem;

    }
</style>
<?php
ob_start();
// Gộp tệp head.php
include '../index/head.php';

// Gộp tệp nav.php
include '../index/nav.php';


if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $select_user = mysqli_query($conn, "SELECT * FROM users WHERE id = '$admin_id'") or die('query failed');
    $select_users = mysqli_fetch_assoc($select_user);
    $user_id = $select_users['id'];




    if (isset($_POST['update_admin'])) {
        $update_id = $_POST['update_id'];
        $update_name = $_POST['update_name'];
        $update_email = $_POST['update_email'];
        $update_password = $_POST['update_password'];


        $update_query = mysqli_query($conn, "UPDATE `users` SET `id`='$update_id', `name`='$update_name',`email`='$update_email',
                                              `password`='$update_password' WHERE id='$update_id' ")
            or die('query failed');
        if ($update_query) {
            ob_end_clean(); // Xóa bỏ nội dung đã lưu trong bộ đệm
            header("location:../../admin/user-admin/users.php?id=$user_id");
        }
    }
}

?>
<section class="main_content dashboard_part">

    <?php
    include '../index/userAdmin.php';
    ?>

    <?php
    if (isset($_GET['id'])) {
        $edit_id = $_GET['id'];
        $edit_query = mysqli_query($conn, "SELECT * FROM `users` WHERE id='$edit_id'") or die('query failed');
        if (mysqli_num_rows($edit_query) > 0) {
            while ($fetch_users = mysqli_fetch_assoc($edit_query)) {
    ?>
                <form action="" method="post">
                    <input type="hidden" name="update_id" value="<?php echo $fetch_users['id']; ?>">

                    <div class="container" >
                        <div class="row gutters"style="background-color: #007ae1;">
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                <div class="card h-100">
                                    <div class="card-body">

                                        <div class="account-settings">
                                            <div class="user-profile">


                                                <div class="user-avatar">
                                                    <img src="../../admin/asset/img/client_img.png" alt="Maxwell Admin">
                                                </div>
                                                <h5 class="user-name"><?php echo $fetch_users['name'] ?></h5>
                                                <h6 class="user-email"><?php echo $fetch_users['email'] ?></h6>
                                            </div>
                                            <div class="about">
                                                <h5>About</h5>
                                                <p>I'm Yuki. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <h6 class="mb-2 text-primary">Personal Details</h6>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="fullName">Họ và tên</label>
                                                    <input type="text" name="update_name" class="form-control" id="fullName" placeholder="Enter full name" value="<?php echo $fetch_users['name'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="eMail">Email</label>
                                                    <input type="email" name="update_email" class="form-control" id="eMail" placeholder="Enter email ID" value="<?php echo $fetch_users['email'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">


                                                <div class="form-group">
                                                    <label for="phone">Số điện thoại</label>
                                                    <input type="text" name="" class="form-control" id="phone" placeholder="Điện Thoại">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="pssword">Mật Khẩu</label>
                                                    <input type="text" name="update_password" class="form-control" id="website" value="<?php echo $fetch_users['password'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="mt-3 mb-2 text-primary">Địa chỉ</h6>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="Street">Đường phố</label>
                                                <input type="name" class="form-control" id="Street" placeholder="Địa chỉ">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="ciTy">Quốc gia</label>
                                                <input type="name" class="form-control" id="ciTy" placeholder="Vn,.....">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="sTate">Tỉnh thành phố</label>
                                                <input type="text" class="form-control" id="sTate" placeholder="Tỉnh thành">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="zIp">Bưu điện</label>
                                                <input type="text" class="form-control" id="zIp" placeholder="Mã bưu điện">
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row gutters" style="margin-top: 10px;">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="text-right">
                                                    <button type="button" id="submit" name="submit" class="btn btn-secondary" style="background-color: white;"><a href="../index.php" style="text-decoration: none; ">Hủy bỏ</a></button>
                                                    <input type="submit" name="update_admin" id="submit" name="submit" class="btn btn-primary" value="Cập nhật">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
    <?php
            }
        }
    }
    ?>


    <?php include '../index/footer.php' ?>