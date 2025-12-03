<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';

try {
  $query = "SELECT * FROM accommodation ORDER BY price_per_night LIMIT 2;";
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
  <title>MareBella Hotel</title>
</head>

<body>
  <!-- header -->
  <?php require_once 'includes/header.inc.php'; ?>

  <!-- main section -->
  <main>
    <!-- Hero section -->
    <section class="hero-section-container">
      <div class="hero-content">
        <h1>Where the Sea Meets Bella Vita</h1>
        <p>Experience Italian elegance on Greece's most beautiful shores</p>
      </div>
      <div class="hero-btns">
        <a href="rooms.php" class="reserve-now">📅 Reserve Now</a>
        <a href="rooms.php" class="explore-rooms">Explore Rooms</a>
      </div>
    </section>

    <!-- Introduction section -->
    <section class="introduction-container">
      <h2>Welcome to MareBella Hotel</h2>
      <p class="intro-desc">
        <span class="mobile-text">Welcome to MareBella — where the sea whispers and time stands
          still. Experience Santorini’s white-washed beauty, breathtaking
          views, and pure Mediterranean bliss.</span>
        <span class="desktop-text">
          Welcome to MareBella, where the sea whispers and time stands still.
          Our boutique hotel captures the essence of Santorini's
          beauty—white-washed elegance, breathtaking views, and the gentle
          embrace of Mediterranean luxury. Here, you'll find more than a place
          to stay. You'll discover your sanctuary</span>
      </p>
    </section>

    <section class="amenities-container">
      <div class="intro-box">
        <h2>The MareBella Experience</h2>
        <p class="section-intro-desc">
          Amenities that transform your stay into an experience
        </p>
      </div>

      <div class="amenities-view-container">
        <article class="amenities-view">
          <img
            src="../assets/images/infinity-pool.jpg"
            alt="Green leafed plant near white concrete post"
            loading="lazy" />



          <div class="amenity-desc-box">
            <h4>Infinity Pool Vista</h4>
            <p class="intro">Where the pool meets the endless blue horizon</p>
          </div>
        </article>

        <article class="amenities-view">
          <img
            src="../assets/images/wellness&beauty.jpg"
            alt="A room with a glass door that has a plant in it"
            loading="lazy" />


          <div class="amenity-desc-box">
            <h4>Wellness & Beauty</h4>
            <p class="intro">
              Escape to tranquility in our award-winning spa haven
            </p>
          </div>
        </article>

        <article class="amenities-view">
          <img
            src="../assets/images/rooftop-restaurant.jpg"
            alt="Brown wooden table and chairs set"
            loading="lazy" />



          <div class="amenity-desc-box">
            <h4>Rooftop Restaurant</h4>
            <p class="intro">
              Fresh Mediterranean cuisine in an unforgettable rooftop setting
            </p>
          </div>
        </article>
      </div>
    </section>

    <!-- Exquisite accommodations -->
    <section class="accommodations-container">
      <div class="intro-box">
        <h2>Exquisite Accommodations</h2>
        <p class="section-intro-desc">
          From cozy rooms to lavish suites, find your perfect stay
        </p>
      </div>

      <div class="rooms-container">
        <?php foreach ($rooms as $room): ?>
          <article class="room-card">
            <img
              src="<?php echo htmlspecialchars($room["session_imagepath"]); ?>"
              alt="<?php echo htmlspecialchars($room["accommodation_name"]); ?>"
              loading="lazy" />

            <div class="room-desc-box">
              <h3><?php echo htmlspecialchars($room["accommodation_name"]); ?></h3>
              <p class="intro">
                <?php
                $desc = $room["description"];
                if (strlen($desc) > 150) {
                  echo htmlspecialchars(substr($desc, 0, 200)) . '...';
                } else {
                  echo htmlspecialchars($desc);
                }
                ?>
              </p>
            </div>

            <hr class="room-divider" />

            <div class="price-and-book-box">
              <p class="price"> €<?php echo number_format($room["price_per_night"], 2) ?>/night</p>
              <a
                href="room-details.php?id=<?php echo $room["accommodationID"]; ?>"
                class="view-details"
                aria-label="View details for <?php echo htmlspecialchars($room['accommodation_name']); ?>">View details </a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

      <div class="view-room-btn">
        <a href="./rooms.php">View all rooms & Suites</a>
      </div>
    </section>
  </main>

  <!-- footer -->
  <?php require_once 'includes/footer.inc.php' ?>
</body>

</html>