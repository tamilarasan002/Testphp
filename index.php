<?php
$host = getenv('DB_HOST');
$db = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$port = getenv('DB_PORT');

// Connect to PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Insert data into the database
    $query = "INSERT INTO users (first_name, last_name, dob, email, phone) VALUES ($1, $2, $3, $4, $5)";
    $result = pg_query_params($conn, $query, array($firstName, $lastName, $dob, $email, $phone));

    if ($result) {
        echo "Data successfully inserted!";
    } else {
        echo "Error: " . pg_last_error();
    }

    pg_free_result($result);
}

// Close the connection
pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit User Details</title>
</head>
<body>
    <h1>Submit User Details</h1>
    <form method="post" action="index.php">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required>
        <br><br>
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required>
        <br><br>
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required>
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
