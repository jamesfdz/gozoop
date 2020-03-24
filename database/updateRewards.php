<?php

session_start();

include ("config.php");

$output = array();
$msg = "";

$rewards = $_POST['rewards'];
$loggedin_user = $_SESSION['loggedin_user'];

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

$query = "SELECT rewards FROM users WHERE username = '$loggedin_user'";
$data = mysqli_query($link, $query);
$result = mysqli_fetch_assoc($data);

$previous_rewards = $result['rewards'];

$totalRewards = $rewards + $previous_rewards;

$update_query = "UPDATE users SET rewards = '$totalRewards' WHERE username = '$loggedin_user'";

if ($link->query($update_query) === TRUE) {
    $msg = "Record updated successfully";
} else {
    $msg = "Error updating record: " . $link->error;
}

$link->close();

$output["username"] = $loggedin_user;
$output["msg"] = $msg;
$output["totalRewards"] = $totalRewards;
echo json_encode($output);


?>