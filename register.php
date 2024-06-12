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

<div id="registerForm" class="box">
    <h1 class="title">Register</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form id="register" action="register.php" method="post">
        <div class="field">
            <label class="label" for="username">Username</label>
            <div class="control">
                <input class="input" type="text" name="username" required>
            </div>
        </div>
        <div class="field">
            <label class="label" for="password">Password</label>
            <div class="control">
                <input class="input" type="password" name="password" required>
            </div>
        </div>
        <div class="field">
            <label class="label" for="confirm_password">Confirm Password</label>
            <div class="control">
                <input class="input" type="password" name="confirmPassword" required>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button class="button is-link" type="submit">Register</button>
            </div>
        </div>
    </form>
</div>
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
