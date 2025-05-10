<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include 'config.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (isset($_POST['update'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $update = $conn->prepare("UPDATE users SET first_name=?, last_name=?, username=?, password=? WHERE id=?");
    $update->bind_param("ssssi", $first_name, $last_name, $username, $password, $id);
    $update->execute();
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <a href="dashboard.php" class="btn btn-secondary mb-3">&larr; Back</a>
    <div class="card p-4">
        <h3>Edit User</h3>
        <form method="POST">
            <div class="mb-2">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($user['first_name']) ?>" required>
            </div>
            <div class="mb-2">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($user['last_name']) ?>" required>
            </div>
            <div class="mb-2">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
            </div>
            <div class="mb-2">
                <label>Password</label>
                <input type="text" name="password" class="form-control" value="<?= htmlspecialchars($user['password']) ?>" required>
            </div>
            <button class="btn btn-primary" name="update">Update</button>
        </form>
    </div>
</body>
</html>