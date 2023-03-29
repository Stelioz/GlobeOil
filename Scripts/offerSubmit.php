<?php
// Σύνδεση με τον Διακομιστή της Βάσης Δεδομέρων
$conn = mysqli_connect("localhost", "root", "password");
if (!$conn) {
  die("Η σύνδεση απέτυχε!");
}

// Επιλογή της Βάσης Δεδομένων zindros_database
if (!mysqli_select_db($conn, "zindros_database")) {
  die("Η Βάση Δεδομένων δεν βρέθηκε!");
}

// Εποικινωνία με το offerCheck.js
$user_id = mysqli_real_escape_string($conn, $_GET["user_id"]);
$fuel_id = mysqli_real_escape_string($conn, $_GET["fuel_id"]);

echo "$user_id";
echo "$fuel_id";

// Επιλογή των κατάλληλων παραμέτρων
$sql = "SELECT * FROM offers WHERE UserID = '$user_id' AND FuelID = '$fuel_id' AND ExpirationDate > DATE(NOW())";
$result = mysqli_query($conn, $sql);

// Επιστροφή αν υπάρχει ή όχι καταχώρηση
if (mysqli_num_rows($result) > 0) {
  echo "exists";
} else {
  echo "not exists";
}

mysqli_close($conn);

?>