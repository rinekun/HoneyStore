<?php
include '../../config/config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$admin_id = $_SESSION['admin_name'];
if (!isset($admin_id)) {
    header('location:./dang_nhap.php');
}
if (isset($_POST['logouts'])) {
    session_destroy();
    header('location:../../dang_nhap.php');
}

?>
</style>
<nav class="sidebar">
    <div class="logo d-flex justify-content-between">
        <a href="../admin.php"><img src="../../admin/asset/img/logo.png" alt></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">

        <!-- san pham -->
        <li class>

            <a class="has-arrow" href="#" aria-expanded="false">
                <img src="../../admin/asset/img/menu-icon/2.svg" alt>
                <span>Quản lý sản phẩm</span>
            </a>
            <ul>
                <li><a href="#">Loại sản Phẩm </a>
                    <ul>
                        <li><a href="../../admin/loai/addType.php">Thêm Loại</a></li>
                        <li><a href="../../admin/loai/listType.php">Danh Sach Loại</a></li>
                    </ul>
                </li>
                <li><a href="#">Sản phẩm</a>
                    <ul>
                        <li><a href="../../admin/san-pham/addProduct.php">Thêm sản phẩm</a></li>
                        <li><a href="../../admin/san-pham/listProduct.php">Danh Sách Sản Phẩm</a></li>

                        <!-- <li><a href="datepicker.html">Date Picker</a></li> -->
                    </ul>
                </li>
                <li><a href="#">Nội Dung</a>
                    <ul>
                        <li><a href="../../admin/thong-tin/addInformation.php">Thêm chi tiết sản phẩm</a></li>
                        <li><a href="../../admin/thong-tin/listInformation.php">Danh sách nội dung</a></li>
                    </ul>
                </li>

                <li><a href="#">Đặt Hàng</a>
                    <ul>
                        <li><a href="../../admin/order/listOrder.php">Đặt hàng</a></li>
                        <!-- <li><a href="../../admin/order/detail.php">Đặt hàng</a></li> -->

                    </ul>
                </li>
                <li><a href="#">Tài Khoản</a>
                    <ul>
                        <li><a href="../../admin/tai-khoang/addLogin.php">Thêm Tài Khoản</a></li>
                        <li><a href="../../admin/tai-khoang/listLogin.php">Danh Sách Tài Khoản</a></li>

                        <!-- <li><a href="datepicker.html">Date Picker</a></li> -->
                    </ul>
                </li>

                <!-- 
                <li><a href="#" >Hộp Thư</a>
                    <ul>
                        <li><a href="../hop-thu/listMessage.php">Hộp Thư</a></li>                 
                    </ul>
                </li> -->

            </ul>
        </li>




        <li class>
            <a class="has-arrow" href="#" aria-expanded="false">
                <img src="../../admin/asset/img/menu-icon/mailbox.svg" alt>
                <span>Quản lý hộp thư</span>
            </a>
            <ul>
                <li><a href="#">Liên Hệ</a>
                    <ul>
                        <li><a href="../../admin/hop-thu/listMessage.php">Hộp Thư</a></li>
                    </ul>
                </li>

                <li><a href="#">Khiếu nại</a>
                    <ul>
                        <li><a href="">Hộp Thư</a></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</nav>