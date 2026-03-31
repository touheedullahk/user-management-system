<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

echo "Welcome, " . ($_SESSION['name'] ?? "User") . "<br><br>";

echo "Role: " . $_SESSION['role'] . "<br><br>";

if (isset($_SESSION['log'])) {
    echo $_SESSION['log'] . "<br><br>";
    unset($_SESSION['log']);
}

echo "<a href='logout.php'>Logout</a>";