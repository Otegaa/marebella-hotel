<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';

// check for errors with ID
if (!isset($_GET["id"])) {
  header("Location: rooms.php");
  exit();
}

$id = filter_var($_GET["id"], FILTER_VALIDATE_INT);

if (!$id || $id <= 0) {
  header("Location: rooms.php");
  exit();
}

try {
  $query = "SELECT * FROM accommodation WHERE accommodationID = :id";
  $stmt = $pdo->prepare($query);
  $stmt->execute([":id" => $id]);

  $room = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$room) {
    $_SESSION['error'] = "Room not found.";
    header("Location: rooms.php");
    exit();
  }
} catch (PDOException $e) {
  die("Query Failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

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
  <title><?php echo htmlspecialchars($room["accommodation_name"]); ?> - MareBella Hotel</title>
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
        <a href="rooms.php">Rooms & Suites</a>
        <span> / </span>
        <span><?php echo htmlspecialchars($room['accommodation_name']); ?></span>
      </div>
    </section>

    <section class="room-details-container">
      <div class="room-details-image">
        <img
          src="<?php echo htmlspecialchars($room['session_imagepath']); ?>"
          alt="<?php echo htmlspecialchars($room['accommodation_name']); ?>">
      </div>

      <div class="room-details-header">
        <div>
          <span class="room-type-badge"><?php echo htmlspecialchars($room['room_type']); ?></span>
          <h1><?php echo htmlspecialchars($room['accommodation_name']); ?></h1>
        </div>
        <div class="room-price-large">
          <span class="price-amount">€<?php echo number_format($room['price_per_night'], 2); ?></span>
          <span class="price-period">per night</span>
        </div>
      </div>

      <div class="room-description">
        <h2>About This Room</h2>
        <p><?php echo nl2br(htmlspecialchars($room['description'])); ?></p>
      </div>

      <div class="room-info-grid">
        <div class="info-item">
          <i class="fa-solid fa-location-dot"></i>
          <div>
            <strong>Location</strong>
            <p><?php echo htmlspecialchars($room['location']); ?></p>
          </div>
        </div>

        <div class="info-item">
          <i class="fa-solid fa-ruler-combined"></i>
          <div>
            <strong>Room Size</strong>
            <p><?php echo htmlspecialchars($room['room_size']); ?></p>
          </div>
        </div>

        <div class="info-item">
          <i class="fa-solid fa-bed"></i>
          <div>
            <strong>Bed Type</strong>
            <p><?php echo htmlspecialchars($room['bed_type']); ?></p>
          </div>
        </div>

        <div class="info-item">
          <i class="fa-solid fa-user-group"></i>
          <div>
            <strong>Max Occupancy</strong>
            <p>Up to <?php echo htmlspecialchars($room['max_occupancy']); ?> <?php echo $room['max_occupancy'] > 1 ? 'guests' : 'guest'; ?></p>
          </div>
        </div>
      </div>

      <div class="room-amenities-section">
        <h2>Room Features & Amenities</h2>
        <ul class="amenities-grid">
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

      <div class="booking-cta">
        <div class="cta-content">
          <h3>Ready to Book?</h3>
          <p>Reserve this beautiful room for your perfect Santorini getaway</p>
        </div>
        <a href="booking.php?room_id=<?php echo $room['accommodationID']; ?>"
          class="btn-book-large">
          Book This Room
        </a>
      </div>

      <div class="back-link">
        <a href="rooms.php">
          <i class="fa-solid fa-arrow-left"></i> Back to all rooms
        </a>
      </div>

    </section>
  </main>

  <!-- footer -->
  <?php require_once 'includes/footer.inc.php'; ?>
</body>

</html>