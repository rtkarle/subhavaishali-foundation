<?php
// login.php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $u = $stmt->fetch();

    if ($u && password_verify($password, $u['password_hash'])) {
        $_SESSION['user_id'] = $u['id'];
        header('Location: donate.php');
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>

<form method="post">
  <input name="email" type="email" placeholder="Email" required>
  <input name="password" type="password" placeholder="Password" required>
  <button type="submit">Login</button>
  <?php if(!empty($error)) echo "<p>$error</p>"; ?>
</form>
