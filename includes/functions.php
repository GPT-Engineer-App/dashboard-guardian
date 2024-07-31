<?php
function password_hash($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function verify_password($password, $hash) {
    return password_verify($password, $hash);
}

function redirect($location) {
    header("Location: $location");
    exit;
}
