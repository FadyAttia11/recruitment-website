<?php
session_start();

    include("connection.php");
    include("functions.php");
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
          <li><a href="index-guest.php#about">About</a></li>
          <li><a href="index-guest.php#services">Services</a></li>
          <li><a href="index-guest.php#contact">Contact</a></li>
          <li><a href="signup.php">Register</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

    <section style="margin-top: 100px;">
    <div class="container mt-3" style="max-width: 700px;">
        <h3>SIGN UP</h3>
        <form method="post" class="needs-validation" novalidate>
        <div class="row mb-3">
        <div class="col">
            <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname" required>
        </div>
        <div class="col">
            <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname" required>
        </div>
        </div>
        <div class="row mb-3">
        <div class="col">
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
        </div>
        <div class="col">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
        </div>
        </div>
        <div class="row mb-3">
        <div class="col">
            <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
        </div>
        <div class="col">
            <input type="number" class="form-control" placeholder="Phone Number" name="phone" required>
        </div>
        </div>
        <div class="form-group">
            <label for="worktype">What type of work?</label>
            <select class="form-control" id="worktype" name="worktype">
                <option>Development & IT</option>
                <option>Design & Creative</option>
                <option>Sales & Marketing</option>
                <option>Writing & Translation</option>
                <option>Admin & Customer Support</option>
                <option>Finance & Accounting</option>
            </select> 
        </div>
        <div class="form-check mb-1">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="user_role" value="client">Looking for hiring talents
            </label>
        </div>
        <div class="form-check mb-3">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="user_role" value="freelancer">Looking for finding jobs
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
        already have an account? <a href="login.php">login</a>
        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                //something was posted
                $first_name = $_POST['firstname'];
                $last_name = $_POST['lastname'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $user_name = $_POST['username'];
                $phone = $_POST['phone'];
                $work_type = $_POST['worktype'];
                $user_role = $_POST['user_role'];;

                $salt1 = "qm&h*";
                $salt2 = "pg!@";
                $hashed_password = hash('ripemd128', "$salt1$password$salt2"); //hashing the plain text password
                
                if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($hashed_password) && !empty($user_name) && !empty($phone) && !empty($work_type) && !empty($user_role)) {
                    //save to database
                    $user_id = random_num(20);
                    $query = "insert into users (user_id,firstname,lastname,email,password,user_name,phone,work_type,user_role) values ('$user_id','$first_name','$last_name','$email', '$hashed_password','$user_name','$phone','$work_type','$user_role')";

                    $result = mysqli_query($con, $query);
                    if($result) {
                    $_SESSION['user_id'] = $user_id;
                    if($user_role === 'client') {
                        header('Location: client-home.php');
                    } else if($user_role === 'freelancer') {
                        header('Location: freelancer-home.php');
                    }
                    header('Location: client-home.php');
                    }else {
                        echo "username is already taken!";
                    }
                    die;
                }else {
                    echo "Please enter some valid information";
                }
            }
        ?>
        </form>
    </div>
    </section>

    <script>
        // Disable form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                }, false);
            });
            }, false);
        })();
    </script>
</body>
</html>