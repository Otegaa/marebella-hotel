<?php

function getRoom($pdo, $room_id)
{
  $query = "SELECT * FROM accommodation WHERE accommodationID = :room_id";

  $stmt = $pdo->prepare($query);
  $stmt->execute([":room_id" => $room_id]);

  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAlreadyBookedRoom($pdo, $room_id, $checkin_date, $checkout_date)
{
  $query = "SELECT COUNT(*) FROM reservations WHERE accommodationID = :room_id
           AND booking_status = 'confirmed' AND (checkin_date < :checkout AND checkout_date > :checkin)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([":room_id" => $room_id, ":checkout" => $checkout_date, ":checkin" => $checkin_date]);

  $count = $stmt->fetchColumn();

  return $count > 0;
}


function createBooking($pdo, $room_id, $customer_id, $num_guests, $checkin_date, $checkout_date, $booking_notes, $total_price)
{
  $query = "INSERT INTO reservations (accommodationID, customerID, number_guests, checkin_date, checkout_date, booking_notes, total_price) VALUES(:room_id, :customer_id, :guests, :checkin, :checkout, :notes, :price)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([":room_id" => $room_id, ":customer_id" => $customer_id, ":guests" => $num_guests, ":checkin" => $checkin_date, ":checkout" => $checkout_date, ":notes" => $booking_notes, ":price" => $total_price]);

  return (int)$pdo->lastInsertId();
}
