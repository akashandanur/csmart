<?php
// register.php
include('config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO teachers (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Registration successful!";
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Portal Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
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
        .message {
            margin-top: 20px;
            font-size: 16px;
            color: green;
            text-align: center;
        }
        .error-message {
            margin-top: 20px;
            font-size: 16px;
            color: red;
            text-align: center;
        }
        .footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 16px;
        }
    </style>
    <script>
        function validateForm() {
            var name = document.forms["registrationForm"]["name"].value;
            var email = document.forms["registrationForm"]["email"].value;
            var password = document.forms["registrationForm"]["password"].value;

            if (name == "" || email == "" || password == "") {
                alert("All fields must be filled out");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h2>Teacher Portal Registration</h2>
        <form name="registrationForm" method="POST" action="" onsubmit="return validateForm()">
            <input type="text" name="name" placeholder="Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>
    </div>
    <div class="footer">
        <?php
        if (isset($_SESSION['success_message'])) {
            echo "<div class='message'>" . $_SESSION['success_message'] . "</div>";
            unset($_SESSION['success_message']);
        }
        if (isset($_SESSION['error_message'])) {
            echo "<div class='error-message'>" . $_SESSION['error_message'] . "</div>";
            unset($_SESSION['error_message']);
        }
        ?>
    </div>
</body>
</html>
