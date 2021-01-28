<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    if($user_data) {
      if($user_data['user_role'] == 'client') {
        header('Location: index-client.php');
      } else if ($user_data['user_role'] == 'freelancer') {
          header('Location: index-freelancer.php');
      } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Recruitment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./bootstrap-4.6.0-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./styles.css">
  <script src="./bootstrap-4.6.0-dist/js/jquery-3.5.1.js"></script>
  <script src="./bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
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
  
<div class="container pt-5">
  <div class="row d-flex h-100">
    <div class="col-sm-6 justify-content-center align-self-center">
      <h1>The Place where talent <br> meets innovative ideas</h1>
      <p>Find the most talented people to do your work <br> or be the talented one yourself</p>
      <a href="signup.php" type="button" class="btn btn-primary" >Hire Talents</a>
      <a href="signup.php" type="button" class="btn btn-primary">Find Jobs</a>
    </div>
    <div class="col-sm-6">
      <img src="./img/hero.png" class="img-fluid" alt="hero image">
    </div>
  </div>
</div>

</body>
</html>
