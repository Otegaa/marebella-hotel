function openCancelModal(reservationId, roomName) {
  document.getElementById('modalReservationId').textContent = reservationId;
  document.getElementById('modalRoomName').textContent = roomName;
  document.getElementById('modalReservationIdInput').value = reservationId;

  document.getElementById('cancelModal').classList.add('modal-active');
  document.getElementById('modalOverlay').classList.add('modal-overlay-active');

  document.body.style.overflow = 'hidden';
}

function closeCancelModal() {
  document.getElementById('cancelModal').classList.remove('modal-active');
  document
    .getElementById('modalOverlay')
    .classList.remove('modal-overlay-active');

  document.body.style.overflow = 'auto';
}

document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') {
    closeCancelModal();
  }
});
