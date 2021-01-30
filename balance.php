<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    if($user_data['user_role'] == 'freelancer') {
        header('Location: balance-freelancer.php');

    } else if ($user_data['user_role'] == 'client') {
        header('Location: balance-client.php');
    }

?>