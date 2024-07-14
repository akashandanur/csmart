<?php
// delete_student.php
include('config.php');
session_start();

if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$teacher_id = $_SESSION['teacher_id'];

$sql = "DELETE FROM students WHERE id='$id' AND teacher_id='$teacher_id'";

if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
