<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ( isset($_POST["email"]) && isset($_POST["password"])) {
        // Retrieve form data
        $email = $_POST["email"];
        $password = $_POST["password"];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT)
            $dbname = "ms_db";
            

        
            echo "Email: $email<br>";
            echo "Hashed Password: $hashedPassword<br>";

            header("Location: index.html");
            exit;
        } else {
            echo "Invalid email format";
        }
    } else {
        echo "Please fill in all required fields";
    }
}
?>
