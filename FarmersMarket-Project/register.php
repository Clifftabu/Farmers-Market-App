<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Print POST data for debugging
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Safely extract fields
    $role = $_POST['role'] ?? null;
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $location = $_POST['location'] ?? null;
    $password = $_POST['password'] ?? null;

    // Check all fields exist
    if ($role && $username && $email && $location && $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (role, username, email, location, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssss", $role, $username, $email, $location, $hashedPassword);

            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Execution error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "SQL error: " . $conn->error;
        }
    } else {
        echo "Error: All fields are required.";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
