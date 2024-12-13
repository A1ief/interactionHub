<?php
session_start();
include '../../../db.php'; // Pastikan file ini sudah ada dan berfungsi

// Fetch data from the database
try {
    $sql = "SELECT * FROM agent";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $agents = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../assetsAdmin/css/pages.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/style.css">
    <link href="../../images/ih-logo-design_695270-414-Photoroom.png" rel="icon">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <!-- <i class='bx bx-code-alt'></i> -->
            <img src="../../assetsAdmin/images/ih-logo-design_695270-414-Photoroom.png" alt="InteractionHub" width="30px"
                style="margin-right: 5px;margin-left: 24px;">
            <div class="logo-name"><span>Interac</span>Hub</div>
        </a>
        <ul class="side-menu">
            <li><a href="../../index.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="../user.php"><i class='bx bx-group'></i>Users</a></li>
            <li><a href="../customer/customer.php"><i class='bx bxs-user-detail'></i>Customer</a></li>
            <li class="active"><a href=""><i class='bx bx-analyse'></i>Agent</a></li>
            <li><a href="#"><i class='bx bx-message-square-dots'></i>Tickets</a></li>
            <li><a href="#"><i class='bx bx-cog'></i>Settings</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="../../../logout.php" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a>
            <a href="#" class="profile">
                <img src="../../images/logo.png">
            </a>
        </nav>
        <!-- End of Navbar -->
        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Admin
                            </a></li>
                        /
                        <li><a href="#" class="active">Agent</a></li>
                    </ul>
                </div>
                <a href="create.php" class="report">
                    <i class='bx bx-plus'></i>
                    <span>add new agent</span>
                </a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($agents)) : ?>
                        <?php $no = 1 ?>
                        <?php foreach ($agents as $agent) : ?>
                            <tr>
                                <td><?= htmlspecialchars($no++) ?></td>
                                <td><?= htmlspecialchars($agent['name']) ?></td>
                                <td><?= htmlspecialchars($agent['email']) ?></td>
                                <td><?= htmlspecialchars($agent['phone']) ?></td>
                                <td class="action-buttons">
                                    <form action="update.php" method="get" style="display: inline;">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($agent['id']) ?>">
                                        <button type="submit" class="btn-edit">Edit</button>
                                    </form>
                                    <form action="delete.php" method="post" style="display: inline;" id="deleteForm">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($agent['id']) ?>">
                                        <button type="submit" id="submitButton" class="btn-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No customers found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForm = document.getElementById('deleteForm');
            document.getElementById('submitButton').addEventListener('click', function(event) {
                event.preventDefault(); // Menghentikan pengiriman formulir langsung
                Swal.fire({
                    title: 'Delete Data',
                    text: "Are you sure you want to submit this data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, submit it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteForm.submit();
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assetsAdmin/js/index.js"></script>
</body>

</html>