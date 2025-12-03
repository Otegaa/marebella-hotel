<?php
if ($_SERVER['SERVER_NAME'] === 'localhost') {
  // XAMPP
  $host = 'localhost';
  $dbname = 'w25013132';
  $dbusername = 'root';
  $dbpassword = '';
} else {
  // Nuwebspace
  $host = 'localhost';
  $dbname = 'w25013132';
  $dbusername = 'w25013132';
  $dbpassword = '';
}

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $dbusername, $dbpassword);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}
