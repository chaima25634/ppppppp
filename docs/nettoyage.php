<?php
$conn = new mysqli("localhost", "root", "", "parking");

if ($conn->connect_error) {
    die("Échec connexion: " . $conn->connect_error);
}

// Sélectionner les réservations expirées
$sql = "SELECT * FROM reservations WHERE date_expiration < CURDATE()";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $id_place = $row['id_place'];

    // Supprimer la réservation
    $conn->query("DELETE FROM reservations WHERE id = " . $row['id']);

    // Libérer la place
    $conn->query("UPDATE places SET disponible = 1 WHERE id = $id_place");
}

echo "Nettoyage terminé.";

$conn->close();
?>
