<?php
ob_start();

include '../index/head.php';

include '../index/nav.php'; ?>


<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo
        '
              <div class="message">
               <span>
                 ' . $message . '
               </span>
               <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
              </div>
            ';
    }
}

// if (isset($_GET['delete'])) {
//     $delete_id = $_GET['delete'];
//     mysqli_query($conn, "DELETE FROM `order` WHERE id='$delete_id'") or die('query failed');
//     $message[] = 'order removed successfully';
//     ob_end_clean();
//     header('location:listOrder.php');
// }
if (isset($_POST['update_hoathanh'])) {
    $id_orders = mysqli_real_escape_string($conn, $_POST['id_order']);
    $update_payment = $_POST['completes'];

    mysqli_query($conn, "UPDATE `order` SET payment_status='$update_payment' WHERE id = $id_orders") or die('query failed');

    header('location:listOrder.php');
}
?>

<style>
    .tables {
        /* border-collapse: collapse; */
        width: 100%;
    }

    .tables>thead {
        width: 100%;
    }

    .tables>thead>tr {
        width: 100%;
    }

    .tables>thead>tr>th {
        text-align: center;
        /* width: 40%; */

    }

    .tables tr {
        width: 500px;
    }

    .tables .td {
        /* border: 1px solid #ddd; */
        text-align: left;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 1000vh;


    }

    .img_admin_sp {
        width: 100%;
    }
</style>

<section class="main_content dashboard_part">
    <?php
    include '../index/userAdmin.php';

    ?>

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
                                        <th scope="col">Tên Sản Phẩm</th>
                                        <th scope="col">Hinh</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Số lượng</th>

                                        <!-- <th scope="col">TỔNG TIỀN</th>
                                        <th scope="col">THANH TOÁN</th>
                                        <th scope="col">ĐỊA CHỈ</th> -->

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $stt = 1;
                                    if (isset($_GET['delail'])) {
                                        $edit_id = $_GET['delail'];
                                        $select_orders = mysqli_query($conn, "SELECT*FROM `order_pay` WHERE id_order='$edit_id'") or die('query failed');
                       
                                        if (mysqli_num_rows($select_orders) > 0) {

                                            while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                                    ?>

                                                <tr>
                                                    <td class="td" style="text-align: center;"><?= $stt++ ?></td>
                                                    <td class="td"><?php echo $fetch_orders['name']; ?></td>
                                                    <td class="td"><img src="../../hinh/<?php echo $fetch_orders['image_product']; ?>" alt="" style="width: 100%;height: 100%;"></td>
                                                    <td class="td"><?php echo $fetch_orders['price']; ?></td>
                                                    <td class="td">222</td>
                                                </tr>

                                                <tr>
                                                    <!--                                                                                                    
                                                <td>
                                                    <a href="" class="status_btn" style="background-color: red;">Hoan thanh</a>
                                                    <a href="" class="status_btn" style="background-color: blue;">Huy</a>
                                                </td> -->
                                                </tr>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="1">Tổng</td>
                                        <td colspan="3">22222</td>
                                        <form action="" method="post">
                                            <td>
                                                <?php
                                                if (isset($_GET['delail'])) {
                                                    $edit_id = $_GET['delail'];
                                                    $select_order = mysqli_query($conn, "SELECT * FROM `order` WHERE id=$edit_id") or die('query failed');
                                                    while ($fetch_order = mysqli_fetch_assoc($select_order)) {
                                                        $order_id = $fetch_order['id'];
                                                     
                                                ?>
                                                        <input type="hidden" name="id_order" value="<?= $order_id; ?>">
                                                        <input type="hidden" name="completes" value="complete">

                                                <?php
                                                    }
                                                }
                                                ?>


                                                <div class="mb-1">
                                                    <input type="submit" name="update_hoathanh" class="btn btn-info" id="inputGroupFile01" style="float:right;background-color: #83ff83;" value="Hoàn thành">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-1">
                                                    <a href="./listOrder.php">quay lại</a>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>


                                </tbody>




                            </table>
                        </div>
                    </div>
                </div>
                <style>
                    /* a{
                        background-color:green;
                    } */
                </style>
            </div>
        </div>
        <?php include '../index/footer.php' ?>