<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include 'config.php';

$users = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #2d3e50;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }
        .sidebar a.active, .sidebar a:hover {
            background: #1abc9c;
        }
    </style>
</head>
<body>
<div class="row g-0">
    <div class="col-2 sidebar">
        <h4 class="p-3">Simple Admin</h4>
        <a href="dashboard.php" class="active"><i class='bx bx-home'></i> Dashboard</a>
        <a href="dashboard.php"><i class='bx bx-list-ul'></i> Records</a>
        <a href="dashboard.php"><i class='bx bx-user'></i> Users</a>
        <a href="logout.php"><i class='bx bx-log-out'></i> Logout</a>
    </div>
    <div class="col-10 p-4">
        <h2>Dashboard</h2>
        <table class="table table-bordered table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $users->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['password']) ?></td>
                    <td>
                        <a href="view.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm"><i class='bx bx-show'></i> View</a>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class='bx bx-edit'></i> Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this user?')"><i class='bx bx-trash'></i> Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>