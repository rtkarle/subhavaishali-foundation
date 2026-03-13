<?php
// register.php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$name || !$email || !$password) {
        die('Missing fields');
    }

    // check exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        die('Email already registered');
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name,email,phone,password_hash) VALUES (?,?,?,?)");
    $stmt->execute([$name,$email,$phone,$hash]);
    $userId = $pdo->lastInsertId();

    // log in user
    $_SESSION['user_id'] = $userId;
    header('Location: donate.php');
    exit;
}
?>

<!-- simple HTML form (you can add CSS) -->
<form method="post">
  <input name="name" placeholder="Full name" required>
  <input name="email" type="email" placeholder="Email" required>
  <input name="phone" placeholder="Phone">
  <input name="password" type="password" placeholder="Password" required>
  <button type="submit">Register</button>
</form>
