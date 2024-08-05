<?php
// Database connection parameters
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');

// Create a connection to the PostgreSQL database
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = pg_escape_string($_POST['name']);
    $email = pg_escape_string($_POST['email']);
    
    // Insert data into the database
    $query = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    
    $result = pg_query($conn, $query);
    
    if ($result) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . pg_last_error();
    }
}
?>
