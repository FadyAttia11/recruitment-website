<?php 
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $user_name = $user_data['user_name'];
    $work_type = $user_data['work_type'];

    $recommended_jobs_query = "select * from jobs where work_type = '$work_type'";
    $recommended_jobs = mysqli_query($con, $recommended_jobs_query);
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
    <title>Freelancer Home</title>
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
        <a class="nav-link" href="index-client.php">Recommended Jobs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="top-freelancers.php">Top Clients</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"><?php echo $user_data['user_role']; ?>: <?php echo $user_data['user_name']; ?></a>
      </li>
    </ul>
    <a class="btn btn-danger ml-4" href="logout.php"><span>Logout</span></a>
  </div>
  </div>
</nav>

<div class="container mt-5">
      <div class="mt-3 bg-light">
          <h2 class="text-center">Recommended Jobs For You</h2>
          <?php
              print "
              <table class='table table-striped'>
              <tr>
              <td>Title</td> 
              <td>Work Type</td> 
              <td>Experience Level</td> 
              <td>Budget</td> 
              </tr>";
              while($row = mysqli_fetch_array($recommended_jobs))
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
</div>
</body>
</html>

