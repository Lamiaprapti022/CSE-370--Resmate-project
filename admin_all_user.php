<?php
include('authentication.php');
include('dbcon.php');

// Check if the user is an admin (you can adjust this based on your role management)
if ($_SESSION['auth_user']['is_admin'] != TRUE) {
    header('Location: login.php');
    exit;
}

$query = "SELECT * FROM users";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin - All Users</title>
    <link rel="icon" type="image/png" href="images/logo-v2.png">
    <style>
        .users-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f9;
        }

        td img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .action-btn {
            background-color: #4287f5;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .action-btn:hover {
            background-color: #3a7ae2;
        }
    </style>
</head>


<div class="home">
    <?php
    include('includes/header.php');
    include('components/sidebar_admin.php');

    ?>
    <div class="container-layouts">
        <main>
            <?php include('components/nav-header.php'); ?>
            <div class="welcome-container">
                <h1 class="f-s-30">Welcome back, Admin!</h1>
                <p class="f-w-300">
                    Manage the website.
                </p>
            </div>

            <div class="users-container">
                <h2>All Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($user = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td><img src='uploads/" . htmlspecialchars($user['image'] ?? 'default-avatar.png') . "' alt='User Image'></td>";
                                echo "<td>" . htmlspecialchars($user['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($user['department']) . "</td>";
                                echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                                echo "<td><a class='action-btn' href='edit_user.php?id=" . $user['user_id'] . "'>Edit</a> <a class='action-btn' href='delete_user.php?id=" . $user['user_id'] . "'>Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No users found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

</html>