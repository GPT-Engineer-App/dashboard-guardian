<?php
session_start();

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function require_login() {
    if (!is_logged_in()) {
        redirect('/login.php');
    }
}

function is_super_user() {
    return $_SESSION['role'] === 'super_user';
}

function require_super_user() {
    if (!is_super_user()) {
        redirect('/dashboard.php');
    }
}
