<?php
include 'session.php';
$title = "Register";
include 'db/db_connect.php';
include 'templates/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password_hash]);
        header('Location: login.php');
        exit();
    }
}
?>

<form id="registerForm" method="POST" action="register.php">
    <h2>Register</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>

    <button type="submit">Register</button>
</form>

<script>
    document.getElementById('registerForm').addEventListener('submit', function(event) {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var confirm_password = document.getElementById('confirm_password').value;
        if (username === '' || password === '' || confirm_password === '') {
            event.preventDefault();
            alert('Please fill in all fields.');
        } else if (password !== confirm_password) {
            event.preventDefault();
            alert('Passwords do not match.');
        }
    });
</script>

<?php include 'templates/footer.php'; ?>
