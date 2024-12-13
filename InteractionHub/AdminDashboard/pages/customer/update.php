<?php
session_start();
include '../../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = "SELECT * FROM customers WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$customer) {
            die("Customer not found!");
        }
    } catch (PDOException $e) {
        die("ERROR: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    try {
        $sql = "UPDATE customers SET name = :name, email = :email, phone = :phone, address = :address WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);

        if ($stmt->execute()) {
            header("Location: customer.php");
            exit;
        }
    } catch (PDOException $e) {
        die("ERROR: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../assetsAdmin/css/style.css">
    <link rel="stylesheet" href="../../assetsAdmin/css/pages.css">
    <link href="../../images/ih-logo-design_695270-414-Photoroom.png" rel="icon">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <img src="../../images/ih-logo-design_695270-414-Photoroom.png" alt="InteractionHub" width="30px"
                style="margin-right: 5px;margin-left: 24px;">
            <div class="logo-name"><span>Interac</span>Hub</div>
        </a>
        <ul class="side-menu">
            <li><a href="../../index.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="../user.php"><i class='bx bx-group'></i>Users</a></li>
            <li class="active"><a href=""><i class='bx bx-store-alt'></i>Customer</a></li>
            <li><a href="#"><i class='bx bx-analyse'></i>Analytics</a></li>
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

    <!-- Main Content -->
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
                        <li><a href="#" class="active">Customer</a></li>
                    </ul>
                </div>
            </div>
            <div>
                <!-- Content -->
                <form action="update.php" method="post" id="formUpdate" class="form">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($customer['id']) ?>">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="<?= htmlspecialchars($customer['name']) ?>" required><br>

                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($customer['email']) ?>" required><br>

                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($customer['phone']) ?>" required><br>

                    <label for="address">Address:</label>
                    <input type="text" name="address" id="address" value="<?= htmlspecialchars($customer['address']) ?>" required><br>

                    <button type="submit" id="submitButton">Save Changes</button>
                </form>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('submitButton').addEventListener('click', function (event) {
                event.preventDefault(); // Cegah pengiriman default form
                Swal.fire({
                    title: 'Update Data',
                    text: "Are you sure you want to update this data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim formulir setelah konfirmasi
                        document.getElementById('formUpdate').submit();
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../index.js"></script>
</body>

</html>
