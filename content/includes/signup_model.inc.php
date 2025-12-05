<?php

function getUsername($pdo, $username)
{
  $query = "SELECT username FROM customers WHERE username = :username";
  $stmt = $pdo->prepare($query);
  $stmt->execute([":username" => $username]);

  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getEmail($pdo, $email)
{
  $query = "SELECT customer_email FROM customers WHERE customer_email = :email";
  $stmt = $pdo->prepare($query);
  $stmt->execute([":email" => $email]);

  return $stmt->fetch(PDO::FETCH_ASSOC);
}


function createUser($pdo, $username, $password, $firstname, $lastname, $email, $dob, $phone)
{
  $password_hash = password_hash($password, PASSWORD_DEFAULT);

  $query = "INSERT INTO customers(username, password_hash, customer_forename, customer_surname, customer_email, date_of_birth, phone) VALUES(:username, :password_hash, :firstname, :lastname, :email, :dob, :phone)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    ":username" => $username,
    ":password_hash" => $password_hash,
    ":firstname" => $firstname,
    ":lastname" => $lastname,
    ":email" => $email,
    ":dob" => $dob,
    ":phone" => $phone
  ]);
}
