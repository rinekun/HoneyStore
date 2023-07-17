<?php
include_once '../config/config.php';
// session_start();
if (isset($_POST['logout-btn'])) {
    session_destroy();
    header('location:../dang_nhap.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href="../index.php" class="logo">
               <img src="../hinh/logo.png" alt="" width="30%">
            </a>

            <nav class="navbar">
             <a href="admin_panel.php">Home</a>
             <a href="admin_product.php">Product</a>
             <a href="admin_order.php">Order</a>
             <a href="admin_user.php">Users</a>
             <a href="admin_message.php">Message</a>
            </nav>

            <div class="icons">
                <i class="bi bi-person" id="user-btn"></i>
                <i class="bi bi-list" id="menu-btn"></i>
            </div>

            <div class="user-box">
              <p>Username : <span> <?php echo $_SESSION['admin_name']; ?></span></p>
              <p>Email : <span> <?php echo $_SESSION['admin_email']; ?></span></p>
              <form method="post">
                <button type="submit" class="logout-btn" name="logout-btn">
                    logout
                </button>
              </form>
            </div>
        </div>
        
    </header>

    <div class="banner">
      <div class="detail">
        <h1>Admin dashboard</h1>
        <p>Trang điều khiển dành cho quản trị viên</p>
      </div>
    </div>
    <div class="line">
      
    </div>
</body>
</html>