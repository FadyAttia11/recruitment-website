<?php

function check_login($con) {
    if(isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";

        $result = mysqli_query($con, $query);

        if($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    //redirect to guest index
    // header('Location: index-guest.php');
    $user_data = ["user_role" => "guest",];
    // die;
}

// function get_questions($con) {
//     $query = "select * from questions";

//     $result = mysqli_query($con, $query);

//     if($result) {
//         $questions = mysqli_fetch_assoc($result);
//         return $questions;
//     }
// }


function random_num($length) {
    $text = "";
    if($length < 5) { $length = 5; }

    $len = rand(4, $length);

    for($i=0; $i < $len; $i++) {
        $text .= rand(0,9);
    }

    return $text;
}


// function add_money_to_doctor($doctor_name) {

//     $money_query = "update users set money = '$total_money' where user_name = '$doctor_name'";
//     $result = mysqli_query($con, $money_query);
// }