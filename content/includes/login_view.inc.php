<?php

function displaySuccessMessage()
{
  if (!isset($_SESSION["registration_successful"])) {
    return;
  }
  echo '<div class="success-box">';
  echo '<p>' . htmlspecialchars($_SESSION["registration_successful"]) . '</p>';
  echo '</div>';

  unset($_SESSION["registration_successful"]);
}

function displayLoginErrors()
{
  if (!isset($_SESSION["errors_login"])) {
    return;
  }

  $errors = $_SESSION["errors_login"];

  echo '<div class="error-box">';
  foreach ($errors as $error) {
    echo '<p>• ' . htmlspecialchars($error) . '</p>';
  }
  echo '</div>';
}

function displayNotLoggedInError()
{
  if (!isset($_SESSION["error_not_logged_in_book"])) {
    return;
  }

  echo '<div class="error-box">';
  echo '<p>• ' . htmlspecialchars($_SESSION["error_not_logged_in_book"]) . '</p>';
  echo '</div>';
}

function displayMyBookingsError()
{
  if (!isset($_SESSION["error_my_bookings"])) {
    return;
  }

  echo '<div class="error-box">';
  echo '<p>• ' . htmlspecialchars($_SESSION["error_my_bookings"]) . '</p>';
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
