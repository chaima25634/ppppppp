<?php
$conn = new mysqli("localhost", "root", "", "parking");

if ($conn->connect_error) {
    die("Échec de connexion: " . $conn->connect_error);
}

$nom = $_POST['nom_utilisateur'];
$cin = $_POST['cin'];
$jour_reservation = $_POST['jour_reservation'];

// Concaténer les cases cochées
$options = isset($_POST['checkbox']) ? implode(",", $_POST['checkbox']) : "";

// Chercher une place disponible
$place_sql = "SELECT * FROM places WHERE disponible = 1 LIMIT 1";
$place_result = $conn->query($place_sql);

if ($place_result->num_rows > 0) {
    $place = $place_result->fetch_assoc();
    $id_place = $place['id'];

    // Enregistrer la réservation (sans besoin de calculer date_expiration ici)
    $insert_sql = "INSERT INTO reservations (nom_utilisateur, cin, jour_reservation, options_checkbox, id_place)
                   VALUES ('$nom', '$cin', '$jour_reservation', '$options', $id_place)";
    if ($conn->query($insert_sql) === TRUE) {
        echo "✅ Réservation réussie ! Place numéro: " . $place['numero_place'];
    } else {
        echo "Erreur lors de l'enregistrement de la réservation : " . $conn->error;
    }

    // Rendre la place indisponible
    $update_place = "UPDATE places SET disponible = 0 WHERE id = $id_place";
    $conn->query($update_place);

    echo " Réservation réussie ! Place numéro: " . $place['numero_place'];
    
    header("Location: page7.html");
    exit();
} else {
    echo "<script>alert('Aucune place disponible'); window.history.back();</script>";
}
$conn->close();
?>
