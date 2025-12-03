<?php
require_once 'includes/config_session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/assets/stylesheets/styles.css" />
  <link
    rel="apple-touch-icon"
    sizes="180x180"
    href="/favicon_io/apple-touch-icon.png" />
  <link
    rel="icon"
    type="image/png"
    sizes="32x32"
    href="/favicon_io/favicon-32x32.png" />
  <link
    rel="icon"
    type="image/png"
    sizes="16x16"
    href="/favicon_io/favicon-16x16.png" />
  <link rel="manifest" href="/favicon_io/site.webmanifest" />
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
        <a href="rooms.html" class="reserve-now">📅 Reserve Now</a>
        <a href="rooms.html" class="explore-rooms">Explore Rooms</a>
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
            src="/images/infinity-pool.jpg"
            alt="Green leafed plant near white concrete post"
            loading="lazy" />

          <!-- Photo by <a href="https://unsplash.com/@bigtinybelly?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">big.tiny.belly</a> (2018) on <a href="https://unsplash.com/photos/green-leafed-plant-near-white-concrete-post-XtnNrQYC7ts?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a> (Accessed: on October 20, 2025) -->

          <div class="amenity-desc-box">
            <h4>Infinity Pool Vista</h4>
            <p class="intro">Where the pool meets the endless blue horizon</p>
          </div>
        </article>

        <article class="amenities-view">
          <img
            src="/images/wellness&beauty.jpg"
            alt="A room with a glass door that has a plant in it"
            loading="lazy" />

          <!-- Photo by <a href="https://unsplash.com/@birkenwald?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Birk Enwald</a> (2023) on <a href="https://unsplash.com/photos/a-room-with-a-glass-door-that-has-a-plant-in-it-znZXwcHdKwM?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a> (Accessed: on October 20, 2025) -->

          <div class="amenity-desc-box">
            <h4>Wellness & Beauty</h4>
            <p class="intro">
              Escape to tranquility in our award-winning spa haven
            </p>
          </div>
        </article>

        <article class="amenities-view">
          <img
            src="/images/rooftop-restaurant.jpg"
            alt="Brown wooden table and chairs set"
            loading="lazy" />

          <!-- Photo by <a href="https://unsplash.com/@brandsandpeople?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Brands&People</a> (2021) on <a href="https://unsplash.com/photos/brown-wooden-table-and-chairs-set-en-u6xqnbsg?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a> (Accessed: on October 21, 2025) -->

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
        <article class="room-card">
          <img
            src="/images/room-1.jpg"
            alt="Classic Mediterranean Twin room with two beds, modern desk and elegant decor"
            loading="lazy" />

          <!-- Photo by <a href="https://unsplash.com/@oning?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">oning</a> (2024) on  <a href="https://unsplash.com/photos/a-hotel-room-with-two-beds-and-a-desk-gdJpDTU85ek?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a> (Accessed: on October 21, 2025) -->

          <div class="room-desc-box">
            <h3>Classic Mediterranean Twin</h3>
            <p class="intro">
              Twin beds, timeless Mediterranean style, and every modern
              comfort
            </p>
          </div>

          <hr class="room-divider" />

          <div class="price-and-book-box">
            <p class="price">€280/night</p>
            <a
              href="rooms.html"
              class="view-details"
              aria-label="View details for Classic Mediterranean Twin room">View details</a>
          </div>
        </article>

        <article class="room-card">
          <img
            src="/images/room-2.jpg"
            alt="A bedroom with view of the ocean"
            loading="lazy" />

          <!-- Photo by <a href="https://unsplash.com/@traveleroohlala?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Meg von Haartman</a> (2022) on <a href="https://unsplash.com/photos/a-bedroom-with-a-view-of-the-ocean-b_tr2-t7AaI?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a> (Accessed: on October 21, 2025)-->

          <div class="room-desc-box">
            <h3>Premium Sea View Suite</h3>
            <p class="intro">
              Wake to the sea’s embrace from your balcony and king suite
            </p>
          </div>

          <hr class="room-divider" />

          <div class="price-and-book-box">
            <p class="price">€380/night</p>
            <a
              href="rooms.html"
              class="view-details"
              aria-label="View details for Premium Sea View Suite">View details</a>
          </div>
        </article>
      </div>

      <div class="view-room-btn">
        <a href="rooms.html">View all rooms & Suites</a>
      </div>
    </section>
  </main>

  <!-- footer -->
  <?php require_once 'includes/footer.inc.php' ?>
</body>

</html>