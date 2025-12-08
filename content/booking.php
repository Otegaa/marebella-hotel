<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';
require_once 'includes/booking_model.inc.php';
require_once 'includes/booking_view.inc.php';

if (!isset($_SESSION["user_id"])) {
  $_SESSION["redirect_after_login"] = "booking.php?room_id=" . $_GET["room_id"];
  $_SESSION["error_not_logged_in_book"] = "Please login to book a room.";
  header("Location: login.php");
  exit();
}

if (!isset($_GET["room_id"])) {
  $_SESSION["error"] = "No room selected.";
  header("Location: rooms.php");
  exit();
}

$room_id = filter_var($_GET["room_id"], FILTER_VALIDATE_INT);

if (!$room_id || $room_id <= 0) {
  $_SESSION["error"] = "Invalid room selection.";
  header("Location: rooms.php");
  exit();
}


try {
  $room =  getRoom($pdo, $room_id);
  if (!$room) {
    $_SESSION["error"] = "Room not found.";
    header("Location: rooms.php");
    exit();
  }
} catch (PDOException $e) {
  die("Query failed: " . $e->getMessage());
}

// Get old booking data (for form repopulation)
$booking_data = getBookingData();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/stylesheets/styles.css" />
  <link
    rel="apple-touch-icon"
    sizes="180x180"
    href="../assets/favicon_io/apple-touch-icon.png" />
  <link
    rel="icon"
    type="image/png"
    sizes="32x32"
    href="../assets/favicon_io/favicon-32x32.png" />
  <link
    rel="icon"
    type="image/png"
    sizes="16x16"
    href="../assets/favicon_io/favicon-16x16.png" />
  <link rel="manifest" href="../assets/favicon_io/site.webmanifest" />
  <script
    src="https://kit.fontawesome.com/68aea0d1de.js"
    crossorigin="anonymous"></script>
  <title>Book <?php echo htmlspecialchars($room['accommodation_name']); ?> - MareBella Hotel</title>
</head>

<body>
  <?php require_once 'includes/header.inc.php' ?>

  <main>
    <section class="breadcrumb">
      <div class="breadcrumb-container">
        <a href="homepage.php">Home</a>
        <span> / </span>
        <a href="rooms.php">Rooms & Suites</a>
        <span> / </span>
        <a href="room-details.php?id=<?php echo $room['accommodationID']; ?>">
          <?php echo htmlspecialchars($room['accommodation_name']); ?>
        </a>
        <span> / </span>
        <span>Book Room</span>
      </div>
    </section>

    <!-- Booking Container -->
    <section class="booking-container">

      <h1>Complete Your Booking</h1>

      <div class="booking-layout">

        <div class="room-summary-card">
          <h3>Room Details</h3>

          <img
            src="<?php echo htmlspecialchars($room['session_imagepath']); ?>"
            alt="<?php echo htmlspecialchars($room['accommodation_name']); ?>"
            class="room-summary-image">

          <h4><?php echo htmlspecialchars($room['accommodation_name']); ?></h4>

          <div class="summary-info">
            <div class="summary-item">
              <i class="fa-solid fa-ruler-combined"></i>
              <span><?php echo htmlspecialchars($room['room_size']); ?></span>
            </div>

            <div class="summary-item">
              <i class="fa-solid fa-bed"></i>
              <span><?php echo htmlspecialchars($room['bed_type']); ?></span>
            </div>

            <div class="summary-item">
              <i class="fa-solid fa-user-group"></i>
              <span>Up to <?php echo $room['max_occupancy']; ?> guests</span>
            </div>
          </div>

          <div class="summary-price">
            <span class="price-label">Price per night:</span>
            <span class="price-value">€<?php echo number_format($room['price_per_night'], 2); ?></span>
          </div>
        </div>

        <div class="booking-form-container">

          <h3>Booking Information</h3>

          <?php
          displayBookingErrors();
          ?>

          <form action="includes/booking.inc.php" method="POST" novalidate>

            <!-- Hidden room_id for processing the correct room id -->
            <input type="hidden" name="room_id" value="<?php echo $room['accommodationID']; ?>">

            <div class="form-group">
              <label for="checkin_date">Check-in Date</label>
              <input
                type="date"
                name="checkin_date"
                id="checkin_date"
                min="<?php echo date('Y-m-d'); ?>"
                class="<?php echo checkBookingErrors('checkin_past') || checkBookingErrors('room_booked') ? 'input-error' : ''; ?>"
                value="<?php echo htmlspecialchars($booking_data['checkin_date'] ?? ''); ?>"
                required>
            </div>

            <div class="form-group">
              <label for="checkout_date">Check-out Date</label>
              <input
                type="date"
                name="checkout_date"
                id="checkout_date"
                min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                class="<?php echo checkBookingErrors('checkout_before') || checkBookingErrors('stay_short') || checkBookingErrors('room_booked')  ? 'input-error' : ''; ?>"
                value="<?php echo htmlspecialchars($booking_data['checkout_date'] ?? ''); ?>"
                required>
            </div>

            <div class="form-group">
              <label for="number_guests">Number of Guests</label>
              <input
                type="number"
                name="number_guests"
                id="number_guests"
                min="1"
                max="<?php echo $room['max_occupancy']; ?>"
                class="<?php echo checkBookingErrors('guests_invalid') || checkBookingErrors('guests_exceed') ? 'input-error' : ''; ?>"
                value="<?php echo htmlspecialchars($booking_data['number_guests'] ?? '1'); ?>"
                required>
              <span class="form-helper">Maximum <?php echo $room['max_occupancy']; ?> <?php echo $room['max_occupancy'] > 1 ? 'guests' : 'guest';  ?></span>
            </div>

            <div class="form-group">
              <label for="booking_notes">Special Requests (Optional)</label>
              <textarea
                name="booking_notes"
                id="booking_notes"
                rows="4"
                placeholder="Any special requests? (e.g., early check-in, celebrating special occasion)"><?php echo htmlspecialchars($booking_data['booking_notes'] ?? ''); ?></textarea>
            </div>

            <button type="submit" class="btn-submit">
              <i class="fa-solid fa-calendar-check"></i> Confirm Booking
            </button>
          </form>
        </div>
      </div>
    </section>

    <!-- Booking information -->
    <section class="booking-info-container">
      <h2>Booking Information</h2>
      <div class="booking-info">
        <div class="booking-info-group">
          <h3>Check-in & check-out</h3>
          <ul>
            <li>Check-in: From 3:00 PM</li>
            <li>Check-out: Until 12:00 PM</li>
            <li>Early check-in available upon request</li>
            <li>Express check-in for suite guests</li>
          </ul>
        </div>
        <div class="booking-info-group">
          <h3>Cancellation Policy</h3>
          <ul>
            <li>Free cancellation up to 7 days before arrival</li>
            <li>50% charge for cancellations 3-7 days before</li>
            <li>Full charge for cancellations within 3 days</li>
            <li>Flexible rates available for extended stays</li>
          </ul>
        </div>
      </div>
    </section>

  </main>


  <?php require_once 'includes/footer.inc.php' ?>

  <?php
  unset($_SESSION["errors_booking"]);
  unset($_SESSION["booking_data"]);
  ?>

</body>

</html>