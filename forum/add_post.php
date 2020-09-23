<?php
include '../config.php';
session_start();

$username = $_SESSION['username'];
$message = $_POST['message'];

$row = mysqli_num_rows(mysqli_query($db, "select * from post")) + 1;
$query = "insert into post(id, username, message, id_parent) values('$row', '$username', '$message', '$row')";
// $commit = mysqli_commit($db, )
$is_success = "post_fail";
if ($db->query($query) === TRUE){
    $is_success = "post_success";
}

$is_success = "";
header("location:index.php?success=" . $is_success );

?>