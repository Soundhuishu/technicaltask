<?php
// Set database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'task';

// Attempt to connect to the database
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die('Database connection error: ' . mysqli_connect_error());
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query the database to get the user's information
    $query = "SELECT * FROM register WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    // Check if the username exists in the database
    if (mysqli_num_rows($result) == 1) {
        // Get the user's information
        $user = mysqli_fetch_assoc($result);
        // Verify that the password is correct
        if (password_verify($password, $user['password'])) {
            // Password is correct, set a session variable and redirect to a protected page
            session_start();
            $_SESSION['username'] = $username;
            echo '<script>alert("Login successful!"); window.location.replace("profile.html");</script>'; exit;
        } else {
            // Password is incorrect, display an error message
            echo 'Incorrect password. Please try again.';
        }
    } else {
        // Username doesn't exist in the database, display an error message
        echo 'Invalid username. Please try again.';
    }
}

// Close the database connection
mysqli_close($conn);
?>