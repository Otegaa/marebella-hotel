<?php

function isInputEmpty($firstname, $lastname, $dob, $email, $username, $password, $phone)
{
  return empty($firstname) || empty($lastname) || empty($dob) || empty($email) || empty($username) || empty($password) || empty($phone);
}

function isEmailInvalid($email)
{
  return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isUsernameTaken($pdo, $username)
{
  return getUsername($pdo, $username) !== false;
}

function isUsernameInvalidFormat($username)
{
  return !preg_match('/^[a-zA-Z0-9_-]{3,20}$/', $username);
}

function isEmailRegistered($pdo, $email)
{
  return getEmail($pdo, $email) !== false;
}

function isPasswordBad($password)
{
  return strlen($password) < 8;
}

function isPhoneNumberBad($phone)
{
  // space, hyphens and parentheses are cleaned up
  $cleanedUpNum = preg_replace('/[\s\-\(\)]/', '', $phone);

  if (strlen($cleanedUpNum) < 10) {
    return true;
  }

  // if not only digit
  if (!preg_match('/^\+?[\d]+$/', $cleanedUpNum)) {
    return true;
  }

  return false;
}

function isUserAgeUnder18($dob)
{
  $birthDate = new DateTime($dob);
  $today = new DateTime();
  $diff = $today->diff($birthDate);
  $age = $diff->y;

  return $age < 18;
}
