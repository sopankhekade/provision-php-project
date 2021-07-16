<?php
require_once('config.php');
$ipaddress=$_POST['ipaddress'];
$url=$_POST['url'];
$status="1";
$userid=$_POST['userid'];

  // print_r($propertid);
  // die;
 session_start();
  $id=$_SESSION['user_id'];
  if(isset($_SESSION['user_id'])){
  	 $search_query = mysqli_query($conn, "SELECT * FROM provision WHERE userid = '$userid'");
    $num_row = mysqli_num_rows($search_query);
    if($num_row >= 1){
     $update="UPDATE provision set ipaddress='$ipaddress',url='$url',status='$status'where userid=$userid";
   mysqli_query($conn,$update);
   header("Location:index.php?success_msg=1");
    }else{
 $insert="INSERT INTO provision(ipaddress,url,status,userid)values('$ipaddress','$url','$status','$userid')";
 //die;
  $query=mysqli_query($conn,$insert);
  
}
}else{
  header("Location:login.php?error_msg=1");
}
?>