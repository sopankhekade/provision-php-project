<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logoHR.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet"> -->

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  
</head>
<style>
  .error {color: #FF0001;}  
</style>
<body>
<?php
  require_once('config.php');
  
  $errors = array();
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
  if(preg_match("/\S+/", $_POST['name']) === 0){
    $errors['name'] = "*First Name is required.";
  }
  if(preg_match("/\S+/", $_POST['supportname']) === 0){
    $errors['supportname'] = "*Corporate Name is required.";
  }
  if(preg_match("/\S+/", $_POST['username']) === 0){
    $errors['username'] = "* username is required.";
  }
  if(preg_match("/.+@.+\..+/", $_POST['email']) === 0){
    $errors['email'] = "* Not a valid e-mail address.";
  }
   if(preg_match("/^[0-9]{10}+$/", $_POST['phone']) === 0){
    $errors['phone'] = "* Mobile no must contain 10 digits.";
  }
  if(preg_match("/.{8,}/", $_POST['password']) === 0){
    $errors['password'] = "* Password Must Contain at least 8 Chanacters.";
  }
  if(strcmp($_POST['password'], $_POST['cpassword'])){
    $errors['cpassword'] = "* Password do not much.";
  }
  
  if(count($errors) === 0){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $support = mysqli_real_escape_string($conn, $_POST['support']);
    $supportname = mysqli_real_escape_string($conn, $_POST['supportname']);

  $password=$_POST['password'];
  $hash = password_hash( $password,PASSWORD_DEFAULT);
    
    $search_query = mysqli_query($conn, "SELECT * FROM user_details WHERE email = '$email'");
    $num_row = mysqli_num_rows($search_query);
    if($num_row >= 1){
      $errors['email'] = "Email address is unavailable.";
    }else{
 $sql = "INSERT INTO user_details(`name`, `email`, `phone`,`username`,`password`,`support`, `supportname`) VALUES ('$name', '$email', '$phone','$username','$hash','$support','$supportname')";
      $query = mysqli_query($conn, $sql);
      $_POST['name'] = '';
      $_POST['email'] = '';
      $_POST['phone'] = '';
      $search_query1 = mysqli_query($conn, "SELECT * FROM user_details WHERE email = '$email'");
      $result=mysqli_fetch_assoc($search_query1);
      $uid=$result['id'];
      $select = "INSERT INTO provision(`status`,`userid`) VALUES ('1','$uid')";
      $query = mysqli_query($conn, $select);
      header("location:login.php?success_msg=1");
    }
  }
  }
?>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <!-- <h1 class="logo mr-auto"><a href="index.html">Arsha</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="index.php" class="logo mr-auto">
          <img src="assets/img/logoHR.png" alt="" class="img-fluid"></a>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="login.php">Login</a></li>
          <!-- <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#team">Team</a></li>
          <li class="drop-down"><a href="">Drop Down</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="drop-down"><a href="#">Deep Drop Down</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li> -->

        </ul>
      </nav><!-- .nav-menu -->

      <!-- <a href="#about" class="get-started-btn scrollto">Get Started</a> -->

    </div>
  </header><!-- End Header -->
<section >
    <div class="wrapper fadeInDown" >
        <div id="formContent">
          <!-- Tabs Titles -->
          <h2 class="active"> Sign Up </h2>
      
          <!-- Icon -->
          <!-- <div class="fadeIn first">
            <img src="assets/img/logoHR.png" id="icon" alt="User Icon" />
          </div> -->
      
          <!-- Login Form -->
          <form name="myForm p-3" action="registration.php" method="POST">
            <div class="row">
                <div class="col-sm-12 form-group">
                    <input type="text" id="name" name="name" placeholder=" Name*" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>"><br>
                    <span class="error"><?php if(isset($errors['name'])){echo "<span>" .$errors['name']. "</span>"; } ?> </span> 
               </div>
               <div class="col-sm-12 form-group">
                    <input type="email"  id="email" name="email"  placeholder=" Email*" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>"><br>
                    <span class="error"><?php if(isset($errors['email'])){echo "<span>" .$errors['email']. "</span>"; } ?> </span> 
              </div>
              <div class="col-sm-12 form-group">
                <input type="number"  id="number" name="phone" placeholder=" Phone Number"
                value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>"><br>
                <span class="error"><?php if(isset($errors['phone'])){echo "<span>" .$errors['phone']. "</span>"; } ?>  </span> 
             </div>
             <div class="col-sm-12 form-group">
                <input type="text" id="username" name="username" placeholder=" Username (email)*"
                value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>"><br>
                <span class="error"><?php if(isset($errors['username'])){echo "<span>" .$errors['username']. "</span>"; } ?>  </span> 
             </div>
              <div class="col-sm-12 form-group">
                <input type="password" name="password"  id="exampleInputPassword1" placeholder="Password*"><br>
                <span class="error"><?php if(isset($errors['password'])){echo "<span>" .$errors['password']. "</span>"; } ?>  </span> 
              </div>
              <div class="col-sm-12 form-group">
                <input type="password" name="cpassword"  id="ConfirmPassword" placeholder="Confirm Password*"><br>
                <span class="error"><?php if(isset($errors['cpassword'])){echo "<span>" .$errors['cpassword']. "</span>"; } ?>  </span> 
              </div>
              <div class="col-sm-12">
    <select type="select" onchange="yesnoCheck(this);" name="support" id="support" class="fadeIn third">
            <option value="selected">Select the name</option>
            <option value="Individual">Individual</option>
            <option value="Corporate">Corporate</option>
                </select>
            </div>
            <div class="col-sm-12 form-group" id="adc" style="display: none;"> 
            <input type="text" id="Individual" name="supportname" placeholder="Individual *" 
            value="<?php if(isset($_POST['supportname'])){echo $_POST['supportname'];} ?>"/>
            <span class="error text-center"><?php if(isset($errors['supportname'])){echo "<span>" .$errors['supportname']. "</span>"; } ?> </span> 
            </div>

            <div class="col-sm-12 form-group" id="pc" style="display: none;">
            <input type="text" id="Corporate" name="supportname" placeholder="Corporate Name" 
            value="<?php if(isset($_POST['supportname'])){echo $_POST['supportname'];} ?>"/>
            <span class="error text-center"><?php if(isset($errors['supportname'])){echo "<span>" .$errors['supportname']. "</span>"; } ?> </span> 
            </div>
            </div>
            <input type="submit" name="submit" id="submit" class="fadeIn fourth" value="Sign Up">
            
          </form>
      
          <div id="formFooter">
            <a class="underlineHover" href="login.php">You Have Already Account?</a>
          </div>
      
        </div>
      </div>
</section>
<script>
function yesnoCheck(that) 
{
    if (that.value == "Individual") 
    {
        document.getElementById("adc").style.display = "block";
    }
    else
    {
        document.getElementById("adc").style.display = "none";
    }
    if (that.value == "Corporate")
    {
        document.getElementById("pc").style.display = "block";
    }
    else
    {
        document.getElementById("pc").style.display = "none";
    }
}
    </script>
  </body>
  </html>