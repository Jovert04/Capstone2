<?php
// Database connection settings
$servername = "localhost";
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password (blank)
$dbname = "smart_parking";  // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the selected date is provided
if (isset($_POST['selectedDate'])) {
    $selectedDate = $_POST['selectedDate'];

    // Query to get the parked count for the selected date
    $sql = "SELECT parked_count FROM parked_cars WHERE date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedDate);  // Bind the selected date to the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a result is found
    if ($result->num_rows > 0) {
        // Fetch the result and output the parked count
        $row = $result->fetch_assoc();
        echo $row['parked_count'];
    } else {
        echo "No data for this date";
    }

    $stmt->close();
} else {
    echo "No date provided";
}

$conn->close();
?>
