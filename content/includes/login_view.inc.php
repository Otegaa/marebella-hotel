<?php

function displaySuccessMessage()
{
  if (!isset($_SESSION["registration_successful"])) {
    return;
  }
  echo "<div>";
  echo "<p>" . htmlspecialchars($_SESSION["registration_successful"]) . "</p>";
  echo "</div>";

  unset($_SESSION["registration_successful"]);
}


function displayLoginErrors()
{
  if (!isset($_SESSION["errors_login"])) {
    return;
  }

  $errors = $_SESSION["errors_login"];

  echo '<div class="error-box">';
  foreach ($errors as $error) {
    echo '<p>• ' . htmlspecialchars($error) . '</p>';
  }
  echo '</div>';
}
