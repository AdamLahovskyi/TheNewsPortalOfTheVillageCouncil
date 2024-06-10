<?php
use core\Core;
use models\Users;

$users = Users::GetAllUsersWithRoleUser();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['promote'])) {
    $userId = $_POST['user_id'];
    Users::PromoteUserToAdmin($userId);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users with Role 'User'</title>
    <link rel="stylesheet" href="/views/styles/adminpanel.css">
</head>
<body>
<h1>Users with Role 'User'</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Login</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['login']); ?></td>
                <td><?php echo htmlspecialchars($user['firstname']); ?></td>
                <td><?php echo htmlspecialchars($user['lastname']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                        <button type="submit" name="promote">Promote to Admin</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No users found with the role 'user'.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>
