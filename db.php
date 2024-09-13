<?php
$conn = new mysqli("localhost", "root", "", "dice");
if ($conn->connect_error) {
exit("Connection failed: " . $conn->connect_error);
}
?>