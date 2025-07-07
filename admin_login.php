<?php
session_start();
require 'db_connect.php';

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header('Location: admin_dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password']) && $admin['role'] === 'admin') {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['role'] = $admin['role'];
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $error = "Invalid credentials or unauthorized access.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Admin Login</title></head>
<body>
<h2>Admin Login</h2>
<form method="post" action="">
    <label>Username: <input type="text" name="username" required></label><br><br>
    <label>Password: <input type="password" name="password" required></label><br><br>
    <button type="submit">Login</button>
</form>
<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
<p><a href="password_reset_request.php">Forgot password?</a></p>
</body>
</html>
