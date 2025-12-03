<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';

try {
  $query = "SELECT * FROM accommodation ORDER BY price_per_night;";
  $stmt = $pdo->prepare($query);
  $stmt->execute();

  $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Query failed: " . $e->getMessage());
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
  <title>Rooms & Suites - MareBella Hotel</title>
</head>

<body>
  <!-- header -->
  <?php require_once 'includes/header.inc.php' ?>

  <main>
    <!-- Hero section -->
    <section class="rooms-hero-section-container">
      <h1>Rooms & Suites</h1>
      <p>From cozy rooms to lavish suites, find your perfect stay</p>
    </section>

    <!-- Room amenities section -->
    <section class="room-amenities">
      <div class="room-amenity">
        <i class="fa-solid fa-wifi"></i>
        <span>High-Speed Wifi</span>
      </div>
      <div class="room-amenity">
        <i class="fa-solid fa-tv"></i>
        <span>Smart TV</span>
      </div>
      <div class="room-amenity">
        <i class="fa-solid fa-mug-saucer"></i>
        <span>Premium Coffee</span>
      </div>
      <div class="room-amenity">
        <i class="fa-solid fa-tablet-screen-button"></i>
        <span>In-House tablets</span>
      </div>
    </section>

    <!-- Room-cards container -->
    <section class="room-cards-container">
      <?php foreach ($rooms as $room): ?>
        <article class="room-card-box">
          <img
            src="<?php echo htmlspecialchars($room['session_imagepath']); ?>"
            alt="<?php echo htmlspecialchars($room['accommodation_name']); ?>"
            loading="lazy" />

          <div class="room-content">
            <h3><?php echo htmlspecialchars($room['accommodation_name']); ?></h3>

            <p>
              <span class="card-text-mobile intro">
                <?php
                $desc = $room['description'];
                if (strlen($desc) > 100) {
                  echo htmlspecialchars(substr($desc, 0, 100)) . '...';
                } else {
                  echo htmlspecialchars($desc);
                }
                ?>
              </span>

              <span class="card-text-desktop intro">
                <?php
                echo htmlspecialchars($desc);
                ?>
              </span>
            </p>

            <div class="room-info">
              <span class="room-size">
                <i class="fa-solid fa-ruler-combined"></i>
                <?php echo htmlspecialchars($room['room_size']); ?>
              </span>
              <span class="room-guests">
                <i class="fa-solid fa-user-group"></i>
                Up to <?php echo htmlspecialchars($room['max_occupancy']); ?>
                <?php echo $room['max_occupancy'] > 1 ? 'guests' : 'guest'; ?>
              </span>
            </div>

            <div class="features-container">
              <h4>Room Features:</h4>
              <ul class="features-list">
                <?php
                $amenities = $room['amenities'];

                if (!empty($amenities)) {
                  $amenities_list = explode(", ", $amenities);

                  foreach ($amenities_list as $amenity) {
                    echo '<li>';
                    echo '<i class="fa-solid fa-circle-check"></i> ';
                    echo htmlspecialchars(trim($amenity));
                    echo '</li>';
                  }
                }
                ?>
              </ul>
            </div>

            <hr class="features-divider" />

            <div class="features-price-and-book-box">
              <p class="price">€<?php echo number_format($room['price_per_night'], 2); ?><span class="period">/night</span></p>
              <a
                href="room-details.php?id=<?php echo $room['accommodationID']; ?>"
                class="book-room-btn"
                aria-label="Book Room for <?php echo htmlspecialchars($room['accommodation_name']); ?>">
                Book this Room
              </a>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
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

  <!-- footer -->
  <footer>
    <div class="footer-columns">
      <div class="footer-column">
        <h5>Quick links</h5>
        <ul>
          <li><a href="homepage.html" class="link">Home</a></li>
          <li><a href="rooms.html" class="link">Rooms & Suites</a></li>
          <li><a href="wireframes.html" class="link">WireFrames</a></li>
          <li><a href="credits.html" class="link">Credits</a></li>
        </ul>
      </div>

      <div class="footer-column">
        <h5>Contact us</h5>
        <address>
          <a href="#" class="link">Tel : 69 8234675612</a>
          <a href="#" class="link">info@marebella.gr</a>
        </address>
      </div>

      <div class="footer-column">
        <h5>Follow us</h5>
        <div class="social-icons">
          <a href="#" aria-label="Visit our Facebook page" class="social-icon"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a>

          <a
            href="#"
            aria-label="Visit our Instagram page"
            class="social-icon"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>

          <a href="#" aria-label="Visit our Telegram page" class="social-icon"><i class="fa-brands fa-telegram" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>

    <hr class="footer-divider" />

    <div class="footer-bottom">
      <p>&copy; 2025 MareBella Santorini. All rights reserved.</p>
    </div>
  </footer>
</body>

</html>