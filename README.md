# 🍓 Virtual Kitchen – CS1IAD Portfolio 3

A dynamic, database-driven recipe sharing platform developed as part of the CS1IAD Web Development module at Aston University.

---

## 🌐 Live Site

📍 [http://230090284.cs2410-web01pvm.aston.ac.uk/index.php](http://230090284.cs2410-web01pvm.aston.ac.uk/index.php)

---

## 👩‍🍳 Overview

**Virtual Kitchen** allows users to register, log in, and manage their own recipes. Visitors can browse, search, and view detailed information about recipes submitted by others.

Key features include:
- User registration and login system
- Add, edit, delete, and view recipes
- Public view of all submitted recipes
- Search recipes by name and type
- Session management and secure password hashing
- Clean, pastel-themed UI with modular components

---

## 🧑‍💻 Technologies Used

### 🔧 Server-side
- PHP 8+
- MySQL with PDO
- Apache (XAMPP environment for development)

### 🎨 Client-side
- HTML5
- CSS3 (custom styling)

---

## 🔐 Test User Credentials

| Username | Password |
|----------|----------|
| `dani`   | `dana`   |

Use the above credentials to explore the full functionality without creating a new account.

---

## 📌 How to Run Locally

1. Clone the repository:
   ```bash
   git clone https://github.com/Dnniiiii/virtualKitchen.git
   Place the files in your local XAMPP htdocs/ directory or upload to your server.

2. Import the provided SQL file into your MySQL database (via phpMyAdmin).

3. Update the includes/db.php connection details with your local database name and credentials.

4. Start Apache and MySQL. Access the site via http://localhost/virtualKitchen.

## 📁 Project Structure
virtualKitchen/
│
├── index.php                  # Home page with login/register links or dashboard redirect
├── login.php                  # Login form
├── login_process.php          # Handles login validation and session creation
├── logout.php                 # Destroys user session
├── register.php               # Registration form
├── register_process.php       # Handles new user registration
│
├── dashboard.php              # User dashboard (add/view recipes, logout)
├── add_recipe.php             # Form for adding a new recipe
├── add_recipe_process.php     # Saves new recipe to the database
├── edit_recipe.php            # Form to edit existing recipe
├── edit_recipe_process.php    # Updates recipe in the database
├── delete_recipe.php          # Deletes a user’s recipe
│
├── view_recipes.php           # Lists all recipes (searchable)
├── recipe_details.php         # Displays full details of a selected recipe
├── contact.php                # Contact form with submission confirmation
│
├── includes/
│   ├── db.php                 # Database connection using PDO
│   └── navbar.php             # Reusable navigation bar for all pages
│
├── css/
│   └── styles.css             # Site-wide pastel theme styling
│
├── images/
│   └── (optional images)      # Folder for uploaded or static recipe images
│
└── README.md                  # Project overview and documentation

## Security Features
Passwords hashed with password_hash() and verified with password_verify()

All database interactions use prepared statements to prevent SQL injection

Session-based user access with login protection on all private pages

Server-side validation on all forms

## 📄 License
This project was developed for educational purposes as part of the CS1IAD Web Development module at Aston University.

## 🙋‍♀️ Author
Daniela Stefan-Cucu
Aston University – BSc Computer Science
Student ID: 230090284


