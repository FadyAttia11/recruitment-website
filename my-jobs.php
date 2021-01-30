<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $user_name = $user_data['user_name'];

    $my_jobs_query = "select * from jobs where client_name = '$user_name'";
    $my_jobs = mysqli_query($con, $my_jobs_query);

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
          <li class="active"><a href="my-jobs.php">My Jobs</a></li>
          <li><a href="new-job.php">Add New Job</a></li>
          <li><a href="top-freelancers.php">Top Freelancers</a></li>
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
          <h2 class="text-center">My Jobs</h2>
          <?php
              print "
              <table class='table table-striped'>
              <tr>
              <td>Title</td> 
              <td>Work Type</td> 
              <td>Experience Level</td> 
              <td>Budget</td> 
              </tr>";
              while($row = mysqli_fetch_array($my_jobs))
              {
                  print "<tr>"; 
                  print "<td><a href='job.php?job_id=". $row['id'] ."'>" . $row['title'] . "</a></td>"; 
                  print "<td>" . $row['work_type'] . "</td>"; 
                  print "<td>" . $row['experience'] . "</td>"; 
                  print "<td>" . $row['budget'] . "</td>"; 
                  print "</tr>";
              } 
              print "</table>";
          ?>
      </div>
      <a href="new-job.php" type="button" class="btn btn-primary">Add New Job</a>
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