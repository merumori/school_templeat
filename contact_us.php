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
        $name = $conn->real_escape_string($_POST['name'] ?? '');
        $email = $conn->real_escape_string($_POST['email'] ?? '');
        $subject = $conn->real_escape_string($_POST['subject'] ?? '');
        $message = $conn->real_escape_string($_POST['message'] ?? '');

  
        // Validate inputs
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            die("All fields are required.");
        }

        // SQL query to insert data into contact_us table
        $sql = "INSERT INTO contact_us (name, email, subject, message) 
                VALUES ('$name', '$email', '$subject', '$message')";

        // Debug: Print the SQL query
      

        if ($conn->query($sql) === TRUE) {
            echo "Message sent successfully!";
        } else {
            // Debug: Output error if the query fails
            echo "Database Error: " . $conn->error . "<br>Query: $sql";
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
