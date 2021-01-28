<?php
session_start();

    include("connection.php");
    include("functions.php");
    $user_data = check_login($con);
    $client_name = $user_data['user_name'];
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
    <title>Add New Job</title>
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
    <h3>ADD NEW JOB</h3>
    <form method="post" class="needs-validation p-2" novalidate>
        <div class="row mb-3">
            <div class="col">
                <label for="title">Project Title</label>
                <input type="text" class="form-control" id="title" placeholder="Title" name="title" required>
            </div>
            <div class="col">
                <label for="title">Project Budget ( L.E Pounds )</label>
                <input type="number" class="form-control" id="budget" placeholder="Project Budget" name="budget" required>
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
        <div class="row mb-3">
            <div class="col form-group">
                <label for="experience">What's the expected freelancer Experience?</label>
                <select class="form-control" id="experience" name="experience">
                    <option value="entry">Entry Level</option>
                    <option  value="intermediate">Intermediate</option>
                    <option  value="expert">Expert</option>
                </select> 
            </div>
            <div class="col form-group">
                <label for="length">What's the expected project length?</label>
                <select class="form-control" id="length" name="length">
                    <option value="week">Less than a week</option>
                    <option value="2weeks">1 - 2 weeks</option>
                    <option value="month">a month</option>
                    <option value="3months">1 - 3 months</option>
                    <option value="6month">3 - 6 months</option>
                    <option value="verylong">more than 6 months</option>
                </select> 
            </div>
        </div>
        <div class="form-group">
            <label for="description">Project Description:</label>
            <textarea class="form-control" rows="5" id="description" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Post Job</button>
        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                $title = $_POST['title'];
                $budget = $_POST['budget'];
                $work_type = $_POST['worktype'];
                $experience = $_POST['experience'];
                $length = $_POST['length'];
                $description = $_POST['description'];

                if(!empty($title) && !empty($budget) && !empty($work_type) && !empty($experience) && !empty($length) && !empty($description)) {
                    //save to database
                    $query = "insert into jobs (client_name,title,budget,work_type,experience,length,description) values ('$client_name','$title','$budget','$work_type','$experience','$length','$description')";
                    $result = mysqli_query($con, $query);
                    if($result) {
                        // $id = $result['id'];
                        // $job_id_query = "update single_job set job_id = '$id' where id = 1";
                        // $job_id = mysqli_query($con, $id);
                        header('Location: index-client.php');
                        // echo "Successfully submitted your job";
                    } else {
                        echo "Please enter some valid information";
                    }
                }
            }
        ?>
    </form>
</div>
</body>
</html>