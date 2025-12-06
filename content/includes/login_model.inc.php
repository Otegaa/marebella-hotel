<?php

function getUser($pdo, $username)
{
  $query = "SELECT * FROM customers WHERE username = :username";
  $stmt = $pdo->prepare($query);
  $stmt->execute([":username" => $username]);

  return $stmt->fetch(PDO::FETCH_ASSOC);
}
