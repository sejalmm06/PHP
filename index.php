<?php
// Database connection variables
$servername = "db"; // The name of the MySQL service in Docker Compose (db)
$username = "user"; // MySQL username defined in the environment variables
$password = "Pass@123"; // MySQL password defined in the environment variables
$dbname = "mydatabase"; // MySQL database name defined in the environment variables

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Example query to fetch data from the database
$sql = "SELECT * FROM users"; // Replace with your actual table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

