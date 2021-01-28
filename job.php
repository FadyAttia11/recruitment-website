<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $user_name = $user_data['user_name'];

    $job_id = $_GET['job_id'];

    $single_job_query = "select * from jobs where id = '$job_id'";
    $result = mysqli_query($con, $single_job_query);
    $single_job = mysqli_fetch_assoc($result);
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
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="index-guest.php">Navbar</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
    </ul>
  </div>
</nav>
    <div class="container">
    <h1>Single job</h1> 
        <p>job ID: <?php echo $single_job['id']?></p>
        <p>client name: <?php echo $single_job['client_name']?></p>
        <p>job title: <?php echo $single_job['title']?></p>
        <p>budget: <?php echo $single_job['budget']?></p>
        <p>type of work: <?php echo $single_job['work_type']?></p>
        <p>experience required: <?php echo $single_job['experience']?></p>
        <p>job duration: <?php echo $single_job['length']?></p>
        <p>job description: <?php echo $single_job['description']?></p>
        <p>date posted: <?php echo $single_job['date']?></p>
    </div>
</body>
</html>