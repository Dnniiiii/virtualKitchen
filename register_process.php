<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Basic validation
    if (empty($username) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    // Check if user already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        die("A user with that email already exists.");
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $hashedPassword])) {
        // Automatically log the user in
        $_SESSION['uid'] = $pdo->lastInsertId();
        $_SESSION['username'] = $username;

        // Redirect to dashboard or homepage
        header("Location: dashboard.php"); // or index.php
        exit();
    } else {
        die("Something went wrong. Please try again.");
    }
} else {
    header("Location: register.php");
    exit();
}
