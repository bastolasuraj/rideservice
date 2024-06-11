<?php
function deleteCity($pdo, $city_id) {
$stmt = $pdo->prepare("DELETE FROM cities WHERE city_id = ?");
$stmt->execute([$city_id]);
header('Location: city.php');
}
