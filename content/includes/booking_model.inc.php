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

function getUserBookings($pdo, $user_id)
{
  $query = "SELECT r.reservationID, r.checkin_date, r.checkout_date, r.number_guests, r.booking_notes, r.total_price, r.booking_date, r.booking_status, a.accommodation_name, a.session_imagepath, a.price_per_night, a.room_type, a.room_size, a.bed_type
  FROM reservations r JOIN accommodation a ON r.accommodationID = a.accommodationID WHERE r.customerID = :user_id ORDER BY r.checkin_date DESC";

  $stmt = $pdo->prepare($query);
  $stmt->execute([':user_id' => $user_id]);

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function verifyUserBooking($pdo, $reservation_id, $user_id)
{
  $query = "SELECT reservationID, booking_status FROM reservations WHERE reservationID = :reservation_id AND customerID = :user_id";
  $stmt = $pdo->prepare($query);
  $stmt->execute([":reservation_id" => $reservation_id, ":user_id" => $user_id]);

  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function cancelBooking($pdo, $reservation_id, $user_id)
{
  $query = "UPDATE reservations SET booking_status = 'cancelled' WHERE reservationID = :reservation_id AND customerID = :user_id";

  $stmt = $pdo->prepare($query);
  $stmt->execute([
    ':reservation_id' => $reservation_id,
    ':user_id' => $user_id
  ]);

  return $stmt->rowCount() > 0;
}
