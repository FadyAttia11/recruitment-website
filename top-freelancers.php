<?php 
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $user_name = $user_data['user_name'];

    $my_jobs_query = "select * from jobs where client_name = '$user_name'";
    $my_jobs = mysqli_query($con, $my_jobs_query);
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
    <title>Client Home</title>
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
        <a class="nav-link" href="index-client.php">My Jobs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="top-freelancers.php">Top Freelancers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link ml-auto"><?php echo $user_data['user_role']; ?>: <?php echo $user_data['user_name']; ?></a>
      </li>
    </ul>
    <a href="new-job.php" class="btn btn-info">Add New Job</a>
    <a class="btn btn-danger ml-4" href="logout.php"><span>Logout</span></a>
  </div>
  </div>
</nav>

<div class="container mt-3">
      <div class="mt-5 bg-light">
          <h2 class="text-center">Top Freelancers</h2>
      </div>
</div>
</body>
</html>