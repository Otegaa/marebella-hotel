<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
  'lifetime' => 1800,
  'domain' => 'localhost',
  'path' => '/',
  'secure' => isset($_SERVER['HTTPS']),
  'httponly' => true,
  'samesite' => 'Strict'
]);

session_start();

// Regenerate session ID every 30 minutes
if (!isset($_SESSION['last_regeneration'])) {
  session_regenerate_id(true);
  $_SESSION['last_regeneration'] = time();
} else {
  $interval = 30 * 60;

  if (time() - $_SESSION['last_regeneration'] >= $interval) {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
  }
}
