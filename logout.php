<?php
session_start();
session_unset();    // 🧹 Clear all session variables
session_destroy();  // 🔒 End the session completely

// 🚪 Redirect to home or login page
header("Location: index.php");
exit();
