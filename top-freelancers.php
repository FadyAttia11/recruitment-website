<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $user_name = $user_data['user_name'];
    $profile_pic = $user_data['profile_pic'];

    $all_freelancers_query = "select * from users where user_role = 'freelancer'";
    $all_freelancers = mysqli_query($con, $all_freelancers_query);

    if($user_data['user_role'] == 'freelancer') {
      header('Location: index-freelancer.php');
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
          <li><a href="my-jobs.php">My Jobs</a></li>
          <li><a href="new-job.php">Add New Job</a></li>
          <li class="active"><a href="top-freelancers.php">Top Freelancers</a></li>
          <li><a href="balance.php">Balance</a></li>
          <li><a><?php echo $user_data['user_role']; ?>: <?php echo $user_data['user_name']; ?></a></li>
          <li><a href="logout.php" style="color: red;">Logout</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->


  <section style="margin-top: 80px;">
    <div class="container mt-5">
      <div class="mt-3 bg-light">
        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST") {
              $freelancer_name = rtrim($_POST['user_name'], "/");
              $freelancer_phone = rtrim($_POST['phone'], "/");
              $freelancer_email = rtrim($_POST['email'], "/");
              $money_after = $user_data['balance'] - 1;
              
              if($user_data['balance'] >= 1) {

                $client_money_query = "update users set balance = '$money_after' where user_name = '$user_name'";
                $client_result = mysqli_query($con, $client_money_query);

                if($client_result) {
                  echo "<h2 class='text-center'>Freelancer Contact Info: </h2>";
                  echo "<h4>Freelancer Name: " . $freelancer_name . "</h4>";
                  echo "<h4>Phone Number: 0" . $freelancer_phone . "</h4>";
                  echo "<h4>Email Address: ", $freelancer_email, "</h4>";
                } else {
                    echo "error submitting question";
                }

              }else {
                  echo "you don't have enough money to show contact info!";
              }
              
            }
          ?>
      </div>
      <div class="mt-3 bg-light">
          <h2 class="text-center">Top Freelancers</h2>
          <p class="text-center">(Showing Contact Info costs you 1$)</p>

          <div class="row">
            <?php
              while($row = mysqli_fetch_array($all_freelancers)) {
                print "<div class='card col-5 mx-auto my-3' style='width:400px'>";
                print "<div class='card-body'>";
                print "<img class='card-img-top' src='uploads/". $row['profile_pic'] ."' alt='Profile Picture' style='width:100%'>";
                print "<h4 class='card-title mt-3'>". $row['user_name'] ."</h4>";
                print "<p class='card-text'>Type of Work: ". $row['work_type'] ."</p>";
                print "<td>
                        <form method='post'>
                            <input type='hidden' name='user_name' value=" . $row['user_name'] . "/>
                            <input type='hidden' name='phone' value=" . $row['phone'] . "/>
                            <input type='hidden' name='email' value=" . $row['email'] . "/>
                            <input id='button' type='submit' class='btn btn-primary' value='Show Contact Info'><br><br>
                        </form>
                    </td>";
                print "</div>";
                print "</div>";
              }
            ?>
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