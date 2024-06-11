<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['username']);
}

function logout() {
    session_unset();
    session_destroy();
}

function regenerateSession() {
    if (!isset($_SESSION['CREATED'])) {
        $_SESSION['CREATED'] = time();
    } else if (time() - $_SESSION['CREATED'] > 3000) { // 30 minutes
        session_regenerate_id(true);
        $_SESSION['CREATED'] = time();
    }
}
?>
