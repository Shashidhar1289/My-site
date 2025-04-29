<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "contacts";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone_number = $_POST['phone_number'];
$address = $_POST['address'];

// Insert into database
$sql = "INSERT INTO contacts (first_name, last_name, phone_number, address)
        VALUES ('$first_name', '$last_name', '$phone_number', '$address')";

if ($conn->query($sql) === TRUE) {
  echo "✅ Record inserted successfully!";
} else {
  echo "❌ Error: " . $conn->error;
}

// Close connection
$conn->close();
?>
