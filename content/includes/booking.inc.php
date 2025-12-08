<?php
require_once 'config_session.inc.php';
require_once 'dbh.inc.php';
require_once 'booking_model.inc.php';
require_once 'booking_contr.inc.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
  $customer_id = $_SESSION["user_id"];
  $room_id = filter_var($_POST["room_id"], FILTER_VALIDATE_INT);
  $checkin_date = $_POST["checkin_date"];
  $checkout_date = $_POST["checkout_date"];
  $num_guests = filter_var($_POST["number_guests"], FILTER_VALIDATE_INT);
  $booking_notes = trim($_POST["booking_notes"]) ?: null;


  try {
    $errors = [];

    $room = getRoom($pdo, $room_id);

    if (!$room) {
      $errors["room_unavailable"] = "Room not available!";
    }

    if (isBookingInputEmpty($num_guests, $checkin_date, $checkout_date)) {
      $errors["empty_input"] = "Please fill in all required fields!";
    }

    if (isCheckinInPast($checkin_date)) {
      $errors["checkin_past"] = "Check-in date cannot be in the past!";
    }

    if (isCheckoutBeforeCheckin($checkin_date, $checkout_date)) {
      $errors["checkout_before"] = "Check-out must be after check-in!";
    }

    if (isStayTooShort($checkin_date, $checkout_date)) {
      $errors["stay_short"] = "Minimum stay is 1 night!";
    }

    if (isNumberOfGuestsInvalid($num_guests)) {
      $errors["guests_invalid"] = "Please enter a valid number of guests!";
    }

    if (isGuestsExceedCapacity($num_guests, $room['max_occupancy'])) {
      $errors["guests_exceed"] = "Maximum {$room['max_occupancy']} guests for this room!";
    }

    if (isRoomAlreadyBooked($pdo, $room_id, $checkin_date, $checkout_date)) {
      $errors["room_booked"] = "This room is already booked for your selected dates!";
    }

    if ($errors) {
      $_SESSION["errors_booking"] = $errors;
      $_SESSION["booking_data"] = [
        'checkin_date' => $checkin_date,
        'checkout_date' => $checkout_date,
        'number_guests' => $num_guests,
        'booking_notes' => $booking_notes
      ];

      header("Location: ../booking.php?room_id=$room_id");
      exit();
    }

    // Calculate total price after validation
    $checkin = new DateTime($checkin_date);
    $checkout = new DateTime($checkout_date);
    $nights = $checkin->diff($checkout)->days;

    $room_price = $room["price_per_night"];
    $total_price = $nights * $room_price;

    $reservationID = createBooking($pdo, $room_id, $customer_id, $num_guests, $checkin_date, $checkout_date, $booking_notes, $total_price);

    $_SESSION["booking_success"] = "Booking confirmed! Your reservation id is #" . $reservationID;

    $pdo = null;
    $stmt = null;

    header("Location: ../my-bookings.php");
    exit();
  } catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
  }
} else {
  header("Location: booking.php");
  exit();
}
