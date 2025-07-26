<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "robot_actions";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "UPDATE run SET status = 0";
if ($conn->query($sql) === TRUE) {
    echo "Status updated to 0";
} else {
    echo "Error updating status: " . $conn->error;
}

$conn->close();
?>
