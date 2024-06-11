<?php
function deleteRide($pdo, $ride_id) {
    $stmt = $pdo->prepare("DELETE FROM rides WHERE id = ?");
    $stmt->execute([$ride_id]);
    header('Location: ride.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rider_id = trim($_POST['rider']);
    $ride_type = trim($_POST['ride_type']);
    $city_id = trim($_POST['city']);
    $date = trim($_POST['date']);
    if (isset($_POST['delete']) && isset($_GET['ride_id'])) {
        deleteRide($pdo, $_GET['ride_id']);
    }
    if (empty($rider_id) || empty($ride_type) || empty($city_id) || empty($date)) {
        $error = "All fields are required!";
    } else {
        $stmt = isset($_GET['ride_id']) ? 
            $pdo->prepare("UPDATE rides SET rider_id = ?, ride_type = ?, city_id = ?, date = ? WHERE id = ?") : 
            $pdo->prepare("INSERT INTO rides (rider_id, ride_type, city_id, date) VALUES (?, ?, ?, ?)");
        $params = isset($_GET['ride_id']) ? [$rider_id, $ride_type, $city_id, $date, $_GET['ride_id']] : [$rider_id, $ride_type, $city_id, $date];
        $stmt->execute($params);
        header('Location: ride.php');
        exit();
    }
}

$ride = [
    'rider_id' => '',
    'ride_type' => '',
    'city_id' => '',
    'date' => ''
];
if (isset($_GET['ride_id'])) {
    $stmt = $pdo->prepare("SELECT rider_id, ride_type, city_id, date FROM rides WHERE id = ?");
    $stmt->execute([$_GET['ride_id']]);
    $ride = $stmt->fetch(PDO::FETCH_ASSOC);
}

$riders = [];
$cities = [];
try {
    $stmt = $pdo->prepare("SELECT rider_id, name FROM riders");
    $stmt->execute();
    $riders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT city_id, name FROM cities");
    $stmt->execute();
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Error: " . $e->getMessage();
}
?>

<section id="rideEntrySection">
    <form id="rideEntryForm" method="POST">
        <h2><?= isset($_GET['ride_id']) ? 'Update Ride' : 'Add Ride'; ?></h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <label for="rider">Rider:</label>
        <select id="rider" name="rider">
            <?php foreach ($riders as $rider): ?>
                <option value="<?= htmlspecialchars($rider['rider_id']); ?>" <?= $ride['rider_id'] == $rider['rider_id'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($rider['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="ride_type">Ride Type:</label>
        <input type="text" id="ride_type" name="ride_type" value="<?= htmlspecialchars($ride['ride_type']); ?>">
        <label for="city">City:</label>
        <select id="city" name="city">
            <?php foreach ($cities as $city): ?>
                <option value="<?= htmlspecialchars($city['city_id']); ?>" <?= $ride['city_id'] == $city['city_id'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($city['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?= htmlspecialchars($ride['date']); ?>">
        <button type="submit" name="submit"><?= isset($_GET['ride_id']) ? 'Update Ride' : 'Add Ride'; ?></button>
        <?php if (isset($_GET['ride_id'])): ?>
            <button type="submit" name="delete">Delete Ride</button>
        <?php endif; ?>
    </form>
</section>
