<?php
$isLoggedIn = isset($_SESSION['user_id']);
?>

<header>
  <nav>
    <a href="../homepage.php" class="title-container">
      <img src="../assets/images/Logo-Main.png" alt="MareBella logo" class="logo-img" />
      <span class="logo-name">MareBella</span>
    </a>

    <!-- Desktop Navigation -->
    <ul class="nav-links">
      <li class="nav-link">
        <a href="../homepage.php">Home</a>
      </li>
      <li class="nav-link">
        <a href="../rooms.php">Rooms & Suites</a>
      </li>
      <li class="nav-link">
        <a href="../wireframes.html">Wireframes</a>
      </li>

      <?php if ($isLoggedIn): ?>
        <li class="nav-link">
          <a href="../my-bookings.php">My Bookings</a>
        </li>
        <li class="nav-link">
          <a href="logout.inc.php">Logout</a>
        </li>
      <?php else: ?>
        <li class="nav-link">
          <a href="../login.php">Login</a>
        </li>
        <li class="nav-link">
          <a href="../register.php">Register</a>
        </li>
      <?php endif; ?>
    </ul>

    <!-- Book Now Button -->
    <?php if ($isLoggedIn): ?>
      <a href="../rooms.php" class="btn-book-desktop">Book Now</a>
    <?php else: ?>
      <a href="../login.php" class="btn-book-desktop">Book Now</a>
    <?php endif; ?>

    <!-- Mobile Hamburger -->
    <button class="hamburger" aria-label="Toggle menu">
      <i class="fa-solid fa-bars"></i>
    </button>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobile-menu">
      <ul>
        <li><a href="../homepage.php">Home</a></li>
        <li><a href="../rooms.php">Rooms & Suites</a></li>
        <li><a href="../wireframes.html">Wireframes</a></li>

        <?php if ($isLoggedIn): ?>
          <li><a href="../my-bookings.php">My Bookings</a></li>
          <li><a href="logout.inc.php">Logout</a></li>
        <?php else: ?>
          <li><a href="../login.php">Login</a></li>
          <li><a href="../register.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>

  <div class="mobile-menu-overlay"></div>
</header>