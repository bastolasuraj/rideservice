<?php
$title = "Ride Tracker";
include 'session.php';
if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}
$title = "Ride Management";
include 'db/db_connect.php';
include 'templates/header.php';

?>

<main>
    <section>
        <h2>Welcome, <?= $_SESSION['username']; ?>!</h2>

    </section>
</main>

<?php include 'templates/footer.php'; ?>
