<?php
session_start();

    include("connection.php");
    include("functions.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles.css">
    <script src="./bootstrap-4.6.0-dist/js/jquery-3.5.1.js"></script>
    <script src="./bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <title>Signup</title>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <div class="container">
  <!-- Brand -->
  <a class="navbar-brand" href="index-guest.php">LOGO</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="signup.php">Hire Talents</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signup.php">Find jobs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
    </ul>
    <form class="form-inline" method="post">
      <input class="form-control mr-sm-2" id="email" type="email" placeholder="Email" name="email" required>
      <input class="form-control mr-sm-2" type="password" placeholder="Password" name="password" required>
      <button class="btn btn-success" type="submit">Login</button>
      <?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            //something was posted
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            $salt1 = "qm&h*";
            $salt2 = "pg!@";
            $hashed_password = hash('ripemd128', "$salt1$password$salt2"); //hashing the plain text password
    
            if(!empty($email) && !empty($password)) {
                //read from database
                $query = "select * from users where email = '$email' limit 1";
    
                $result = mysqli_query($con, $query);
    
                if($result) {
                    if($result && mysqli_num_rows($result) > 0) {
                        $user_data = mysqli_fetch_assoc($result);
                        if($user_data['password'] === $hashed_password) {
                            $_SESSION['user_id'] = $user_data['user_id'];
                            if($user_data['user_role'] === 'freelancer') {
                                header('Location: index-freelancer.php');
                            } else if($user_data['user_role'] === 'client') {
                                header('Location: index-client.php');
                            } else if($user_data['user_role'] === 'admin') {
                                header('Location: index-admin.php');
                            }
                            die;
                        }
                    }
                }
    
                echo "Wrong username or password!";
            }else {
                echo "Please enter some valid information!";
            }
        }
        ?>
  </form>
  </div>
  </div>
</nav>

    <div class="container mt-3">
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