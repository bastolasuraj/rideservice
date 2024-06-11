<?php
include 'session.php';
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}
$title = "Ride Management";
include 'db/db_connect.php';
include 'templates/header.php';
?>

<main>
    <section>
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>

        <!-- Display rides and other data -->
    </section>
</main>

<?php include 'templates/footer.php'; ?>
