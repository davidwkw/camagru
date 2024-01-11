<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return;
}

try {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
} catch (Exception $e) {
    return;
}

// Remove all illegal characters from email
$email = filter_var($INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

// Validate e-mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo ("$email is a valid email address");
} else {
    echo ("$email is not a valid email address");
}
