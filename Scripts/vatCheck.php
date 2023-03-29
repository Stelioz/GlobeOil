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

// Εποικινωνία με το vatCheck.js
$vat = mysqli_real_escape_string($conn, $_GET["vat"]);

// Επιλογή των κατάλληλων παραμέτρων
$sql = "SELECT VAT FROM users WHERE VAT = '$vat'";
$result = mysqli_query($conn, $sql);

// Επιστροφή αν υπάρχει ή όχι καταχώρηση
if (mysqli_num_rows($result) > 0) {
  echo "exists";
} else {
  echo "not exists";
}

mysqli_close($conn);

?>