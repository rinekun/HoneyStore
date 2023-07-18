<?php
include_once './config/config.php';
session_start();

if (isset($_POST['submit-btn'])) {
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($conn, $filter_password);

    $select_user = mysqli_query($conn, "SELECT*FROM `users` WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_user) > 0) {
        $row = mysqli_fetch_assoc($select_user);
        if ($row['password'] == $password && $row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:./admin/index.php');
        } else if ($row['password'] == $password && $row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:../HoneyStore/shop/user/index.php');
        } else {
            $message[] = 'incorrect email or password';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../shop//css/style.css">
    <title>Đăng nhập</title>
</head>

<body>

    <section class="form-container">
        <?php
        if (isset($message)) {
            foreach ($message as $message) {
                echo
                '
              <div class="message">
               <span>
                 ' . $message . '
               </span>
               <i class="bx bx-x-circle" onclick="this.parentElement.remove()"></i>
              </div>
            ';
            }
        }
        ?>
        <form method="post" enctype="multipart/form-data">
            <h1>Đăng nhập ngay</h1>
            <div class="input-field">
                <label>Your email</label><br>
                <input type="email" name="email" placeholder="enter your email" require>
            </div>
            <div class="input-field">
                <label>Your password</label><br>
                <input type="password" name="password" placeholder="enter your password" require>
            </div>
            <input type="submit" name="submit-btn" value="login now" class="btn">
            <p>Do not have an account ? <a href="dang_ki.php">Register now </a></p>
        </form>
    </section>
</body>

</html>