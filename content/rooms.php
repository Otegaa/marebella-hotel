<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';

$search = isset($_GET["search"]) ? trim($_GET["search"]) : '';
$max_price = filter_var($_GET["max_price"] ?? 0, FILTER_VALIDATE_INT);
$guests = filter_var($_GET["guests"] ?? 0, FILTER_VALIDATE_INT);
$room_type = $_GET["room_type"] ?? '';
$sort = $_GET["sort"] ?? 'price_low';

if (!empty($_GET["max_price"]) && $max_price <= 0) {
  $_SESSION["error"] = "Please enter a valid price.";
  header("Location: rooms.php");
  exit();
}

if (!empty($_GET["guests"]) && ($guests <= 0 || $guests > 6)) {
  $_SESSION["error"] = "Enter a valid number of guests (1-6)";
  header("Location: rooms.php");
  exit();
}

try {
  $query = "SELECT * FROM accommodation WHERE 1=1";
  $params = [];

  if ($search) {
    $search_clean = addcslashes($search, '%_'); // for security
    $query .= " AND (accommodation_name LIKE :search OR description LIKE :search)";
    $params[':search'] = '%' . $search_clean . '%';
  }

  if ($max_price && $max_price > 0) {
    $query .= " AND price_per_night <= :max_price";
    $params[':max_price'] = $max_price;
  }

  if ($guests && $guests > 0) {
    $query .= " AND max_occupancy >= :guests";
    $params[':guests'] = $guests;
  }

  if ($room_type) {
    $query .= " AND room_type = :room_type";
    $params[':room_type'] = $room_type;
  }

  $allowed_sorts = ['price_low', 'price_high', 'name'];
  if (!in_array($sort, $allowed_sorts)) {
    $sort = 'price_low';
  }

  if ($sort == 'price_high') {
    $query .= " ORDER BY price_per_night DESC";
  } elseif ($sort == 'name') {
    $query .= " ORDER BY accommodation_name ASC";
  } else {
    $query .= " ORDER BY price_per_night ASC";
  }

  $stmt = $pdo->prepare($query);
  $stmt->execute($params);
  $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Failed to get rooms: " . $e->getMessage());
}

function highlightSearchTerm($text, $search)
{
  if (empty($search) || empty($text)) {
    return htmlspecialchars($text);
  }

  $text_escaped = htmlspecialchars($text);

  $search_escaped = preg_quote(htmlspecialchars($search), '/');


  return preg_replace(
    '/(' . $search_escaped . ')/i',
    '<mark>$1</mark>',
    $text_escaped
  );
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

    <section class="search-filter-container">
      <h2>Find Your Perfect Room</h2>

      <form action="rooms.php" method="GET" class="search-form">

        <div class="search-group">
          <label for="search">Search:</label>
          <input type="text"
            name="search"
            id="search"
            placeholder="Search by room name or description..."
            value="<?php echo htmlspecialchars($search); ?>">
        </div>

        <div class="filter-group">
          <label for="max_price">Max Price:</label>
          <select name="max_price" id="max_price">
            <option value="">Any price</option>
            <option value="200" <?php echo (isset($_GET['max_price']) && $_GET['max_price'] == '200') ? 'selected' : ''; ?>>Under €200</option>
            <option value="400" <?php echo (isset($_GET['max_price']) && $_GET['max_price'] == '400') ? 'selected' : ''; ?>>Under €400</option>
            <option value="600" <?php echo (isset($_GET['max_price']) && $_GET['max_price'] == '600') ? 'selected' : ''; ?>>Under €600</option>
            <option value="800" <?php echo (isset($_GET['max_price']) && $_GET['max_price'] == '800') ? 'selected' : ''; ?>>Under €800</option>
            <option value="1000" <?php echo (isset($_GET['max_price']) && $_GET['max_price'] == '1000') ? 'selected' : ''; ?>>Under €1000</option>
          </select>
        </div>

        <div class="filter-group">
          <label for="guests">Guests:</label>
          <select name="guests" id="guests">
            <option value="">Any capacity</option>
            <option value="1" <?php echo (isset($_GET['guests']) && $_GET['guests'] == '1') ? 'selected' : ''; ?>>1 guest</option>
            <option value="2" <?php echo (isset($_GET['guests']) && $_GET['guests'] == '2') ? 'selected' : ''; ?>>2 guests</option>
            <option value="4" <?php echo (isset($_GET['guests']) && $_GET['guests'] == '4') ? 'selected' : ''; ?>>4 guests</option>
            <option value="6" <?php echo (isset($_GET['guests']) && $_GET['guests'] == '6') ? 'selected' : ''; ?>>6 guests</option>
          </select>
        </div>

        <div class="filter-group">
          <label for="room_type">Room Type:</label>
          <select name="room_type" id="room_type">
            <option value="">All types</option>
            <option value="Standard" <?php echo (isset($_GET['room_type']) && $_GET['room_type'] == 'Standard') ? 'selected' : ''; ?>>Standard</option>
            <option value="Deluxe" <?php echo (isset($_GET['room_type']) && $_GET['room_type'] == 'Deluxe') ? 'selected' : ''; ?>>Deluxe</option>
            <option value="Suite" <?php echo (isset($_GET['room_type']) && $_GET['room_type'] == 'Suite') ? 'selected' : ''; ?>>Suite</option>
            <option value="Premium Suite" <?php echo (isset($_GET['room_type']) && $_GET['room_type'] == 'Premium Suite') ? 'selected' : ''; ?>>Premium Suite</option>
          </select>
        </div>

        <div class="filter-group">
          <label for="sort">Sort by:</label>
          <select name="sort" id="sort">
            <option value="price_low" <?php echo ($sort == 'price_low') ? 'selected' : ''; ?>>Price: Low to High</option>
            <option value="price_high" <?php echo ($sort == 'price_high') ? 'selected' : ''; ?>>Price: High to Low</option>
            <option value="name" <?php echo ($sort == 'name') ? 'selected' : ''; ?>>Name A-Z</option>
          </select>
        </div>

        <button type="submit" class="btn-search">
          <i class="fa-solid fa-magnifying-glass"></i> Search
        </button>

        <a href="rooms.php" class="btn-clear">Clear Filters</a>

      </form>

      <?php
      $total_rooms = count($rooms);
      $has_filters = !empty($search) || !empty($_GET['max_price']) || !empty($_GET['guests']) || !empty($room_type) || ($sort != 'price_low');

      if ($has_filters && $total_rooms > 0): ?>
        <p class="search-results-info">
          Found <?php echo $total_rooms; ?> room<?php echo $total_rooms != 1 ? 's' : ''; ?>
          <?php if (!empty($search)): ?>
            for "<?php echo htmlspecialchars($search); ?>"
          <?php endif; ?>
        </p>
      <?php elseif ($has_filters && $total_rooms == 0): ?>
        <div class="no-results">
          <i class="fa-solid fa-search"></i>
          <h3>No rooms found</h3>
          <p>Try adjusting your filters or search term.</p>
          <a href="rooms.php" class="btn-clear">Clear all filters</a>
        </div>
      <?php else: ?>
        <p class="search-results-info">Showing all <?php echo $total_rooms; ?> accommodation<?php echo $total_rooms != 1 ? 's' : ''; ?></p>
      <?php endif; ?>
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
            <h3><?php echo highlightSearchTerm($room['accommodation_name'], $search); ?></h3>

            <p>
              <span class="card-text-mobile intro">
                <?php
                $desc = $room['description'];
                if (strlen($desc) > 100) {
                  echo highlightSearchTerm($truncated, $search);
                } else {
                  echo highlightSearchTerm($desc, $search);
                }
                ?>
              </span>

              <span class="card-text-desktop intro">
                <?php
                echo highlightSearchTerm($desc, $search);
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