<?php

function getSignupData()
{
  $data = $_SESSION["signup_data"] ?? [];
  unset($_SESSION["signup_data"]);
  return $data;
}

function checkSignupErrors($field)
{
  if (!isset($_SESSION["errors_signup"])) {
    return false;
  }

  return isset($_SESSION["errors_signup"][$field]);
}

function displaySignupErrors()
{
  if (!isset($_SESSION["errors_signup"])) {
    return;
  }

  $errors = $_SESSION["errors_signup"];

  echo "<div>";
  foreach ($errors as $error) {
    echo "<p>" . htmlspecialchars($error) . "</p>";
  }
  echo "</div>";
}

function displaySuccessMessage()
{
  if (!isset($_SESSION["registration_successful"])) {
    return;
  }
  echo "<div>";
  echo "<p>" . htmlspecialchars($_SESSION["registration_successful"]) . "</p>";
  echo "</div>";

  unset($_SESSION["registration_successful"]);
}
