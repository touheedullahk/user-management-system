<?php

session_start();
require 'autoload.php';

use App\Core\Database;

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new Database();
    $conn = $db->connect();

    // get user from database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if ($user) {

        // verify password
        if (password_verify($password, $user['password'])) {

            $_SESSION['user'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];

            // ✅ LOG MESSAGE (fixed way)
            $_SESSION['log'] = "[LOG]: " . $user['email'] . " logged in";

            header("Location: index.php");
            exit();
        }
    }

    $message = "Invalid email or password!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="POST">
    Email: <input type="text" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

<p style="color:red;">
<?php 
if (!empty($message)) {
    echo $message;
}
?>
</p>

</body>
</html>