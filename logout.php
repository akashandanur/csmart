<?php
// logout.php
session_start();

// Display session ID for debugging
echo "Current session ID: " . session_id() . "<br>";

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Check if session is really destroyed
if (session_status() === PHP_SESSION_NONE) {
    echo "Session successfully destroyed.<br>";
} else {
    echo "Session could not be destroyed.<br>";
}

// Redirect to login page
header("Location: login.php");
exit;
?>
