<?php 
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $pw = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

  $sql = "INSERT INTO login (email, password) VALUES (:email, :password)";
  $register = $pdo->prepare($sql);
  $register->bindParam(':email', $email);
  $register->bindParam(':password', $pw);

  try {
    $register->execute();
    $_SESSION['email'] = $email;
    header('Location: AdminDashboard/index.php');
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/loginRegister.css" rel="stylesheet">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="registration form">
            <header>Signup</header>
            <form action="register.php" method="POST">
              <input type="email" name="email" placeholder="Enter your email" required>
              <input type="password" name="password" placeholder="Create a password" required>
              <input type="submit" class="button" value="Signup">
            </form>
            <div class="signup">
              <span class="signup">Already have an account?
               <label for="check"><a href="login.php">Login</a></label>
              </span>
            </div>
          </div>
    </div>
</body>
</html>
