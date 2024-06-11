<?php
function deleteCity($pdo, $city_id) {
    $stmt = $pdo->prepare("DELETE FROM cities WHERE city_id = ?");
    $stmt->execute([$city_id]);
    header('Location: city.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $city = trim($_POST['city']);
    if (isset($_POST['delete']) && isset($_GET['city_id'])) {
        deleteCity($pdo, $_GET['city_id']);
    }
    if (empty($city)) {
        $error = "City name cannot be empty!";
    } else {
        $stmt = isset($_GET['city_id']) ? 
            $pdo->prepare("UPDATE cities SET name = ? WHERE city_id = ?") : 
            $pdo->prepare("INSERT INTO cities (name) VALUES (?)");
        $params = isset($_GET['city_id']) ? [$city, $_GET['city_id']] : [$city];
        $stmt->execute($params);
        header('Location: city.php');
        exit();
    }
}

$city_name = '';
if (isset($_GET['city_id'])) {
    $stmt = $pdo->prepare("SELECT name FROM cities WHERE city_id = ?");
    $stmt->execute([$_GET['city_id']]);
    $city = $stmt->fetch();
    if ($city) {
        $city_name = $city['name'];
    }
}
?>

<section id="cityEntrySection">
    <form id="cityEntryForm" method="POST">
        <h2><?= isset($_GET['city_id']) ? 'Update City' : 'Add City'; ?></h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <label for="city">City:</label>
        <input type="text" id="city" name="city" value="<?= htmlspecialchars($city_name); ?>">
        <button type="submit" name="submit"><?= isset($_GET['city_id']) ? 'Update City' : 'Add City'; ?></button>
        <?php if (isset($_GET['city_id'])): ?>
            <button type="submit" name="delete">Delete City</button>
        <?php endif; ?>
    </form>
</section>
