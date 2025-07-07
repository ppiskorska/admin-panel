<?php
include 'admin_auth.php';
?>
<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title></head>
<body>
<h1>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></h1>
<p>This is a placeholder for your admin dashboard.</p>
<p><a href="admin_login.php">Logout</a></p>
</body>
</html>
