<?php
// edit_student.php
include('config.php');
session_start();

// Redirect to login if teacher_id is not set in session
if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
    exit;
}

// Redirect to dashboard if id is not set in URL
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

// Get id and teacher_id from session and URL
$id = $_GET['id'];
$teacher_id = $_SESSION['teacher_id'];

// Handle form submission for updating student details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $class = $_POST['class'];
    $subject = $_POST['subject'];
    $mark = $_POST['mark'];

    // Use prepared statement to update student details
    $sql = "UPDATE students SET name=?, email=?, class=?, `Subject Name`=?, marks=? WHERE id=? AND teacher_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiii", $name, $email, $class, $subject, $mark, $id, $teacher_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error updating student: " . $stmt->error;
    }
} else {
    // Fetch student details for editing
    $sql = "SELECT * FROM students WHERE id=? AND teacher_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $teacher_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $student = $result->fetch_assoc();
    } else {
        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Student</h2>
        <form method="POST" action="">
            <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required><br>
            <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required><br>
            <input type="text" name="class" value="<?php echo htmlspecialchars($student['class']); ?>" required><br>
            <input type="text" name="subject" value="<?php echo htmlspecialchars($student['Subject Name']); ?>" required><br>
            <input type="number" name="mark" value="<?php echo htmlspecialchars($student['mark']); ?>" required><br>
            <button type="submit">Update Student</button>
        </form>
    </div>
</body>
</html>
