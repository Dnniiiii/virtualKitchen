<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Recipe – Virtual Kitchen</title>
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
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
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

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 0.8rem;
            margin-top: 0.3rem;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
        }

        input[type="submit"] {
            background-color: #d63384;
            color: white;
            padding: 0.8rem;
            border: none;
            width: 100%;
            border-radius: 10px;
            margin-top: 1.5rem;
            font-size: 1rem;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #c22568;
        }
    </style>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="page-wrapper">
        <div class="form-box">
            <h2>&#x1F373; Add a New Recipe</h2>
            <form action="add_recipe_process.php" method="post">
                <label for="name">Recipe Name</label>
                <input type="text" id="name" name="name" required>

                <label for="description">Short Description</label>
                <input type="text" id="description" name="description" required>

                <label for="type">Cuisine Type</label>
                <select id="type" name="type" required>
                    <option value="">--Select Type--</option>
                    <option value="French">French</option>
                    <option value="Italian">Italian</option>
                    <option value="Chinese">Chinese</option>
                    <option value="Indian">Indian</option>
                    <option value="Mexican">Mexican</option>
                    <option value="Others">Others</option>
                </select>

                <label for="cookingtime">Cooking Time (minutes)</label>
                <input type="number" id="cookingtime" name="cookingtime" min="1" required>

                <label for="ingredients">Ingredients</label>
                <textarea id="ingredients" name="ingredients" rows="4" required></textarea>

                <label for="instructions">Instructions</label>
                <textarea id="instructions" name="instructions" rows="4" required></textarea>

                <label for="image">Image Filename (e.g. food.jpg)</label>
                <input type="text" id="image" name="image">

                <input type="submit" value="&#x2795; Add Recipe">
            </form>
        </div>
    </div>
</body>
</html>
