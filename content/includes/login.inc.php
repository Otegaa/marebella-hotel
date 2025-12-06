<?php

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
  $username = trim($_POST["username"]);
  $password = $_POST["password"];

  try {
    require_once 'config_session.inc.php';
    require_once 'dbh.inc.php';
    require_once 'login_model.inc.php';
    require_once 'login_contr.inc.php';

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
    $_SESSION["user_email"] = $result["customer_email"];
    $_SESSION['last_regeneration'] = time();

    $pdo = null;
    $stmt = null;

    header("Location: ../homepage.php");
    exit();
  } catch (PDOException $e) {
    die("Query failed" . $e->getMessage());
  }
} else {
  header("Location: ../login.php");
  exit();
}
