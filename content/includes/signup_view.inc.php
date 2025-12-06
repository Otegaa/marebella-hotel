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

  echo '<div class="error-box">';
  foreach ($errors as $error) {
    echo '<p>• ' . htmlspecialchars($error) . '</p>';
  }
  echo '</div>';
}
