<?php
session_start();
require_once 'includes/db.php';

// Redirect if user is not logged in
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_SESSION['uid'];
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $type = $_POST['type'];
    $cookingtime = intval($_POST['cookingtime']);
    $ingredients = trim($_POST['ingredients']);
    $instructions = trim($_POST['instructions']);
    $image = trim($_POST['image']);

    // Basic validation
    if (empty($name) || empty($description) || empty($type) || empty($cookingtime) || empty($ingredients) || empty($instructions)) {
        echo "All fields except image are required.";
        exit();
    }

    // Insert recipe
    $stmt = $pdo->prepare("INSERT INTO recipes (name, description, type, Cookingtime, ingredients, instructions, image, uid)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $success = $stmt->execute([$name, $description, $type, $cookingtime, $ingredients, $instructions, $image, $uid]);

    if ($success) {
        header("Location: dashboard.php?added=1");
        exit();
    } else {
        echo "Something went wrong while saving the recipe.";
    }
} else {
    header("Location: add_recipe.php");
    exit();
}
