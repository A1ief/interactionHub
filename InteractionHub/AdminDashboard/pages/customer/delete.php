<?php
session_start();
include '../../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $sql = "DELETE FROM customers WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    title: 'Deleted!',
                    text: 'The customer has been deleted.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>";
            header("Location: customer.php"); 
            exit; 
        }
    } catch (PDOException $e) {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: '" . $e->getMessage() . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
