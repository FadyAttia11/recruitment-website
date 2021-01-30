<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    if($user_data['user_role'] == 'client') {
      header('Location: index-client.php');
    }

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        //something was posted
        $user_id = $user_data['user_id'];

        $added_money = $_POST['added_money'];
        $current_money = $user_data['balance'];
        $total_money = $current_money + $added_money;

        if(!empty($added_money)) {
            //write to database
            $money_query = "update users set balance = '$total_money' where user_id = '$user_id'";

            $result = mysqli_query($con, $money_query);

            if($result) {
                header('Location: balance.php');
                echo "your money has been transferred";
            }else{
                echo "error transferring money" ;
            }
            
        }else {
            echo "Please enter some valid information!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Recruitment Website</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="icofont-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a>
        <i class="icofont-phone"></i> +1 5589 55488 55
      </div>
      <div class="social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="skype"><i class="icofont-skype"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index-guest.php">LOGO<span>.</span></a></h1>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="index-guest.php">Home</a></li>
          <li><a href="recommended-jobs.php">Recommended Jobs</a></li>
          <li><a href="top-clients.php">Top Clients</a></li>
          <li class="active"><a href="balance.php">Balance</a></li>
          <li><a><?php echo $user_data['user_role']; ?>: <?php echo $user_data['user_name']; ?></a></li>
          <li><a href="logout.php" style="color: red;">Logout</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->


  <section style="margin-top: 80px;">
      <div class="container mt-3 bg-light" style="max-width: 500px;">
          <h2 class="text-center">Add Balance</h2>
          
          <div class="add-money">
            <p class="text-center">your balance is: <?php echo $user_data['balance']; ?>$</p>
            <h4>Enter your payment details:</h4>
            <form method="post" class="mt-3">
                <div class="form-group">
                    <input id="text" type="text" class="form-control" placeholder="Name on card" required>
                </div>
                <div class="form-group">
                    <input id="text" type="number" class="form-control" placeholder="Card number" min="1" required>
                </div>
                <div class="row">
                <div class="col">
                    <input id="text" type="number" class="form-control" placeholder="MM" min="1" max="12" min="1" required>
                </div>
                <div class="col">
                    <input id="text" type="number" class="form-control" placeholder="YY" min="0" max="99" min="1" required>
                </div>
                </div>
                <div class="form-group mt-3">
                    <input id="text" type="number" class="form-control" placeholder="CVV" min="100" max="999" required>
                </div>
                <div class="form-group">
                    <input id="text" type="number" class="form-control" name="added_money" placeholder="Money Amount" min="1" required>
                </div>
                <input id="button" type="submit" class="btn btn-primary" value="Transfer Money">
            </form>
        </div>
      </div>
    </div>
  </section>
  </main>

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>