<?php
session_start();
require 'config.php';

$error = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password_hash FROM admins WHERE username=? LIMIT 1");
    $stmt->bind_param("s",$user);
    $stmt->execute();
    $stmt->bind_result($id,$hash);
    if($stmt->fetch()){
        if(password_verify($pass,$hash)){
            $_SESSION['admin_id'] = $id;
            header("Location: admin_dashboard.php");
            exit;
        }else{
            $error = "Invalid credentials.";
        }
    }else{
        $error = "Invalid credentials.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="login-box">
  <h2>Admin Login</h2>
  <?php if($error) echo "<p class='error'>$error</p>"; ?>
  <form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button>Login</button>
  </form>
</div>

</body>
</html>
