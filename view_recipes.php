<?php
session_start();
require_once 'includes/db.php';

$nameSearch = $_GET['name'] ?? '';
$typeSearch = $_GET['type'] ?? '';

$sql = "SELECT recipes.*, users.username FROM recipes 
        JOIN users ON recipes.uid = users.uid 
        WHERE 1";
$params = [];

if ($nameSearch) {
    $sql .= " AND recipes.name LIKE ?";
    $params[] = "%$nameSearch%";
}

if ($typeSearch) {
    $sql .= " AND recipes.type = ?";
    $params[] = $typeSearch;
}

$sql .= " ORDER BY rid DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$recipes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Recipes – Virtual Kitchen</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background: #fff0f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #d63384;
            margin-bottom: 1rem;
        }

        form {
            text-align: center;
            margin-bottom: 2rem;
        }

        input, select, button {
            padding: 0.6rem;
            margin: 0.3rem;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        button {
            background: #d63384;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #c22568;
        }

        .recipe-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            margin: 1rem auto;
            max-width: 700px;
            position: relative;
        }

        .recipe-card h2 {
            color: #c22568;
            margin-bottom: 0.5rem;
        }

        .recipe-card h2 a {
            color: inherit;
            text-decoration: none;
        }

        .recipe-card h2 a:hover {
            text-decoration: underline;
        }

        .meta {
            font-size: 0.9rem;
            color: #888;
            margin-bottom: 0.8rem;
        }

        .actions {
            margin-top: 1rem;
        }

        .actions a {
            display: inline-block;
            margin-right: 1rem;
            padding: 0.4rem 0.8rem;
            text-decoration: none;
            background: #f783ac;
            color: #fff;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .actions a:hover {
            background: #d63384;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <h1>&#x1F374; All Recipes</h1>

    <form method="get">
        <input type="text" name="name" placeholder="Search by name" value="<?= htmlspecialchars($nameSearch) ?>">
        <select name="type">
            <option value="">-- Type --</option>
            <?php foreach (['French','Italian','Chinese','Indian','Mexican','Others'] as $type): ?>
                <option value="<?= $type ?>" <?= $type === $typeSearch ? 'selected' : '' ?>><?= $type ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">&#x1F50D; Search</button>
    </form>

    <?php if (count($recipes) === 0): ?>
        <p style="text-align: center;">No recipes found.</p>
    <?php endif; ?>

    <?php foreach ($recipes as $recipe): ?>
        <div class="recipe-card">
            <h2>
                <a href="recipe.php?rid=<?= $recipe['rid'] ?>">
                    <?= htmlspecialchars($recipe['name']) ?>
                </a>
            </h2>
            <p class="meta">
                &#x1F372; <?= htmlspecialchars($recipe['type']) ?> |
                &#x23F1; <?= (int)$recipe['Cookingtime'] ?> mins |
                &#x1F464; <?= htmlspecialchars($recipe['username']) ?>
            </p>
            <p><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>

            <div class="actions">
                <?php if (isset($_SESSION['uid']) && $_SESSION['uid'] == $recipe['uid']): ?>
                    <a href="delete_recipe.php?rid=<?= $recipe['rid'] ?>" onclick="return confirm('Delete this recipe?');">&#x1F5D1;&#xFE0F; Delete</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
