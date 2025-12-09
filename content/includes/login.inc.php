<?php
require_once 'config_session.inc.php';
require_once 'dbh.inc.php';
require_once 'login_model.inc.php';
require_once 'login_contr.inc.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
  $username = trim($_POST["username"]);
  $password = $_POST["password"];

  try {
    $errors = [];

    if (isInputEmpty($username, $password)) {
      $errors["empty_input"] = "Please fill in all fields!";
    }

    $result = getUser($pdo, $username);

    if (isUsernameWrong($result)) {
      $errors["login_incorrect"] = "Incorrect login info!";
    }

    if (!isUsernameWrong($result) && isPasswordWrong($password, $result["password_hash"])) {
      $errors["login_incorrect"] = "Incorrect login info!";
    }

    if ($errors) {
      $_SESSION["errors_login"] = $errors;
      header("Location: ../login.php");
      exit();
    }

    // Login successful
    session_regenerate_id(true);

    $_SESSION["user_id"] = $result["customerID"];
    $_SESSION["user_username"] = $result["username"];
    $_SESSION["user_firstname"] = $result["customer_forename"];
    $_SESSION["user_lastname"] = $result["customer_surname"];
    $_SESSION["user_email"] = $result["customer_email"];
    $_SESSION['last_regeneration'] = time();

    $pdo = null;
    $stmt = null;

    // Check if user was trying to access a specific page
    if (isset($_SESSION["redirect_after_login"])) {
      $redirect_to = $_SESSION["redirect_after_login"];
      unset($_SESSION["redirect_after_login"]);
      header("Location: ../$redirect_to");
    } else {
      header("Location: ../homepage.php");
    }
    exit();
  } catch (PDOException $e) {
    die("Query failed" . $e->getMessage());
  }
} else {
  header("Location: ../login.php");
  exit();
}
