<?php

function getBookingData()
{
  $data = $_SESSION["booking_data"] ?? [];
  unset($_SESSION["booking_data"]);
  return $data;
}

function checkBookingErrors($field)
{
  if (!isset($_SESSION["errors_booking"])) {
    return false;
  }

  return isset($_SESSION["errors_booking"][$field]);
}

function displayBookingErrors()
{
  if (!isset($_SESSION["errors_booking"])) {
    return;
  }

  $errors = $_SESSION["errors_booking"];

  echo '<div class="error-box">';
  foreach ($errors as $error) {
    echo '<p>• ' . htmlspecialchars($error) . '</p>';
  }
  echo '</div>';
}

function displayBookingSuccess()
{
  if (!isset($_SESSION["booking_success"])) {
    return;
  }
  echo '<div class="success-box">';
  echo '<p>' . htmlspecialchars($_SESSION["booking_success"]) . '</p>';
  echo '</div>';
}

function displayCancelBookingError()
{
  if (!isset($_SESSION["error_cancel_booking"])) {
    return;
  }

  echo '<div class="error-box">';
  echo '<p>• ' . htmlspecialchars($_SESSION["error_cancel_booking"]) . '</p>';
  echo '</div>';
}
