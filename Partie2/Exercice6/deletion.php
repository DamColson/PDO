<?php
$db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'fireloupsql');
$appointmentsDeletion = $db->prepare('DELETE FROM appointments WHERE appointments.id=:id');
$appointmentsDeletion->execute(array('id'=>(int)$_GET['id']));
header('location:liste-rendezvous.php');
?>