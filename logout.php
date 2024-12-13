<?php
    // Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page (or any other page you prefer)
header("Location: login.html");
exit();