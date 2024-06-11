<?php
function deleteRider($pdo, $rider_id) {
    $stmt = $pdo->prepare("DELETE FROM riders WHERE rider_id = ?");
    $stmt->execute([$rider_id]);
    header('Location: rider.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rider = trim($_POST['rider']);

    if (isset($_POST['delete']) && isset($_GET['rider_id'])) {
        deleteRider($pdo, $_GET['rider_id']);
        header('Location: rider.php');
        exit();
    }

    if (empty($rider)) {
        $error = "Rider name cannot be empty!";
    } else {
        $stmt = isset($_GET['rider_id']) ?
            $pdo->prepare("UPDATE riders SET name = ? WHERE rider_id = ?") :
            $pdo->prepare("INSERT INTO riders (name) VALUES (?)");

        $params = isset($_GET['rider_id']) ? [$rider, $_GET['rider_id']] : [$rider];
        $stmt->execute($params);

        header('Location: rider.php');
        exit();
    }
}

$rider_name = '';
if (isset($_GET['rider_id'])) {
    $stmt = $pdo->prepare("SELECT name FROM riders WHERE rider_id = ?");
    $stmt->execute([$_GET['rider_id']]);
    $rider = $stmt->fetch();
    if ($rider) {
        $rider_name = $rider['name'];
    }
}
?>

<section id="riderEntrySection">
    <form id="riderEntryForm" method="POST">
        <h2><?= isset($_GET['rider_id']) ? 'Update Rider' : 'Add Rider'; ?></h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <label for="rider">Rider:</label>
        <input type="text" id="rider" name="rider" value="<?= htmlspecialchars($rider_name); ?>">
        <button type="submit" name="submit"><?= isset($_GET['rider_id']) ? 'Update Rider' : 'Add Rider'; ?></button>
        <?php if (isset($_GET['rider_id'])): ?>
            <button type="submit" name="delete">Delete Rider</button>
        <?php endif; ?>
    </form>
</section>
