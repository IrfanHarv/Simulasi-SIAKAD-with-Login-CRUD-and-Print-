<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

include 'includes/header.php';
?>

<h1>Dashboard</h1>
<p>Selamat datang, <?php echo $_SESSION['username']; ?>!</p>

<?php include 'includes/footer.php'; ?>
