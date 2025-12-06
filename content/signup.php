<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';

$signup_data = getSignupData();
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
  <title>Sign Up - MareBella Hotel</title>
</head>

<body>
  <!-- header -->
  <?php require_once 'includes/header.inc.php'; ?>

  <main>
    <div class="form-container">
      <h2>Create Your Account</h2>

      <?php
      displaySignupErrors();
      ?>

      <form action="includes/signup.inc.php" method="post" novalidate>

        <div class="form-group">
          <label for="firstname">First Name<span class="required">*</span></label>
          <input type="text"
            name="firstname"
            id="firstname"
            class="<?php echo checkSignupErrors('empty_input') ? 'input-error' : ''; ?>"
            value="<?php echo htmlspecialchars($signup_data['firstname'] ?? ''); ?>">
        </div>

        <div class="form-group">
          <label for="lastname">Last Name<span class="required">*</span></label>
          <input type="text"
            name="lastname"
            id="lastname"
            class="<?php echo checkSignupErrors('empty_input') ? 'input-error' : ''; ?>"
            value="<?php echo htmlspecialchars($signup_data['lastname'] ?? ''); ?>">
        </div>

        <div class="form-group">
          <label for="username">Username<span class="required">*</span></label>
          <input type="text"
            name="username"
            id="username"
            class="<?php echo checkSignupErrors('username_taken') ? 'input-error' : ''; ?>"
            value="<?php
                    if (!checkSignupErrors('username_taken')) {
                      echo htmlspecialchars($signup_data['username'] ?? '');
                    }
                    ?>">
        </div>

        <div class="form-group">
          <label for="email">Email<span class="required">*</span></label>
          <input type="email"
            name="email"
            id="email"
            class="<?php echo checkSignupErrors('email_registered') || checkSignupErrors('invalid_email') ? 'input-error' : ''; ?>"
            value="<?php
                    if (!checkSignupErrors('email_registered') && !checkSignupErrors('invalid_email')) {
                      echo htmlspecialchars($signup_data['email'] ?? '');
                    }
                    ?>">
        </div>

        <div class="form-group">
          <label for="password">Password<span class="required">*</span></label>
          <input type="password"
            name="password"
            id="password"
            class="<?php echo checkSignupErrors('password_bad') ? 'input-error' : ''; ?>"
            placeholder="Minimum 8 characters">
          <span class="form-helper">Use at least 8 characters</span>
        </div>

        <div class="form-group">
          <label for="phone">Phone Number<span class="required">*</span></label>
          <input type="tel"
            name="phone"
            id="phone"
            class="<?php echo checkSignupErrors('phone_bad') ? 'input-error' : ''; ?>"
            value="<?php
                    if (!checkSignupErrors('phone_bad')) {
                      echo htmlspecialchars($signup_data['phone'] ?? '');
                    }
                    ?>">
        </div>

        <div class="form-group">
          <label for="dob">Date of Birth<span class="required">*</span></label>
          <input type="date"
            name="dob"
            id="dob"
            class="<?php echo checkSignupErrors('under_age') ? 'input-error' : ''; ?>"
            max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>"
            value="<?php
                    if (!checkSignupErrors('under_age')) {
                      echo htmlspecialchars($signup_data['dob'] ?? '');
                    }
                    ?>">
          <span class="form-helper">You must be 18 or older</span>
        </div>

        <input type="submit" value="Sign Up">
      </form>

      <div class="form-footer">
        <p>Already have an account? <a href="login.php">Login here</a></p>
      </div>
    </div>
  </main>

  <!-- footer -->
  <?php require_once 'includes/footer.inc.php'; ?>

  <!-- unset -->
  <?php
  unset($_SESSION["errors_signup"]);
  unset($_SESSION["signup_data"]);
  ?>
</body>

</html>