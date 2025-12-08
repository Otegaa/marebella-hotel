<?php

function isBookingInputEmpty($num_guests, $checkin_date, $checkout_date)
{
  return empty($num_guests) || empty($checkin_date) || empty($checkout_date);
}

function isCheckinInPast($checkin_date)
{
  return $checkin_date < date('Y-m-d');
}

function isCheckOutBeforeCheckIn($checkin_date, $checkout_date)
{
  return $checkout_date <=  $checkin_date;
}

function isStayTooShort($checkin_date, $checkout_date)
{
  $checkin = new DateTime($checkin_date);
  $checkout = new DateTime($checkout_date);
  $nights = $checkin->diff($checkout)->days;

  return $nights < 1;
}

function isNumberOfGuestsInvalid($num_guests)
{
  return $num_guests <= 0;
}

function isGuestsExceedCapacity($num_guests, $max_occupancy)
{
  return $num_guests > $max_occupancy;
}

function isRoomAlreadyBooked($pdo, $room_id, $checkin_date, $checkout_date)
{
  return getAlreadyBookedRoom($pdo, $room_id, $checkin_date, $checkout_date);
}
