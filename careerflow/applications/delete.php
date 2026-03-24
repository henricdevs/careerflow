<?php
include '../auth/check.php';
include '../config/db.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$sql = "DELETE FROM applications WHERE id='$id' AND user_id='$user_id'";

if ($conn->query($sql)) {
    header("Location: list.php");
} else {
    echo "Error: " . $conn->error;
}
?>