<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$rid = intval($_GET['rid'] ?? 0);
$uid = $_SESSION['uid'];

// Get recipe if it belongs to logged-in user
$stmt = $pdo->prepare("SELECT * FROM recipes WHERE rid = ? AND uid = ?");
$stmt->execute([$rid, $uid]);
$recipe = $stmt->fetch();

if (!$recipe) {
    echo "Recipe not found or access denied.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Recipe – Virtual Kitchen</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background: #fff0f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        .page-wrapper {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 2rem;
        }

        .form-box {
            background: #fff;
            padding: 2rem;
            border-radius: 20px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #d63384;
            margin-bottom: 1rem;
        }

        label {
            font-weight: bold;
            margin-top: 1rem;
            display: block;
            color: #555;
        }

        input, textarea, select {
            width: 100%;
            padding: 0.7rem;
            margin-top: 0.3rem;
            border-radius: 10px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background: #d63384;
            color: white;
            margin-top: 1.5rem;
            cursor: pointer;
            border: none;
            font-size: 1rem;
            padding: 0.8rem;
            border-radius: 10px;
        }

        input[type="submit"]:hover {
            background: #c22568;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="page-wrapper">
        <div class="form-box">
            <h2>&#x1F353; Edit Recipe</h2>
            <form action="edit_recipe_process.php" method="post">
                <input type="hidden" name="rid" value="<?= $recipe['rid'] ?>">

                <label for="name">Recipe Name</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($recipe['name']) ?>" required>

                <label for="description">Short Description</label>
                <input type="text" name="description" id="description" value="<?= htmlspecialchars($recipe['description']) ?>" required>

                <label for="type">Cuisine Type</label>
                <select name="type" id="type" required>
                    <?php foreach (['French','Italian','Chinese','Indian','Mexican','Others'] as $type): ?>
                        <option value="<?= $type ?>" <?= ($recipe['type'] == $type ? 'selected' : '') ?>><?= $type ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="cookingtime">Cooking Time (minutes)</label>
                <input type="number" name="cookingtime" id="cookingtime" value="<?= (int)$recipe['Cookingtime'] ?>" required>

                <label for="ingredients">Ingredients</label>
                <textarea name="ingredients" id="ingredients" rows="4" required><?= htmlspecialchars($recipe['ingredients']) ?></textarea>

                <label for="instructions">Instructions</label>
                <textarea name="instructions" id="instructions" rows="4" required><?= htmlspecialchars($recipe['instructions']) ?></textarea>

                <label for="image">Image Filename</label>
                <input type="text" name="image" id="image" value="<?= htmlspecialchars($recipe['image']) ?>">

                <input type="submit" value="&#x1F4BE; Update Recipe">
            </form>
        </div>
    </div>
</body>
</html>
