<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

		// Get the user's information from the database
		$username = $_POST['username'];
		$query = "SELECT * FROM register WHERE username='$username'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);

		// Display the user's information in a table
		echo '<h2>User Information</h2>';
		echo '<table>';
		if (isset($row['firstname'])) {
		    echo '<tr><td>First Name:</td><td>' . $row['firstname'] . '</td></tr>';
		}

		if (isset($row['lastname'])) {
		    echo '<tr><td>Last Name:</td><td>' . $row['lastname'] . '</td></tr>';
		}

		if (isset($row['username'])) {
		    echo '<tr><td>Username:</td><td>' . $row['username'] . '</td></tr>';
		}

		if (isset($row['password'])) {
		    echo '<tr><td>Password:</td><td>' . $row['password'] . '</td></tr>';
		}

		if (isset($row['gender'])) {
		    echo '<tr><td>Gender:</td><td>' . $row['gender'] . '</td></tr>';
		}

		if (isset($row['dob'])) {
		    echo '<tr><td>Date of Birth:</td><td>' . $row['dob'] . '</td></tr>';
		}

		if (isset($row['email'])) {
		    echo '<tr><td>Email:</td><td>' . $row['email'] . '</td></tr>';
		}

		if (isset($row['mobile'])) {
		    echo '<tr><td>Mobile:</td><td>' . $row['mobile'] . '</td></tr>';
		}

		echo '</table>';

		// Close the database connection
		mysqli_close($conn);
	}
	?>