<?php
$files = [
    'templates/city_form.php',
    'templates/city_table.php',
    'templates/footer.php',
    'templates/header.php',
    'templates/login_form.php',
    'templates/navbar.php',
    'templates/register_form.php',
    'templates/ride_form.php',
    'templates/ride_table.php',
    'templates/rider_form.php',
    'templates/rider_table.php',
    'session.php',
    'ride.php',
    'index.php',
    'rider.php',
    'city.php',
    'logout.php',
    'login.php',
    'register.php',
    'delete.php',
    'css/styles.css',
    'db/db_connect.php',
//    'js/script.js',
    'sql/create_tables.sql',
];

foreach ($files as $file) {
    echo $file . '<br> -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- <br>';
    echo htmlspecialchars(file_get_contents($file));
    echo '<br> -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- <br>';


}
//
//$fp = fopen('newcombined.txt', 'w');
//if (!$fp)
//    die('Could not create / open text file for writing.');
//if (fwrite($fp, $txt1) === false)
//    die('Could not write to text file.');
//
//echo 'Text files have been merged.';
//
