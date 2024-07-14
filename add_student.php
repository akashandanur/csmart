<?php
// add_student.php
include('config.php');
session_start();

if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $class = $_POST['class'];
    $subject = $_POST['subject'];
    $mark = $_POST['mark'];
    $teacher_id = $_SESSION['teacher_id']; // Assuming you store teacher_id in session upon login

    // Validate inputs
    if (empty($name) || empty($email) || empty($class) || empty($subject) || empty($mark)) {
        echo "All fields are required.";
        exit;
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Check for duplicate entry
    $sql_check_duplicate = "SELECT * FROM students WHERE email='$email' AND class='$class' AND teacher_id='$teacher_id'";
    $result_check_duplicate = $conn->query($sql_check_duplicate);

    if ($result_check_duplicate->num_rows > 0) {
        echo "Student with the same email and class already exists.";
        exit;
    }

    // Insert data into students table
    $sql_insert = "INSERT INTO students (name, email, class, teacher_id, `Subject Name`, Marks) VALUES ('$name', '$email', '$class', '$teacher_id', '$subject', '$mark')";
    
    if ($conn->query($sql_insert) === TRUE) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
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
        <h2>Add Student</h2>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Student Name" required><br>    
            <input type="email" name="email" placeholder="Student Email" required><br>
            <input type="text" name="class" placeholder="Class" required><br>
            <input type="text" name="subject" placeholder="Subject Name" required><br>
            <input type="number" name="mark" placeholder="Marks" required><br>
            <button type="submit">Add Student</button>
        </form>
    </div>
</body>
</html>
