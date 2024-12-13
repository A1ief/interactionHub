<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assetsAdmin/css/style.css">
    <link href="images/ih-logo-design_695270-414-Photoroom.png" rel="icon">
    <title>Admin Dashboard</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <!-- <i class='bx bx-code-alt'></i> -->
            <img src="../assetsAdmin/images/ih-logo-design_695270-414-Photoroom.png" alt="InteractionHub" width="30px"
                style="margin-right: 5px;margin-left: 24px;">
            <div class="logo-name"><span>Interac</span>Hub</div>
        </a>
        <ul class="side-menu">
            <li><a href="../index.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li class="active"><a href=""><i class='bx bx-group'></i>Users</a></li>
            <li><a href="customer/customer.php"><i class='bx bxs-user-detail'></i>Customer</a></li>
            <li><a href="agent/agent.php"><i class='bx bx-analyse'></i>Agent</a></li>
            <li><a href="#"><i class='bx bx-message-square-dots'></i>Tickets</a></li>
            <li><a href="#"><i class='bx bx-cog'></i>Settings</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="../../logout.php" class="logout">
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
                <img src="images/logo.png">
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
                        <li><a href="#" class="active">Users</a></li>
                    </ul>
                </div>
                <a href="#" class="report">
                    <i class='bx bx-cloud-download'></i>
                    <span>Download CSV</span>
                </a>
            </div>
            <div class="api">
                <h2>User Data</h2>
                <button onclick="getUserData()" class="button">Fetch User Data</button>

                <!-- Template untuk User Data -->
                <template id="user-template" class="api">
                    <div class="user-data">
                        <p><strong>Name:</strong> <span class="name"></span></p>
                        <p><strong>Username:</strong> <span class="username"></span></p>
                        <p><strong>Email:</strong> <span class="email"></span></p>
                        <p><strong>Phone:</strong> <span class="phone"></span></p>
                        <p><strong>Website:</strong> <span class="website"></span></p>
                        <p><strong>Company:</strong> <span class="company"></span></p>
                    </div>
                </template>

                <!-- Container untuk User Data -->
                <div id="userDataContainer">
                    <!-- User data akan disalin dari template dan ditampilkan di sini -->
                </div>
            </div>
        </main>

    </div>

    <script src="../index.js"></script>
</body>

</html>