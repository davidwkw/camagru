<?php

define("REGISTRATION_SUCCESS_SUBJECT", "Congratulations! Successful registration to Camagru");
define("MAIL_CONTENT_TYPE", "MIME-Version: 1.0\r\nContent-type:text/html;charset=UTF-8\r\n");

function mailSuccessfulRegistration(string $recipientEmail, string $username = "")
{
    $to = "$username $recipientEmail";
    $to = trim($to);

    // Always set content-type when sending HTML email
    $headers = MAIL_CONTENT_TYPE;
    $headers .= 'From: <camagru@42.com>' . "\r\n";
    // built-in mail imposes a 70 line limit for the message
    $message = wordwrap(include("./templates/email/registration.html"), 70, "\r\n"); // not sure if this is entirely necessary with html template?

    mail($to, REGISTRATION_SUCCESS_SUBJECT, $message, $headers);
}
