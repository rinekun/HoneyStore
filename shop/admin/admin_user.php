<?php
 include_once '../config/config.php';
 session_start();
 $admin_id=$_SESSION['admin_name'];
 if(!isset($admin_id))
 {
    header('location:./dang_nhap.php');
 }
 if(isset($_POST['logout']))
 {
   session_destroy();
   header('location:./dang_nhap.php');
 }
 //delete product
 if(isset($_GET['delete']))
 {
   $delete_id=$_GET['delete'];
   mysqli_query($conn,"DELETE FROM `users` WHERE id='$delete_id'") or die ('query failed');
   $message[]='user removed successfully';
   header('location:admin_user.php');
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>Bảng điều khiển admin</title>
</head>
<style>
.show-products,
.message-container
{
    position: relative;
    background: var(--orange);
    margin-top: -3.5rem;
}
.show-products .box-container
{
    grid-template-columns: repeat(auto-fit,minmax(20rem,1fr));
}
.box-container .box img
{
    width: 100%;
    height: 80%;
    margin-bottom: 1rem;
}
.box-container .box h4
{
   font-size: 20px;
   color: #FF0060;
}
.box-container .box p
{
   font-size: 20px;
   color: #0079FF;
}
.message-container .box-container .box p
{
   font-size: 16px;
   padding-top: 10px;
   color: black;
}

.edit,
.delete
{
    color: black;
    font-weight: 700;
    background:orange;
    padding: .5rem 1.5rem;
    text-transform: capitalize;
    line-height:2;
}
.update-container
{
    position: fixed;
    top:0;
    left: 0;
    right:0;
    height: 100%;
    width: 100%;
    overflow-y: auto;
    background: var(--orange);
    z-index: 1100;
    padding: 2rem;
    align-items: center;
    justify-content: center;
    display: none;
}
.update-container form
{
    box-shadow: var(--box-shadow);
    width: 50%;
    background: #fff;
    padding: 1rem;
    margin: 2rem auto;
    text-align: center;
}

.update-container .edit,
.update-container .btn
{
  width: 40%;
  cursor: pointer;
}
.update-container form img
{
 width: 60%;
}
.message-container .title
{
  text-transform: uppercase;
  padding-top: 3rem;
}
</style>
<body>
  <?php
  include_once 'admin_header.php';
  ?>
  <?php
  if(isset($message))
     {
        foreach ($message as $message)
        {
            echo
            '
              <div class="message">
               <span>
                 '.$message.'
               </span>
               <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
              </div>
            ';
        }
     }
  ?>
  <div class="line2"></div>
  <div class="message-container">
   <h1 class="title">
      total user account
   </h1>

   <div class="box-container">
     <?php
      $select_users=mysqli_query($conn,"SELECT*FROM `users`") or die('query failed');
      if(mysqli_num_rows($select_users)>0)
      {
         while($fetch_users=mysqli_fetch_assoc($select_users))
         {
    ?>
            <div class="box">
               <p>user id: <span><?php echo $fetch_users['id']?></span></p>
               <p>name: <span><?php echo $fetch_users['name']?></span></p>
               <p>email: <span><?php echo $fetch_users['email']?></span></p>
               <p>user type: 
                    <span style="color: <?php if($fetch_users['user_type']=='admin') { echo 'orange'; } ?>">
                      <?php echo $fetch_users['user_type']; ?>
                  </span>
               </p>
               <a href="admin_user.php?delete=<?php echo $fetch_users['id'];?>" onclick="return confirm('deleted this message')" class="delete">Delete</a>
            </div>
   <?php   
         }
      }
      else
      {
          echo '<div class="empty">
                   <p> no product added yet!</p>
                 </div>';
      }
     ?>
   </div>
  </div>
  <script src="../js/script.js"></script>
</body>
</html>