<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';

// If already logged in, redirect
if (isset($_SESSION['user_id'])) {
  header("Location: homepage.php");
  exit();
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
  <title>Login - MareBella Hotel</title>
</head>

<body>
  <!-- header -->
  <?php require_once 'includes/header.inc.php'; ?>

  <main>
    <div class="form-container">
      <h2>Login</h2>

      <?php
      displayLoginErrors();
      displaySuccessMessage();
      ?>

      <form action="includes/login.inc.php" method="post" novalidate>

        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" required>
        </div>

        <input type="submit" value="Login">
      </form>

      <div class="form-footer">
        <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
      </div>
    </div>
  </main>

  <!-- footer -->
  <?php require_once 'includes/footer.inc.php'; ?>

  <?php unset($_SESSION["errors_login"]); ?>

</body>

</html>