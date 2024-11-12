<?php
session_start();

// Menghapus semua variabel sesi
session_unset();

// Menghancurkan sesi
session_destroy();

// Redirect ke halaman login setelah logout
header("Location: login.php");
exit();
?>