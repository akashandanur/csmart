<?php
// dashboard.php
include('config.php');
session_start();

if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
    exit;
}

$teacher_id = $_SESSION['teacher_id'];

$sql = "SELECT * FROM students WHERE teacher_id='$teacher_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }
        .container {
            padding: 20px;
        }
        .welcome {
            margin-bottom: 20px;
            font-size: 20px;
        }
        .menu {
            list-style-type: none;
            padding: 0;
        }
        .menu li {
            background-color: white;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .menu li a {
            text-decoration: none;
            color: #333;
            font-size: 18px;
            display: block;
        }
        .menu li a:hover {
            background-color: #4CAF50;
            color: white;
            padding-left: 10px;
            transition: 0.3s;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        .actions a {
            margin-right: 10px;
            color: #4CAF50;
            text-decoration: none;
        }
        .actions a:hover {
            text-decoration: underline;
        }
    </style>
    <</head>
<body>
    <div class="navbar">
        <h1>Teacher Portal</h1>
    </div>
    <div class="container">
        <div class="welcome">
            <?php
            echo "Welcome, Teacher!";
            ?>
        </div>
        <ul class="menu">
            <li><a href="add_student.php">Add Student</a></li>
        </ul>
        <h2>Your Students</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Class</th>
                <th>Email</th>
                <th>Subject Name</th>
                <th>Marks</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['class'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['Subject Name'] . "</td>";
                    echo "<td>" . $row['Marks'] . "</td>";

                    echo "<td class='actions'><a href='edit_student.php?id=" . $row['id'] . "'>Edit</a> <a href='delete_student.php?id=" . $row['id'] . "'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No students found.</td></tr>";
            }
            ?>
        </table>
    </div>
    </table>
    </div>
    <div class="footer">
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>



