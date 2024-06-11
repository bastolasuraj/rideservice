<nav class="navbar is-dark">
    <div class="date"><?php echo date('Y-m-d'); ?></div>
    <div class="navbar-brand">
        <span class="navbar-item">My Ride Service</span>
        <?php if (isset($_SESSION['username'])): ?>
            <span class="navbar-item"><a href="rider.php">Rider</a></span>
            <span class="navbar-item"><a href="city.php">City</a></span>
            <span class="navbar-item"><a href="ride.php">Ride</a></span>
        <?php endif; ?>
    </div>
    <div class="navbar-menu">
        <div class="navbar-start">
            <span class="navbar-item" id="current-date"></span>
        </div>
        <div class="navbar-end auth">
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php" class="navbar-item">Logout</a>
            <?php else: ?>
                <a href="login.php" class="navbar-item">Login</a>
                <a href="register.php" class="navbar-item">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
