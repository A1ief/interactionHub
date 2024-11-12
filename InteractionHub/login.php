<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pw = $_POST['password'];

    $sql = "SELECT * FROM login WHERE email = :email";
    $login = $pdo->prepare($sql);
    $login->bindParam(':email', $email);
    $login->execute();
    $user = $login->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($pw, $user['password'])) {
        $_SESSION['email'] = $email;
        header('Location: AdminDashboard/index.php');
    } else {
        echo "Email atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/loginRegister.css" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <input type="checkbox" id="check">
        <div class="login form">
            <header>Login</header>
            <form action="login.php" method="POST">
                <input type="email" name="email" id="inputEmail" placeholder="Enter your email">
                <input type="password" name="password" id="inputPassword" placeholder="Enter your password">
                <a href="#">Forgot password?</a>
                <input type="submit" class="button" value="Login">
                <!-- <a onclick="saveToLocalStorage()" href="Admin Dashboard/index.php">
                
            </a> -->
            </form>
            <div class="signup">
                <span class="signup">Don't have an account?
                    <label for="check"><a href="register.php">Register</a></label>
                </span>
            </div>
        </div>
    </div>
    <!-- <script>
        function saveToLocalStorage() {
            const email = document.getElementById('inputEmail').value;
            const password = document.getElementById('inputPassword').value;

            localStorage.setItem('storedEmail', email);
            localStorage.setItem('storedPassword', password);

            alert('Data disimpan di localStorage!');
        }
    </script> -->
</body>

</html>