<?php
$conn = new mysqli("localhost", "root", "", "parking_intelligent");

if ($conn->connect_error) {
    die("Échec connexion: " . $conn->connect_error);
}

// Récupération des données
$nom = $_POST['nom_utilisateur'];
$cin = $_POST['cin'];
$jour_reservation = $_POST['jour_reservation'];
$option = $_POST['option_radio'];
$date_expiration = date('Y-m-d', strtotime($jour_reservation . ' +1 day'));

// Chercher une place disponible
$place_sql = "SELECT * FROM places WHERE disponible = 1 LIMIT 1";
$place_result = $conn->query($place_sql);

if ($place_result->num_rows > 0) {
    $place = $place_result->fetch_assoc();
    $id_place = $place['id'];

    // Enregistrer la réservation
    $insert_sql = "INSERT INTO reservations (nom_utilisateur, cin, jour_reservation, option_radio, id_place, date_expiration)
                   VALUES ('$nom', '$cin', '$jour_reservation', '$option', $id_place, '$date_expiration')";
    $conn->query($insert_sql);

    // Rendre la place indisponible
    $update_place = "UPDATE places SET disponible = 0 WHERE id = $id_place";
    $conn->query($update_place);

    echo "Réservation réussie ! Place numéro: " . $place['numero_place'];
} else {
    echo "❌ Aucune place disponible.";
}

$conn->close();
?>
