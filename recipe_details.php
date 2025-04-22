<?php
session_start();
require_once 'includes/db.php';

$rid = isset($_GET['rid']) ? intval($_GET['rid']) : 0;
$stmt = $pdo->prepare("SELECT recipes.*, users.username FROM recipes JOIN users ON recipes.uid = users.uid WHERE rid = ?");
$stmt->execute([$rid]);
$recipe = $stmt->fetch();

if (!$recipe) {
    die("Recipe not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($recipe['name']) ?> – Virtual Kitchen</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background: #fff0f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem;
        }

        .recipe-box {
            background: #fff;
            padding: 2rem;
            border-radius: 20px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }

        h1 {
            color: #d63384;
        }

        .meta {
            font-size: 0.9rem;
            color: #888;
        }

        p {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="recipe-box">
        <h1><?= htmlspecialchars($recipe['name']) ?></h1>
        <p class="meta">&#x1F372; <?= htmlspecialchars($recipe['type']) ?> | 
           &#x23F1; <?= (int)$recipe['Cookingtime'] ?> mins | 
           &#x1F464; <?= htmlspecialchars($recipe['username']) ?>
        </p>

        <h3>Description</h3>
        <p><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>

        <h3>Ingredients</h3>
        <p><?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>

        <h3>Instructions</h3>
        <p><?= nl2br(htmlspecialchars($recipe['instructions'])) ?></p>

        <?php if (!empty($recipe['image'])): ?>
            <img src="images/<?= htmlspecialchars($recipe['image']) ?>" alt="Image of recipe" style="max-width:100%; border-radius:10px;">
        <?php endif; ?>
    </div>
</body>
</html>
