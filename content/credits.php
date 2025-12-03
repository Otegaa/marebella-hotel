<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/styles.css" />
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="/favicon_io/apple-touch-icon.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="/favicon_io/favicon-32x32.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="/favicon_io/favicon-16x16.png"
    />
    <link rel="manifest" href="/favicon_io/site.webmanifest" />
    <script
      src="https://kit.fontawesome.com/68aea0d1de.js"
      crossorigin="anonymous"
    ></script>
    <title>MareBella Hotel</title>
  </head>

  <body>
    <!-- header -->
    <header>
      <nav>
        <a href="homepage.html" class="title-container">
          <img
            src="/images/Logo-Main.png"
            alt="MareBella logo"
            class="logo-img"
          />
          <span class="logo-name">MareBella</span>
        </a>

        <ul class="nav-links">
          <li class="nav-link">
            <a href="homepage.html">Home</a>
          </li>
          <li class="nav-link">
            <a href="rooms.html">Rooms & Suites</a>
          </li>
          <li class="nav-link">
            <a href="wireframes.html">WireFrames</a>
          </li>
        </ul>

        <a href="#" class="btn-book-desktop">Book Now</a>

        <!-- Hamburger for mobile -->
        <button
          class="hamburger"
          aria-label="Toggle menu"
          aria-expanded="false"
          aria-controls="mobile-menu"
        >
          <i class="fa-solid fa-bars"></i>
        </button>

        <!-- Links for mobile -->
        <div class="mobile-menu" id="mobile-menu" aria-hidden="true">
          <ul>
            <li>
              <a href="homepage.html">Home</a>
            </li>
            <li>
              <a href="rooms.html">Rooms & Suites</a>
            </li>
            <li>
              <a href="wireframes.html">WireFrames</a>
            </li>
            <li><a href="#" class="btn-book-mobile">Book Now</a></li>
          </ul>
        </div>
      </nav>

      <div class="mobile-menu-overlay" aria-hidden="true"></div>
    </header>

    <main>
      <section class="credits-container">
        <div class="intro-box">
          <h2>Credits</h2>
          <p class="section-intro-desc">
            Acknowledgments for the talented photographers whose work brings
            MareBella to life
          </p>
        </div>

        <div class="credits-content">
          <p class="credits-intro">
            All images used on this website are sourced from
            <a href="https://unsplash.com" target="_blank" class="unsplash-link"
              >Unsplash</a
            >, a platform for freely usable images. I am grateful to the
            following photographers for their beautiful work:
          </p>

          <div class="credits-grid">
            <!-- Hero Image - Homepage -->
            <article class="credit-item">
              <h3>Homepage Hero Image</h3>
              <p>
                Photo by
                <a
                  href="https://unsplash.com/@raph_lopes?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                  target="_blank"
                >
                  Raphael Lopes
                </a>
                on
                <a
                  href="https://unsplash.com/photos/white-plastic-chairs-on-gray-concrete-dock-during-daytime-pABchpCB8ak?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                  target="_blank"
                >
                  Unsplash
                </a>
                <span class="year">(2021)</span>
              </p>
            </article>

            <!-- Infinity Pool -->
            <article class="credit-item">
              <h3>Infinity Pool Vista</h3>
              <p>
                Photo by
                <a
                  href="https://unsplash.com/@bigtinybelly?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                  target="_blank"
                >
                  big.tiny.belly
                </a>
                on
                <a
                  href="https://unsplash.com/photos/green-leafed-plant-near-white-concrete-post-XtnNrQYC7ts?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                  target="_blank"
                >
                  Unsplash
                </a>
                <span class="year">(2018)</span>
              </p>
            </article>

            <!-- Wellness & Beauty -->
            <article class="credit-item">
              <h3>Wellness & Beauty</h3>
              <p>
                Photo by
                <a
                  href="https://unsplash.com/@birkenwald?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                  target="_blank"
                >
                  Birk Enwald
                </a>
                on
                <a
                  href="https://unsplash.com/photos/a-room-with-a-glass-door-that-has-a-plant-in-it-znZXwcHdKwM?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                  target="_blank"
                >
                  Unsplash
                </a>
                <span class="year">(2023)</span>
              </p>
            </article>

            <!-- Rooftop Restaurant -->
            <article class="credit-item">
              <h3>Rooftop Restaurant</h3>
              <p>
                Photo by
                <a
                  href="https://unsplash.com/@brandsandpeople?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                  target="_blank"
                >
                  Brands&People
                </a>
                on
                <a
                  href="https://unsplash.com/photos/brown-wooden-table-and-chairs-set-en-u6xqnbsg?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                  target="_blank"
                >
                  Unsplash
                </a>
                <span class="year">(2021)</span>
              </p>
            </article>

            <!-- Classic Mediterranean Twin -->
            <article class="credit-item">
              <h3>Classic Mediterranean Twin Room</h3>
              <p>
                Photo by
                <a
                  href="https://unsplash.com/@oning?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                  target="_blank"
                >
                  oning
                </a>
                on
                <a
                  href="https://unsplash.com/photos/a-hotel-room-with-two-beds-and-a-desk-gdJpDTU85ek?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                  target="_blank"
                >
                  Unsplash
                </a>
                <span class="year">(2024)</span>
              </p>
            </article>

            <!-- Premium Sea View Suite -->
            <article class="credit-item">
              <h3>Premium Sea View Suite</h3>
              <p>
                Photo by
                <a
                  href="https://unsplash.com/@traveleroohlala?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                  target="_blank"
                >
                  Meg von Haartman
                </a>
                on
                <a
                  href="https://unsplash.com/photos/a-bedroom-with-a-view-of-the-ocean-b_tr2-t7AaI?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                  target="_blank"
                >
                  Unsplash
                </a>
                <span class="year">(2022)</span>
              </p>
            </article>

            <!-- Rooms Page Hero -->
            <article class="credit-item">
              <h3>Rooms Page Hero Image</h3>
              <p>
                Photo by
                <a
                  href="https://unsplash.com/@aalolens?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                  target="_blank"
                >
                  Aalo Lens
                </a>
                on
                <a
                  href="https://unsplash.com/photos/luxurious-bedroom-with-modern-decor-and-large-windows-Xph_EJ-22vE?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                  target="_blank"
                >
                  Unsplash
                </a>
                <span class="year">(2025)</span>
              </p>
            </article>
          </div>

          <div class="credits-footer">
            <p>
              Images are used in accordance with the
              <a
                href="https://unsplash.com/license"
                target="_blank"
                class="unsplash-link"
              >
                Unsplash License </a
              >. All photographs remain the property of their respective
              creators.
            </p>
          </div>
        </div>
      </section>
    </main>
  </body>
</html>
