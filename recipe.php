<?php
session_start();
require_once 'includes/db.php';

$rid = intval($_GET['rid'] ?? 0);

$stmt = $pdo->prepare("SELECT r.*, u.username FROM recipes r JOIN users u ON r.uid = u.uid WHERE r.rid = ?");
$stmt->execute([$rid]);
$recipe = $stmt->fetch();

if (!$recipe) {
    echo "&#x26A0; Recipe not found.";
    exit();
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
            margin: 0;
            padding: 2rem;
        }

        .page-wrapper {
            max-width: 700px;
            margin: auto;
            background: #fff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #d63384;
            margin-bottom: 0.5rem;
        }

        .meta {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 1rem;
        }

        .section-title {
            margin-top: 1.5rem;
            color: #c22568;
            font-weight: bold;
        }

        p, ul {
            line-height: 1.6;
            color: #333;
        }

        .recipe-img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="page-wrapper">
        <h1>&#x1F958; <?= htmlspecialchars($recipe['name']) ?></h1>
        <div class="meta">
            Posted by <strong><?= htmlspecialchars($recipe['username']) ?></strong> |
            Cuisine: <?= htmlspecialchars($recipe['type']) ?> |
            Time: <?= (int)$recipe['Cookingtime'] ?> mins
        </div>

        <?php if (!empty($recipe['image'])): ?>
            <img src="uploads/<?= htmlspecialchars($recipe['image']) ?>" alt="Recipe Image" class="recipe-img">
        <?php endif; ?>

        <div class="section-title">&#x1F374; Description</div>
        <p><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>

        <div class="section-title">&#x1F957; Ingredients</div>
        <p><?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>

        <div class="section-title">&#x1F9C1; Instructions</div>
        <p><?= nl2br(htmlspecialchars($recipe['instructions'])) ?></p>
    </div>
</body>
</html>
