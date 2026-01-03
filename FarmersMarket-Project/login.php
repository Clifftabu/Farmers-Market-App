<?php
session_start();
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $role = $_POST['role'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Sanitize inputs
    $role = trim($role);
    $username = trim($username);
    $password = trim($password);

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = ?");
    $stmt->bind_param("ss", $username, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            // ✅ Redirect to dashboard with success message
            header("Location: dashboard.php?login=success");
            exit();
        } else {
            header("Location: signinpage.html?error=invalid_password");
            exit();
        }
    } else {
        header("Location: signinpage.html?error=user_not_found");
        exit();
    }
}
?>
