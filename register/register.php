<?php
include '../config.php';

$username = $_POST['username'];
$password = $_POST['password'];

echo $username;


$query = "insert into user(username, password) values('$username', '$password')";
// $result = mysqli_query($db, $query);
// $count = mysqli_num_rows($result);
// // $count = 1;
// if ($count > 0){
//     session_start();
//     $_SESSION['username'] = $username;
//     $_SESSION['status'] = "login";
//     header("location:forum/index.php?success=");
// } else {
//     header("location:index.php" );
// }
$is_success = "register_fail";
if ($db->query($query) === TRUE){
    $is_success = "register_success"; 
}

header("location:../index.php?success=" . $is_success );

?>