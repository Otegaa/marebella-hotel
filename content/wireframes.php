<?php
require_once 'includes/config_session.inc.php';
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
  <title>WireFrames - MareBella Hotel</title>
</head>

<body>
  <!-- header -->
  <?php require_once 'includes/header.inc.php' ?>

  <main>
    <section class="wireframes-container">
      <div class="intro-box">
        <h2>Project WireFrames</h2>
        <p class="section-intro-desc">
          Explore the design process behind MareBella's digital experience
        </p>
      </div>

      <div class="wireframes-grid">
        <!-- Homepage Desktop Wireframe -->
        <article class="wireframe-card">
          <div class="wireframe-icon">
            <i class="fa-solid fa-desktop"></i>
          </div>
          <div class="wireframe-content">
            <h3>Homepage - Desktop</h3>
            <p class="intro">
              Desktop layout and design structure for the homepage
            </p>

            <a
              href="../assets/images/wireframes/Homepage-desktop.png"
              target="_blank"
              class="view-wireframe-btn"
              aria-label="View home page desktop wireframe image">
              <i class="fa-solid fa-file-image"></i> View Wireframe</a>
          </div>
        </article>

        <!-- Homepage Mobile Wireframe -->
        <article class="wireframe-card">
          <div class="wireframe-icon">
            <i class="fa-solid fa-mobile-screen-button"></i>
          </div>
          <div class="wireframe-content">
            <h3>Homepage - Mobile</h3>
            <p class="intro">
              Mobile-responsive design structure for the homepage
            </p>

            <a
              href="../assets/images/wireframes/Homepage-Mobile.png"
              target="_blank"
              class="view-wireframe-btn"
              aria-label="View home page mobile wireframe image">
              <i class="fa-solid fa-file-image"></i> View Wireframe</a>
          </div>
        </article>

        <!-- Rooms Page Desktop Wireframe -->
        <article class="wireframe-card">
          <div class="wireframe-icon">
            <i class="fa-solid fa-desktop"></i>
          </div>
          <div class="wireframe-content">
            <h3>Rooms Page - Desktop</h3>
            <p class="intro">Desktop layout for the rooms and suites page</p>

            <a
              href="../assets/images/wireframes/Rooms-page-Desktop.png"
              target="_blank"
              class="view-wireframe-btn"
              aria-label="View rooms page desktop wireframe image">
              <i class="fa-solid fa-file-image"></i> View Wireframe</a>
          </div>
        </article>

        <!-- Rooms Page Mobile Wireframe -->
        <article class="wireframe-card">
          <div class="wireframe-icon">
            <i class="fa-solid fa-mobile-screen-button"></i>
          </div>
          <div class="wireframe-content">
            <h3>Rooms Page - Mobile</h3>
            <p class="intro">Mobile-responsive design for the rooms page</p>

            <a
              href="../assets/images/wireframes/Rooms-page-Mobile.png"
              target="_blank"
              class="view-wireframe-btn"
              aria-label="View rooms page Mobile wireframe image">
              <i class="fa-solid fa-file-image"></i> View Wireframe</a>
          </div>
        </article>
      </div>
    </section>
  </main>

  <!-- footer -->
  <?php require_once 'includes/footer.inc.php' ?>
</body>

</html>