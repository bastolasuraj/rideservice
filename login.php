<?php
include 'session.php';
$title = "Login";
include 'db/db_connect.php';
include 'templates/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        regenerateSession();
        header('Location: index.php');
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<div id="loginForm" class="box">
    <h1 class="title">Login</h1>
    <form id="login" method="post" action="login.php">
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <div class="field">
            <label class="label" for="username">Username</label>
            <div class="control">
                <input class="input" type="text" name="username" id="username" required>
            </div>
        </div>
        <div class="field">
            <label class="label" for="password">Password</label>
            <div class="control">
                <input class="input" type="password" name="password" id="password" required>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button class="button is-link" type="submit">Login</button>
            </div>
        </div>
    </form>
</div>


<!--<script>-->
<!--    document.getElementById('loginForm').addEventListener('submit', function(event) {-->
<!--        var username = document.getElementById('username').value;-->
<!--        var password = document.getElementById('password').value;-->
<!--        if (username === '' || password === '') {-->
<!--            event.preventDefault();-->
<!--            alert('Please fill in both fields.');-->
<!--        }-->
<!--    });-->
<!--</script>-->

<?php include 'templates/footer.php'; ?>
