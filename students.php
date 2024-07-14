<?php
include('includes/db.php');
session_start();

if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
    exit();
}

$teacher_id = $_SESSION['teacher_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class_name = $_POST['class_name'];

    $stmt = $conn->prepare("INSERT INTO classes (teacher_id, class_name) VALUES (?, ?)");
    $stmt->bind_param("is", $teacher_id, $class_name);

    if ($stmt->execute()) {
        echo "Class added!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$result = $conn->query("SELECT * FROM classes WHERE teacher_id = $teacher_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Classes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Your Classes</h1>
    <form method="POST" action="">
        <label>Class Name: </label><input type="text" name="class_name" required><br>
        <button type="submit">Add Class</button>
    </form>

    <ul>
        <?php while($row = $result->fetch_assoc()): ?>
            <li><?php echo $row['class_name']; ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
