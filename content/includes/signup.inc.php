<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $firstname = trim($_POST["firstname"]);
  $lastname = trim($_POST["lastname"]);
  $dob = $_POST["dob"];
  $email = trim($_POST["email"]);
  $username = trim($_POST["username"]);
  $password = $_POST["password"];
  $phone = $_POST["phone"];

  try {
    require_once 'config_session.inc.php';
    require_once 'dbh.inc.php';
    require_once 'signup_model.inc.php';
    require_once 'signup_contr.inc.php';

    // Form validation
    $errors = [];

    if (isInputEmpty($firstname, $lastname, $dob, $email, $username, $password, $phone)) {
      $errors["empty_input"] = "Please fill in all fields!";
    }

    if (isEmailInvalid($email)) {
      $errors["invalid_email"] = "Invalid email format!";
    }

    if (isUsernameTaken($pdo, $username)) {
      $errors["username_taken"] = "Username already taken!";
    }

    if (isEmailRegistered($pdo, $email)) {
      $errors["email_registered"] = "Email already in use!";
    }

    if (isPasswordBad($password)) {
      $errors["password_bad"] = "Password must be at least 8 characters!";
    }

    if (isPhoneNumberBad($phone)) {
      $errors["phone_bad"] = "Invalid phone number!";
    }

    if (isUserAgeUnder18($dob)) {
      $errors["under_age"] = "You must be 18 or older to register!";
    }

    // If errors, redirect back
    if ($errors) {
      $_SESSION["errors_signup"] = $errors;
      $_SESSION["signup_data"] = [
        "firstname" => $firstname,
        "lastname" => $lastname,
        "dob" => $dob,
        "email" => $email,
        "username" => $username,
        "phone" => $phone
      ];

      header("Location: ../signup.php");
      exit();
    }

    // No errors, create user
    createUser($pdo, $username, $password, $firstname, $lastname, $email, $dob, $phone);

    $_SESSION["registration_successful"] = "You have successfully signed up. Please login!";

    $pdo = null;
    $stmt = null;

    header("Location: ../login.php");
    exit();
  } catch (PDOException $e) {
    die("Query failed " . $e->getMessage());
  }
} else {
  header("Location: ../signup.php");
  exit();
}
