<?php
require_once 'includes/config_session.inc.php';

if (!isset($_SESSION["user_id"])) {
  $_SESSION["error_my_bookings"] = "Please login to view your bookings.";
  header("Location: login.php");
  exit();
}

require_once 'includes/dbh.inc.php';
require_once 'includes/booking_model.inc.php';
require_once 'includes/booking_view.inc.php';

$user_id = $_SESSION["user_id"];

try {
  $bookings = getUserBookings($pdo, $user_id);
} catch (PDOException $e) {
  die("Failed to load bookings: " . $e->getMessage());
}

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
  <script src="../assets//scripts/modal.js" defer></script>
  <title>My Bookings - MareBella Hotel</title>
</head>

<body>
  <!-- header -->
  <?php require_once 'includes/header.inc.php'; ?>

  <!-- main -->

  <main>
    <section class="breadcrumb">
      <div class="breadcrumb-container">
        <a href="homepage.php">Home</a>
        <span> / </span>
        <span>My Bookings</span>
      </div>
    </section>

    <section class="bookings-container">

      <div class="bookings-header">
        <h1>My Bookings</h1>
        <p class="welcome-text">Welcome back, <?php echo htmlspecialchars($_SESSION['user_firstname']); ?> <?php echo htmlspecialchars($_SESSION['user_lastname']); ?>!</p>
      </div>

      <?php
      displayBookingSuccess();
      displayCancelBookingError();
      ?>

      <?php if (empty($bookings)): ?>

        <div class="no-bookings">
          <i class="fa-solid fa-calendar-xmark"></i>
          <h3>No Bookings Yet</h3>
          <p>You haven't made any reservations yet. Start planning your perfect Santorini getaway!</p>
          <a href="rooms.php" class="btn-browse-rooms">
            <i class="fa-solid fa-bed"></i> Browse Our Rooms
          </a>
        </div>

      <?php else: ?>
        <div class="bookings-grid">
          <?php foreach ($bookings as $booking): ?>
            <?php
            $checkin = new DateTime($booking['checkin_date']);
            $checkout = new DateTime($booking['checkout_date']);
            $nights = $checkin->diff($checkout)->days;

            $checkin_formatted = date('M j, Y', strtotime($booking['checkin_date']));
            $checkout_formatted = date('M j, Y', strtotime($booking['checkout_date']));
            $booked_on = date('M j, Y', strtotime($booking['booking_date']));

            $status = $booking['booking_status'];
            $status_class = '';
            $status_icon = '';

            if ($status === 'confirmed') {
              $status_class = 'status-confirmed';
              $status_icon = 'fa-circle-check';
            } elseif ($status === 'cancelled') {
              $status_class = 'status-cancelled';
              $status_icon = 'fa-circle-xmark';
            } elseif ($status === 'completed') {
              $status_class = 'status-completed';
              $status_icon = 'fa-circle-check';
            }
            ?>

            <article class="booking-card">
              <div class="booking-card-header">
                <span class="reservation-number">
                  Reservation #<?php echo $booking['reservationID']; ?>
                </span>
                <span class="status-badge <?php echo $status_class; ?>">
                  <i class="fa-solid <?php echo $status_icon; ?>"></i>
                  <?php echo ucfirst($status); ?>
                </span>
              </div>

              <img
                src="<?php echo htmlspecialchars($booking['session_imagepath']); ?>"
                alt="<?php echo htmlspecialchars($booking['accommodation_name']); ?>"
                class="booking-card-image">

              <div class="booking-card-content">

                <h3 class="booking-room-name">
                  <?php echo htmlspecialchars($booking['accommodation_name']); ?>
                </h3>

                <div class="booking-room-info">
                  <span class="room-type-tag"><?php echo htmlspecialchars($booking['room_type']); ?></span>
                  <span class="room-detail-text">
                    <?php echo htmlspecialchars($booking['room_size']); ?> •
                    <?php echo htmlspecialchars($booking['bed_type']); ?>
                  </span>
                </div>

                <div class="booking-details-list">

                  <div class="booking-detail">
                    <i class="fa-solid fa-calendar-days"></i>
                    <div>
                      <strong>Check-in:</strong>
                      <span><?php echo $checkin_formatted; ?></span>
                    </div>
                  </div>

                  <div class="booking-detail">
                    <i class="fa-solid fa-calendar-days"></i>
                    <div>
                      <strong>Check-out:</strong>
                      <span><?php echo $checkout_formatted; ?></span>
                    </div>
                  </div>

                  <div class="booking-detail">
                    <i class="fa-solid fa-moon"></i>
                    <div>
                      <strong>Duration:</strong>
                      <span><?php echo $nights; ?> <?php echo $nights > 1 ? 'nights' : 'night'; ?></span>
                    </div>
                  </div>

                  <div class="booking-detail">
                    <i class="fa-solid fa-user-group"></i>
                    <div>
                      <strong>Guests:</strong>
                      <span><?php echo $booking['number_guests']; ?> <?php echo $booking['number_guests'] > 1 ? 'guests' : 'guest'; ?></span>
                    </div>
                  </div>

                  <div class="booking-detail">
                    <i class="fa-solid fa-calendar-check"></i>
                    <div>
                      <strong>Booked on:</strong>
                      <span><?php echo $booked_on; ?></span>
                    </div>
                  </div>
                </div>

                <?php if (!empty($booking['booking_notes'])): ?>
                  <div class="special-requests">
                    <strong><i class="fa-solid fa-note-sticky"></i> Special Requests:</strong>
                    <p><?php echo nl2br(htmlspecialchars($booking['booking_notes'])); ?></p>
                  </div>
                <?php endif; ?>

                <div class="booking-total">
                  <span class="total-label">Total Paid:</span>
                  <span class="total-amount">€<?php echo number_format($booking['total_price'], 2); ?></span>
                </div>

                <?php if ($booking['booking_status'] === 'confirmed'): ?>
                  <div class="booking-actions">
                    <button
                      class="btn-cancel-booking"
                      onclick="openCancelModal(<?php echo $booking['reservationID']; ?>, '<?php echo htmlspecialchars($booking['accommodation_name'], ENT_QUOTES); ?>')">
                      <i class="fa-solid fa-xmark"></i>
                      Cancel Booking
                    </button>
                  </div>
                <?php endif; ?>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>

    <div id="cancelModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Cancel Booking</h3>
          <button class="modal-close" onclick="closeCancelModal()">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div>

        <div class="modal-body">
          <div class="modal-warning">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <p>Are you sure you want to cancel this booking?</p>
          </div>

          <div class="modal-booking-info">
            <p><strong>Reservation #<span id="modalReservationId"></span></strong></p>
            <p><strong>Room:</strong> <span id="modalRoomName"></span></p>
          </div>

          <p class="modal-notice">
            <i class="fa-solid fa-info-circle"></i>
            Please review our cancellation policy. Cancellation fees may apply depending on how close to your check-in date.
          </p>
        </div>

        <div class="modal-footer">
          <form id="cancelBookingForm" action="includes/cancel-booking.inc.php" method="POST">
            <input type="hidden" name="reservation_id" id="modalReservationIdInput">

            <button type="button" class="btn-modal-cancel" onclick="closeCancelModal()">
              No, Keep Booking
            </button>

            <button type="submit" class="btn-modal-confirm">
              Yes, Cancel Booking
            </button>
          </form>
        </div>
      </div>
    </div>

    <div id="modalOverlay" class="modal-overlay" onclick="closeCancelModal()"></div>

  </main>

  <!-- footer -->
  <?php require_once 'includes/footer.inc.php'; ?>

  <?php
  unset($_SESSION["booking_success"]);
  unset($_SESSION["error_cancel_booking"]);
  ?>
</body>

</html>