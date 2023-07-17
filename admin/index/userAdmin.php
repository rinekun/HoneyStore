<?php
include '../config/config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$admin_id = $_SESSION['admin_name'];
if (!isset($admin_id)) {
    header('location:./dang_nhap.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:./dang_xuat.php');
}

?>

<div class="container-fluid g-0">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="sidebar_icon d-lg-none">
                    <i class="ti-menu"></i>
                </div>
                <div class="serach_field-area">
                    <div class="search_inner">
                        <form action="#">
                            <div class="search_field">
                                <input type="text" placeholder="Search here...">
                            </div>
                            <button type="submit"> <img src="../../admin/asset/img/icon/icon_search.svg" alt> </button>
                        </form>
                    </div>
                </div>
                <div class="header_right d-flex justify-content-between align-items-center">
                    <div class="header_notification_warp d-flex align-items-center">
                        <li>
                            <a href="#"> <img src="../../admin/asset/img/icon/bell.svg" alt> </a>
                        </li>
                        <li>


                            <a href="#"> <img src="../../admin/asset/img/icon/msg.svg" alt> </a>
                        </li>
                    </div>
                    <div class="profile_info">
                        <img src="../../admin/asset/img/client_img.png" alt="#">
                        <div class="profile_info_iner">
                            <p>Welcome.!</p>
                            <h5>Taravor James</h5>
                            <div class="profile_info_details">
                                <a href="#">My Profile <i class="ti-user"></i></a>
                                <?php
                                if (isset($_SESSION['admin_id'])) {
                                    $admin_id = $_SESSION['admin_id'];
                                    $select_user = mysqli_query($conn, "SELECT * FROM users WHERE id = '$admin_id'") or die('query failed');
                                    $select_users = mysqli_fetch_assoc($select_user);
                                    $user_id = $select_users['id'];
                                ?>
                                    <a href="../../admin/user-admin/users.php?id=<?php echo $user_id; ?>">Settings <i class="ti-settings"></i></a>
                                <?php
                                }
                                ?>

                                <a href="#">Log Out <i class="ti-shift-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>