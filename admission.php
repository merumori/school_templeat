<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $servername = "localhost";
    $username = "root"; // Update with your database username
    $password = ""; // Update with your database password
    $dbname = "schoolmanagment";

    // Enable error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    try {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve and sanitize form inputs
        $studentName = $conn->real_escape_string($_POST['student-name']);
        $dob = $conn->real_escape_string($_POST['dob']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $address = $conn->real_escape_string($_POST['address']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $email = $conn->real_escape_string($_POST['email']);
        $grade = $conn->real_escape_string($_POST['grade']);
        $parentName = $conn->real_escape_string($_POST['parent-name']);

        // SQL query to insert data
        $sql = "INSERT INTO admissions (student_name, dob, gender, address, phone, email, grade, parent_name) 
                VALUES ('$studentName', '$dob', '$gender', '$address', '$phone', '$email', '$grade', '$parentName')";

        if ($conn->query($sql) === TRUE) {
            echo "Application submitted successfully!";
        } else {
            echo "Error: " . $conn->error;
        }

        // Close connection
        $conn->close();
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
