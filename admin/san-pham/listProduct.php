<?php

ob_start();
// Gộp tệp head.php
include '../index/head.php';

// Gộp tệp nav.php
include '../index/nav.php';
//delete product
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $select_delete_image = mysqli_query($conn, "SELECT image FROM `product` WHERE id='$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    unlink('../../hinh/' . $fetch_delete_image['image']);

    mysqli_query($conn, "DELETE FROM `product` WHERE id='$delete_id'") or die('query failed');
    mysqli_query($conn, "DELETE FROM `cart` WHERE pid='$delete_id'") or die('query failed');
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid='$delete_id'") or die('query failed');

    header('location:listProduct.php');
}

//update product

?>
<section class="main_content dashboard_part">
<?php 
        include '../index/userAdmin.php';
    
    ?>




    <div class="main_content_iner ">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
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
                            <table class="tables table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên Sản Phẩm</th>
                                        <!-- <th scope="col">Loại Hàng</th> -->
                                        <!-- <th scope="col">Giảm Giá</th> -->
                                        <th scope="col">Giá Mới</th>
                                        <!-- <th scope="col">Ngày Đăng</th> -->
                                        <th scope="col">HÌNH ẢNH</th>
                                        <!-- <th scope="col">Đã Bán</th> -->
                                        <th scope="col">HỆ THỐNG</th>


                                    </tr>
                                </thead>


                                <?php
                                //  $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 4;
                                //  $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;

                                //  $offset = ($current_page - 1) * $item_per_page;

                                $select_products = mysqli_query($conn, "SELECT*FROM `product`") or die('query failed');

                                // $totalrecords  = mysqli_query($conn, "SELECT*FROM `product`");
                                //  $totalrecords = $totalrecords->num_rows;
                                //  $totalrecords = ceil($totalrecords / $item_per_page);

                                $stt = 1;
                                if (mysqli_num_rows($select_products) > 0) {
                                    while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                                ?>


                                        <tbody>
                                            <tr>
                                                <td class="td"><?= $stt++ ?></td>
                                                <td class="td"><?php echo $fetch_products['name']; ?></td>
                                                <!-- <td class="td">Điện thoại</td> -->
                                                <td class="td"><?php echo $fetch_products['price']; ?></td>
                                                <!-- <td class="td">9000000</td> -->
                                                <!-- <td class="td">12/02/2023</td>
                                                <td class="td">22</td> -->
                                                <td class="td"><img class="img_admin_sp" src="../../hinh/<?php echo $fetch_products['image']; ?>" alt=""></td>
                                                <td>
                                                    <a href="updetaProduct.php?edit=<?php echo $fetch_products['id'];?>" class="status_btn">Edit</a>
                                                    <a href="listProduct.php?delete=<?php echo $fetch_products['id']; ?>" class="status_btn" style="background-color: red;">Delete</a>
                                                 <a href="../thong-tin/addInformation.php" class="status_btn" style="background-color: blue;">update nội dung</a>
                                                </td>
                                            </tr>
                                        </tbody>

                                <?php
                                    }
                                } else {
                                    echo '<div class="empty">
                                    <p> no product added yet!</p>
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