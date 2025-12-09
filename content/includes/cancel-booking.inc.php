<?php

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
  require_once 'config_session.inc.php';

  if (!isset($_SESSION["user_id"])) {
    $_SESSION["error_cancel_booking"] = "Please login to cancel a booking!.";
    header("Location: ../login.php");
    exit();
  }

  require_once 'dbh.inc.php';
  require_once 'booking_model.inc.php';

  $reservation_id = filter_var($_POST["reservation_id"], FILTER_VALIDATE_INT);
  $user_id = $_SESSION["user_id"];

  if (!$reservation_id || $reservation_id <= 0) {
    $_SESSION["error_cancel_booking"] = "Invalid booking selection.";
    header("Location: ../my-bookings.php");
    exit();
  }

  try {
    $booking = verifyUserBooking($pdo, $reservation_id, $user_id);

    if (!$booking) {
      $_SESSION["error_cancel_booking"] = "Booking not found.";
      header("Location: ../my-bookings.php");
      exit();
    }

    if ($booking["booking_status"] === 'cancelled') {
      $_SESSION["error_cancel_booking"] = "This booking is already cancelled.";
      header("Location: ../my-bookings.php");
      exit();
    }

    $success = cancelBooking($pdo, $reservation_id, $user_id);

    if ($success) {
      $_SESSION["booking_success"] = "Booking #$reservation_id has been cancelled successfully.";
    } else {
      $_SESSION["error_cancel_booking"] = "Failed to cancel booking. Please try again.";
    }

    header("Location: ../my-bookings.php");
    exit();
  } catch (PDOException $e) {
    die("Cancellation failed " . $e->getMessage());
  }
} else {
  header("Location: ../my-bookings.php");
  exit();
}
