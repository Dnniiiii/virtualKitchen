<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_SESSION['uid'];
    $rid = intval($_POST['rid']);
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $type = $_POST['type'];
    $cookingtime = intval($_POST['cookingtime']);
    $ingredients = trim($_POST['ingredients']);
    $instructions = trim($_POST['instructions']);
    $image = trim($_POST['image']);

    // Check if recipe belongs to this user
    $check = $pdo->prepare("SELECT * FROM recipes WHERE rid = ? AND uid = ?");
    $check->execute([$rid, $uid]);

    if ($check->rowCount() === 0) {
        echo "You are not authorised to edit this recipe.";
        exit();
    }

    // Update recipe
    $stmt = $pdo->prepare("UPDATE recipes SET name=?, description=?, type=?, Cookingtime=?, ingredients=?, instructions=?, image=? WHERE rid=? AND uid=?");
    $success = $stmt->execute([$name, $description, $type, $cookingtime, $ingredients, $instructions, $image, $rid, $uid]);

    if ($success) {
        header("Location: dashboard.php?updated=1");
        exit();
    } else {
        echo "Update failed.";
    }
} else {
    header("Location: dashboard.php");
    exit();
}
