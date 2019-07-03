<?php
$db = new PDO('mysql:host=localhost;dbname=hospitalE2N', 'Fireloup', 'Girouette301286');
$patientsDeletion = $db->prepare('DELETE FROM patients WHERE patients.id=:id');
$patientsDeletion->execute(array('id'=>(int)$_GET['id']));
header('location:liste-patients.php');
?>