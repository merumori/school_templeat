<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "schoolmanagment";

    try {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize and validate input data
        $guardian_name = $conn->real_escape_string($_POST['gname'] ?? '');
        $guardian_email = $conn->real_escape_string($_POST['gmail'] ?? '');
        $child_name = $conn->real_escape_string($_POST['cname'] ?? '');
        $child_age = $conn->real_escape_string($_POST['cage'] ?? '');
        $message = $conn->real_escape_string($_POST['message'] ?? '');

        // Validate required fields
        if (empty($guardian_name) || empty($guardian_email) || empty($child_name) || empty($child_age)) {
            echo "All fields are required.";
            exit;
        }

        // Insert data into the database
        $sql = "INSERT INTO appointments (guardian_name, guardian_email, child_name, child_age, message) 
                VALUES ('$guardian_name', '$guardian_email', '$child_name', '$child_age', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "Appointment booked successfully!";
        } else {
            echo "Error: " . $conn->error;
        }

        // Close the connection
        $conn->close();
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
