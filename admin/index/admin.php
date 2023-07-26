
<?php

include 'head.php';

// Gộp tệp nav.php
include 'nav.php';
?>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">







<section class="main_content dashboard_part">

    <?php
    include 'userAdmin.php';

    ?>

    <div class="main_content_iner ">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="single_element">
                        <div class="quick_activity">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quick_activity_wrap">


                                        <div class="single_quick_activity">

                                            <?php
                                            $total_complete = 0;
                                            $select_pendings = mysqli_query($conn, "SELECT*FROM `order` WHERE payment_status='complete'") or die('query failed');

                                            while ($fetch_complete = mysqli_fetch_assoc($select_pendings)) {
                                                $total_complete += $fetch_complete['total_price'];
                                            }
                                            ?>
                                            <h4>TỔNG SỐ TIỀN ĐÃ THÀNH CÔNG</h4>
                                            <h3><span class="counter"><?php echo  $total_complete; ?>Đ</span> </h3>
                                            <!-- <p>Saved 25%</p> -->
                                        </div>




                                        <div class="single_quick_activity">

                                            <?php
                                            $total_pendings = 0;
                                            $select_pendings = mysqli_query($conn, "SELECT*FROM `order` WHERE payment_status='pending'") or die('query failed');

                                            while ($fetch_pending = mysqli_fetch_assoc($select_pendings)) {
                                                $total_pendings += $fetch_pending['total_price'];
                                            }
                                            // $tt=$total_complete + $total_pendings;
                                            ?>
                                            <h4>TỔNG SỐ TIỀN ĐANG CHỜ XỬ LÝ</h4>
                                            <h3><span class="counter"><?php echo $total_pendings; ?>Đ</span> </h3>
                                            <!-- <p>Saved 25%</p> -->
                                        </div>









                                        <div class="single_quick_activity">
                                            <?php
                                            $select_orders = mysqli_query($conn, "SELECT*FROM `order`") or die('query failed');
                                            $num_of_orders = mysqli_num_rows($select_orders);
                                            ?>
                                            <h4>TỐNG SỐ ĐẶT HÀNG</h4>  
                                            <h3><span class="counter"><?php echo $num_of_orders; ?></span>Đơn</h3>
                                            <!-- <p>Saved 25%</p> -->
                                        </div>

                                        <div class="single_quick_activity">
                                            <?php
                                            $select_products = mysqli_query($conn, "SELECT*FROM `product`") or die('query failed');
                                            $num_of_products = mysqli_num_rows($select_products);
                                            ?>
                                            <h4>TỔNG SẢN PHẨM</h4>
                                            <h3><span class="counter"><?php echo $num_of_products; ?></span>Sản phẩm</h3>
                                            <!-- <p>Saved 65%</p> -->
                                        </div>

                                        <div class="single_quick_activity">
                                            <?php
                                            $select_users = mysqli_query($conn, "SELECT*FROM `users` WHERE user_type='user'") or die('query failed');
                                            $num_of_users = mysqli_num_rows($select_users);
                                            ?>
                                            <h4>KHÁCH HÀNG</h4>
                                            <h3><span class="counter"><?php echo $num_of_users; ?></span>Khách Hàng</h3>
                                            <!-- <p>Saved 65%</p> -->
                                        </div>

                                        <div class="single_quick_activity">
                                            <?php
                                            $select_admin = mysqli_query($conn, "SELECT*FROM `users` WHERE user_type='admin'") or die('query failed');
                                            $num_of_admin = mysqli_num_rows($select_admin);
                                            ?>
                                            <h4>TỔNG QUẢN TRỊ VIÊN</h4>
                                            <h3><span class="counter"> <?php echo $num_of_admin; ?></span>Người</h3>
                                            <!-- <p>Saved 65%</p> -->
                                        </div>

                                        <div class="single_quick_activity">
                                            <?php
                                            $select_users = mysqli_query($conn, "SELECT*FROM `users`") or die('query failed');
                                            $num_of_users = mysqli_num_rows($select_users);
                                            ?>
                                            <h4>TỔNG SỐ NGƯỜI ĐÃ ĐĂNG KÝ</h4>
                                            <h3><span class="counter"><?php echo $num_of_users; ?></span>Người</h3>
                                            <!-- <p>Saved 65%</p> -->
                                        </div>

                                        <div class="single_quick_activity">
                                            <?php
                                            $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                                            $num_of_message = mysqli_num_rows($select_message);
                                            ?>
                                            <h4>TỔNG TIN NHẮN</h4>
                                            <h3><span class="counter"><?php echo $num_of_admin; ?></span>Tin    </h3>
                                            <!-- <p>Saved 65%</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-lg-12 col-xl-6">
                    <div class="white_box mb_30 min_430">
                        <div class="box_header  box_header_block ">
                            <div class="main-title">
                                <h3 class="mb-0">AP and AR Balance</h3>
                                <span>Avg. $5,309</span>
                            </div>
                            <div class="box_select d-flex">
                                <select class="nice_Select2 mr_5">
                                    <option value="1">Monthly</option>
                                    <option value="1">Monthly</option>
                                </select>
                                <select class="nice_Select2 ">
                                    <option value="1">Last Year</option>
                                    <option value="1">this Year</option>
                                </select>
                            </div>
                        </div>
                        <div id="bar_active"></div>
                    </div>
                </div> -->
                <!-- <div class="col-md-6 col-lg-6 col-xl-3 ">
                    <div class="white_box mb_30 min_430">
                        <div class="box_header  box_header_block">
                            <div class="main-title">
                                <h3 class="mb-0">% of Income Budget</h3>
                            </div>
                        </div>
                        <div id="radial_2"></div>
                        <div class="radial_footer">
                            <div class="radial_footer_inner d-flex justify-content-between">
                                <div class="left_footer">
                                    <h5> <span style="background-color: #EDECFE;"></span> Blance</h5>
                                    <p>-$18,570</p>
                                </div>
                                <div class="left_footer">
                                    <h5> <span style="background-color: #A4A1FB;"></span> Blance</h5>
                                    <p>$31,430</p>
                                </div>
                            </div>
                            <div class="radial_bottom">
                                <p><a href="#">View Full Report</a></p>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="white_box min_430">
                        <div class="box_header  box_header_block">
                            <div class="main-title">
                                <h3 class="mb-0">% of Expenses Budget</h3>
                            </div>
                        </div>
                        <div id="radial_1"></div>
                        <div class="radial_footer">
                            <div class="radial_footer_inner d-flex justify-content-between">
                                <div class="left_footer">
                                    <h5> <span style="background-color: #EDECFE;"></span> Blance</h5>
                                    <p>-$18,570</p>
                                </div>
                                <div class="left_footer">
                                    <h5> <span style="background-color: #A4A1FB;"></span> Blance</h5>
                                    <p>$31,430</p>
                                </div>
                            </div>
                            <div class="radial_bottom">
                                <p><a href="#">View Full Report</a></p>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-lg-12 col-xl-6">
                    <div class="white_box mb_30 min_430">
                        <div class="box_header  box_header_block">
                            <div class="main-title">
                                <h3 class="mb-0">EBIT (Earnings Before Interest & Tax)</h3>
                            </div>
                        </div>
                        <canvas height="200" id="visit-sale-chart"></canvas>
                    </div>
                </div> -->
                <!-- <div class="col-lg-12 col-xl-6">
                    <div class="white_box mb_30 min_430">
                        <div class="box_header  box_header_block align-items- ">
                            <div class="main-title">
                                <h3 class="mb-0">Cost of goods / Services</h3>
                            </div>
                            <div class="title_info">
                                <p>1 Jan 2020 to 31 Dec 2020 <br>
                                <div class="legend_style text-end">
                                    <li> <span style="background-color: #A4A1FB;"></span> Services</li>
                                    <li class="inactive"> <span style="background-color: #A4A1FB;"></span> Avarage
                                    </li>
                                </div>
                                </p>
                            </div>
                        </div>
                        <canvas height="200" id="visit-sale-chart2"></canvas>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3 ">
                    <div class="white_box mb_30 min_430">
                        <div class="box_header  box_header_block">
                            <div class="main-title">
                                <h3 class="mb-0">% of Income Budget</h3>
                            </div>
                        </div>
                        <div id="radial_2"></div>
                        <div class="radial_footer">
                            <div class="radial_footer_inner d-flex justify-content-between">
                                <div class="left_footer">
                                    <h5> <span style="background-color: #EDECFE;"></span> Blance</h5>
                                    <p>-$18,570</p>
                                </div>
                                <div class="left_footer">
                                    <h5> <span style="background-color: #A4A1FB;"></span> Blance</h5>
                                    <p>$31,430</p>
                                </div>
                            </div>
                            <div class="radial_bottom">
                                <p><a href="#">View Full Report</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="white_box min_430">
                        <div class="box_header  box_header_block">
                            <div class="main-title">
                                <h3 class="mb-0">% of Expenses Budget</h3>
                            </div>
                        </div>
                        <div id="radial_1"></div>
                        <div class="radial_footer">
                            <div class="radial_footer_inner d-flex justify-content-between">
                                <div class="left_footer">
                                    <h5> <span style="background-color: #EDECFE;"></span> Blance</h5>
                                    <p>-$18,570</p>
                                </div>
                                <div class="left_footer">
                                    <h5> <span style="background-color: #A4A1FB;"></span> Blance</h5>
                                    <p>$31,430</p>
                                </div>
                            </div>
                            <div class="radial_bottom">
                                <p><a href="#">View Full Report</a></p>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-lg-6 col-xl-3">
                    <div class="white_box mb_30 min_400">
                        <div class="box_header ">
                            <div class="main-title">
                                <h3 class="mb-0">Disputed vs Overdue Invoices</h3>
                            </div>
                        </div>
                        <canvas height="220px" id="doughutChart"></canvas>
                        <div class="legend_style mt_10px ">
                            <li class="d-block"> <span style="background-color: #DF67C1;"></span> Disputed Invoices
                            </li>
                            <li class="d-block"> <span style="background-color: #6AE0BD;"></span> Avarage</li>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-lg-6 col-xl-6">
                    <div class="white_box mb_30 min_400 ">
                        <div class="box_header  box_header_block">
                            <div class="main-title">
                                <h3 class="mb-0">Disputed Invoices</h3>
                            </div>
                            <div class="legend_style mt-10">
                                <li> <span></span> Disputed Invoices</li>
                                <li class="inactive"> <span></span> Avarage</li>
                            </div>
                        </div>
                        <div class="title_btn">
                            <ul>
                                <li><a class="active" href="#">All time</a></li>
                                <li><a href="#">This year</a></li>
                                <li><a href="#">This week</a></li>
                                <li><a href="#">Today</a></li>
                            </ul>
                        </div>
                        <canvas height="120px" id="sales-chart"></canvas>
                    </div>
                </div> -->
                <!-- <div class="col-lg-6 col-xl-3">
                    <div class="white_box mb_30 min_400">
                        <div class="box_header  box_header_block">
                            <div class="main-title">
                                <h3 class="mb-0">Disputed vs Overdue Invoices</h3>
                            </div>
                        </div>
                        <canvas height="220px" id="doughutChart2"></canvas>
                        <div class="legend_style legend_style_grid mt_10px">
                            <li class="d-block"> <span style="background-color: #FF7B36;"></span> 30 Days</li>
                            <li class="d-block"> <span style="background-color: #E8205E;"></span> 60 Days</li>
                            <li class="d-block"> <span style="background-color: #3B76EF"></span> 90 Days</li>
                            <li class="d-block"> <span style="background-color:#00BFBF;"></span> 90+Days</li>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-lg-8">
                    <div class="white_box min_400">
                        <div class="box_header  box_header_block">
                            <div class="main-title">
                                <h3 class="mb-0">EBIT (Earnings Before Interest & Tax)</h3>
                            </div>
                            <div class="title_info">
                                <p>1 Jan 2020 to 31 Dec 2020</p>
                            </div>
                        </div>
                        <div id="area_active"></div>
                    </div>
                </div> -->
                <!-- <div class="col-lg-4">
                    <div class="white_box mb_30 min_400">
                        <div class="box_header ">
                            <div class="main-title">
                                <h3 class="mb-0">Inventory Turnover</h3>
                            </div>
                        </div>
                        <div id="stackbar_active"></div>
                    </div>
                </div> -->

                <div class="col-lg-12 col-xl-12">
                    <div class="white_box mb_30 min_430">
                        <div class="box_header  box_header_block align-items- ">


                            <div id="chart" style="height: 300px;" class="col-lg-12"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>





    <?php
    include 'footer.php';
    ?>


    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>
        var data = [];
        <?php
        

       

       $query = "SELECT DATE_FORMAT(dates, '%Y-%m') AS dates, SUM(quantity) AS quantity FROM `order_pay` GROUP BY dates ";

       
    // $query = "SELECT COUNT(quantity) as quantity FROM `order_pay` WHERE MONTH(dates) = MONTH(CURRENT_DATE())";
  
    $result = mysqli_query($conn, $query);

   
        if ($result) {
            // Tạo mảng để lưu trữ dữ liệu
            $data = [];

            // Lặp qua từng hàng kết quả
            while ($row = mysqli_fetch_assoc($result)) {
                
                    $data[] = $row;
        

                
            }

            // In số lượng sản phẩm bán ra theo từng tháng
            foreach ($data as $row) {

                echo "data.push(
                    { year: '" . $row['dates'] . "', quantity: " . $row['quantity'] . " },
            );";
        
            }
            // Giải phóng bộ nhớ đệm
            // mysqli_free_result($result);
        }
        $data = array_values(array_unique($data, SORT_REGULAR));

        // Đóng kết nối cơ sở dữ liệu
        // mysqli_close($conn);
        

        ?>
        <?php

        ?>

        new Morris.Bar({
            element: 'chart',
            data: data,
            xkey: 'year',
            ykeys: ['quantity'],
            labels: ['Số lượng bán ra']
        });
    </script>