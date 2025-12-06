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
  <?php require_once 'includes/header.inc.php' ?>

  <?php
  displaySignupErrors();
  ?>

  <form action="includes/signup.inc.php" method="post" novalidate>
    <label for="firstname">First Name:</label>
    <input type="text"
      name="firstname"
      id="firstname"
      class=""
      value="<?php echo htmlspecialchars($signup_data['firstname'] ?? ''); ?>">

    <label for="lastname">Last Name:</label>
    <input type="text"
      name="lastname"
      id="lastname"
      class=""
      value="<?php echo htmlspecialchars($signup_data['lastname'] ?? ''); ?>">

    <label for="dob">Date of birth:</label>
    <input type="date"
      name="dob" id="dob"
      class=""
      value="<?php
              if (!checkSignupErrors('under_age')) {
                echo htmlspecialchars($signup_data['dob'] ?? '');
              } ?>">

    <label for="email">Email:</label>
    <input type="email"
      name="email"
      id="email"
      class=""
      value="<?php
              if (!checkSignupErrors('email_registered') && !checkSignupErrors('invalid_email')) {
                echo htmlspecialchars($signup_data['email'] ?? '');
              } ?>">

    <label for="username">Username:</label>
    <input type="text"
      name="username"
      id="username"
      class=""
      value="<?php
              if (!checkSignupErrors('username_taken')) {
                echo htmlspecialchars($signup_data['username'] ?? '');
              } ?>">
    <label for="password">Password:</label>
    <input type="password"
      name="password"
      id="password"
      class=""
      placeholder="Minimum 8 characters">


    <label for="phone">Phone:</label>
    <input type="tel"
      name="phone"
      id="phone"
      class=""
      value="<?php
              if (!checkSignupErrors('phone_bad')) {
                echo htmlspecialchars($signup_data['phone'] ?? '');
              } ?>">

    <input type="submit" value="Sign Up">

  </form>


  <!-- footer -->
  <?php require_once 'includes/footer.inc.php' ?>

  <!-- unset -->
  <?php
  unset($_SESSION["errors_signup"]);
  unset($_SESSION["signup_data"]);
  ?>
</body>

</html>