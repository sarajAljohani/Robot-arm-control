<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "task1_robot";
$feedback = "";
$conn = mysqli_connect($servername, $username, $password, $db);
$query = "SELECT * FROM robot";
$angles = mysqli_query($conn, $query)->fetch_assoc();

echo $angles['base']."\n".$angles['shoulder']."\n".$angles['elbow']."\n".$angles['wrist']."\n".$angles['gripper']."\n".$angles['power']."\n";
 ?>
