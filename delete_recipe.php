<?php
session_start();
require_once 'includes/db.php';

// Must be logged in
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['rid'])) {
    $rid = intval($_GET['rid']);
    $uid = $_SESSION['uid'];

    // Verify the recipe belongs to this user
    $stmt = $pdo->prepare("SELECT * FROM recipes WHERE rid = ? AND uid = ?");
    $stmt->execute([$rid, $uid]);

    if ($stmt->rowCount() === 1) {
        // Delete the recipe
        $delete = $pdo->prepare("DELETE FROM recipes WHERE rid = ?");
        $delete->execute([$rid]);

        header("Location: dashboard.php?deleted=1");
        exit();
    } else {
        echo "You do not have permission to delete this recipe.";
        exit();
    }
} else {
    header("Location: dashboard.php");
    exit();
}
