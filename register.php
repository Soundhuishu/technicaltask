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
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username or email already exists in the database
    $query = "SELECT * FROM register WHERE username='$username' OR email='$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        // Username or email already exists, show an error message
        echo '<script>alert("username and email id is already exit!"); window.location.replace("register.html");</script>'; exit;
    } else {
        // Insert the user data into the database
        $query = "INSERT INTO register (firstname, lastname, username, password, gender, dob, email, mobile) VALUES ('$firstname', '$lastname', '$username', '$hashed_password', '$gender', '$dob', '$email', '$mobile')";
        if (mysqli_query($conn, $query)) {
            // Registration successful, redirect to the login page
            echo '<script>alert("Registration successful!"); window.location.replace("login.html");</script>'; exit;
        } else {
            // Database error, show an error message
            echo "Database error: " . mysqli_error($conn);
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>
