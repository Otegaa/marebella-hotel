<?php

function isInputEmpty($username, $pwd)
{
  return empty($username) || empty($pwd);
}

function isUsernameWrong($result)
{
  return !$result;
}

function isPasswordWrong($password, $password_hash)
{
  return !password_verify($password, $password_hash);
}
