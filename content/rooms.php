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

    <?php
    if (isset($_SESSION["error"])) {
      echo '<div class="page-error">';
      echo '<div class="error-box">';
      echo '<p>' . htmlspecialchars($_SESSION["error"]) . '</p>';
      echo '</div>';
      echo '</div>';
      unset($_SESSION["error"]);
    }
    ?>

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
  </main>

  <!-- footer -->
  <?php require_once 'includes/footer.inc.php'; ?>

</body>

</html>