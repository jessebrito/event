<?php
include '../config/database.php';
include 'GuestManager.php';

$guestManager = new GuestManager($pdo);
$guest_id = $_GET['guest_id'] ?? null;

if ($guest_id) {
    $guestManager->removeGuest($guest_id);
}

header("Location: guest_form.php?reservation_id=" . $_GET['reservation_id']);
exit;
?>
