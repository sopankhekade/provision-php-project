<?php
  require_once('config.php');
  $email = $_POST['email'];
  $password = $_POST['password'];
 $select="SELECT * FROM user_details where email='$email'";
$query=mysqli_query($conn,$select);
$res=mysqli_fetch_assoc($query);

if (mysqli_num_rows($query)>0 and password_verify($password, $res['password'])) {
  session_start();
  $_SESSION['user_id']=$res['id'];
  $_SESSION['user_name']=$res['name'];
  $_SESSION['user_password']=$res['password'];
  header("Location:index.php?success-msg=3");
}else{
    header("location:login.php?login_error=1");
  }
?>