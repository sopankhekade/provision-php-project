<?php
session_start();

$id=$_SESSION['user_id'];
    //print_r($id);
   $ip_address = gethostbyname("www.sololearn.com");  
   require_once('config.php');
   $select="SELECT * FROM user_details where id=$id";
   $query=mysqli_query($conn, $select);
   $select1="SELECT * FROM provision where userid=$id";
   $query1=mysqli_query($conn, $select1);
   $res=mysqli_fetch_assoc($query1);
  // print_r($res);
   $sel="SELECT * FROM provision where userid=$id";
   //die;
   $que=mysqli_query($conn, $sel);
   $result=mysqli_fetch_assoc($que);
   // $data=$res['url'];
    if(isset($_SESSION['user_id'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
<!-- <meta http-equiv="Content-Security-Policy" content="default-src https:"> -->
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" 
type="text/javascript">

</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
</script>

<style>
  .card{
    margin-top: 20px;
  }

  </style>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <!-- <h1 class="logo mr-auto"><a href="index.html">Arsha</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="index.php" class="logo mr-auto">
        <img src="assets/img/logoHR.png" alt="" width="full" class="img-fluid"></a>
        <?php 
        if($result['status']==1){ ?>
      <button id="myDIV" class="get-started-btn scrollto" data-toggle="modal"
       data-target="#exampleModal" >Add Camera</button>
     <?php } ?>
      <nav class="nav-menu d-none d-lg-block">
        <ul>
            <?php
            if(isset($_SESSION['user_id'])){?>
            <li class="drop-down"><a href=""><?php echo ($_SESSION['user_name']) ?></a>
                <ul>
                    <li><a href="./logout.php">LOGOUT</a></li>
                </ul>
            </li>
        <?php } ?>
        <?php
         if(!isset($_SESSION['user_id'])){?>
            <li><a href="login.php"><i class="fa fa-user" aria-hidden="true"></i> Login</a></li>
            <?php } ?>
        </ul>
      </nav><!-- .nav-menu -->
      <!-- <a href="#addCamera" class="get-started-btn scrollto">Add Camera</a> -->
      
    </div>
  </header><!-- End Header -->

  <section>
    <script>

      
      </script>
    <div id="myDIV" class="container-fluid">
      <div class="row">
  <div class="col-sm-4 ">
    <div class="card">
<iframe id="myframe" width="1480" height="650" src="<?php echo $res['url'] ?>" frameborder="0" allowfullscreen></iframe>
</div>

  </div>
  </div>
    </div>
    
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pro Vision</h5>
        <a href="#" onclick="window.location.reload();return false;" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <input type="hidden" id="userid" name="userid" value="<?php echo $id ?>">
            <input type="hidden" id="ipaddress" class="form-control" name="ipaddress" required="" value="<?php echo $ip_address ?>">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Camera Url:</label>
            <input type="text" id="url" class="form-control" name="url" id="recipient-name" required="">
          </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" onclick="return myFunction()" value="Execute">
      </div>
      </form>
    </div>
  </div>
</div>
  </section>
    <script type="text/javascript">
      // function myFunction() {
//   
// }
    function myFunction(){
    var ipaddress=document.getElementById('ipaddress').value;
    var userid=document.getElementById('userid').value;
    var url=document.getElementById('url').value;
    $.ajax({
            type:"post",
            url:"provision_check.php",
            data: 
            {  
               'ipaddress' :ipaddress,
               'userid' :userid,
               'url' :url
            },
            cache:false,
            success: function (html) 
            {
               alert('your Data has been run please close this popup!!');
               $('#msg').html(html);
            }
            });
            return false;
     }

    </script>

  <!-- ======= Footer ======= -->
  <!-- <footer id="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Arsha</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div> 

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span></span></strong>. All Rights Reserved
      </div>
     
    </div>
  </footer> -->
  <!-- End Footer -->

  <!-- <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div> -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <!-- <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script> -->

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
<?php }else{
    header("location:login.php?error_login=1");
  }
  ?>