<?php
ob_start();
include '../index/head.php';
include '../index/nav.php';

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE id='$delete_id'") or die('query failed');
    header('location:listMessage.php');
}
?>
<?php
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `order` WHERE id='$delete_id'") or die('query failed');
    $message[] = 'order removed successfully';
    header('location:listMessage.php');
}
if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];

    mysqli_query($conn, "UPDATE `order` SET payment_status='$update_payment' WHERE id='$order_id' ") or die('query failed');
}
?>


<section class="main_content dashboard_part">
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
                                <button type="submit"> <img src="../admin/img/icon/icon_search.svg" alt> </button>
                            </form>
                        </div>
                    </div>
                    <div class="header_right d-flex justify-content-between align-items-center">
                        <div class="header_notification_warp d-flex align-items-center">
                            <li>
                                <a href="#"> <img src="../admin/img/icon/bell.svg" alt> </a>
                            </li>
                            <li>
                                <a href="#"> <img src="../admin/img/icon/msg.svg" alt> </a>
                            </li>
                        </div>
                        <div class="profile_info">
                            <img src="../admin/img/client_img.png" alt="#">
                            <div class="profile_info_iner">
                                <p>Welcome Admin!</p>
                                <h5>Taravor James</h5>
                                <div class="profile_info_details">
                                    <a href="#">My Profile <i class="ti-user"></i></a>
                                    <a href="#">Settings <i class="ti-settings"></i></a>
                                    <a href="#">Log Out <i class="ti-shift-left"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main_content_iner ">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-xl- ">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Table</h4>
                            <div class="box_right d-flex lms_block">
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form active="#">
                                            <div class="search_field">
                                                <input type="text" placeholder="Search content here...">
                                            </div>
                                            <button type="submit"> <i class="ti-search"></i> </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="add_button ms-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#addcategory" class="btn_1">Add New</a>
                                </div>
                            </div>
                        </div>



                        <div class="list-tables QA_table">
                            <table class="tables table">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">KHÁCH HÀNG</th>
                                        <th scope="col">MÃ kHÁCH</th>
                                        <th scope="col">EMAIL</th>
                                        <th scope="col">NỘI DUNG</th>


                                    </tr>
                                </thead>
                                <?php
                                $stt = 1;
                                $select_message = mysqli_query($conn, "SELECT*FROM `message`") or die('query failed');
                                if (mysqli_num_rows($select_message) > 0) {
                                    while ($fetch_message = mysqli_fetch_assoc($select_message)) {
                                ?>

                                        <tbody>
                                            <tr>
                                                <td class="td" style="text-align: center;"><?= $stt++ ?></td>
                                                <td class="td"><?php echo $fetch_message['name'] ?></td>
                                                <td class="td"><?php echo $fetch_message['user_id']; ?></td>
                                                <td class="td"><?php echo $fetch_message['email']; ?></td>
                                                <td class=""> <?php echo $fetch_message['message']; ?></td>
                                                <td>
                                                    <a href="listMessage.php?delete=<?php echo $fetch_message['id']; ?>" class="status_btn" style="background-color: red;">Xóa</a>
                                                    <a href="" class="status_btn" style="background-color: blue;">Chi Tiết</a>
                                                </td>
                                            </tr>
                                        </tbody>

                                <?php
                                    }
                                } else {
                                    echo '<div class="empty">
                   <p> no order placed yet!</p>
                 </div>';
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../index/footer.php' ?>