<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {
        // Retrieve form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Validate email format (you might want to use more robust validation methods)
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Connect to your database (replace these values with your actual database credentials)
            $servername = "localhost";
            $username = "username";
            $password = "password";
            $dbname = "ms_db";

            // Create a connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare SQL statement to insert user data into the database
            $stmt = $conn->prepare("INSERT INTO users (name, email, pwd) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashedPassword);

            // Execute the statement
            if ($stmt->execute()) {
                // Registration successful
                echo "Registration successful!";
            } else {
                // Registration failed
                echo "Error: " . $conn->error;
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        } else {
            // If email format is invalid, show an error message
            echo "Invalid email format";
        }
    } else {
        // If any required field is missing, show an error message
        echo "Please fill in all required fields";
    }
}
?>
