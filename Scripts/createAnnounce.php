<?php
session_start();
// Σύνδεση με τον Διακομιστή της Βάσης Δεδομέρων
$conn = mysqli_connect("localhost", "root", "password");
if (!$conn) {
  die("Η σύνδεση απέτυχε!");
}

// Επιλογή της Βάσης Δεδομένων zindros_database
if (!mysqli_select_db($conn, "zindros_database")) {
  die("Η Βάση Δεδομένων δεν βρέθηκε!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $text = $_POST['text'];


  // Eισάγωγή της ανακοίνωσης κατά την υποβολή της φόρμας
  if (isset($_POST['title']) && isset($_POST['text'])) {
    $title = $_POST['title'];
    $text = $_POST['text'];
    $sql = "INSERT INTO announcements (Title, Text, RegistrationDate) VALUES ('$title', '$text', NOW())";
    if (mysqli_query($conn, $sql)) {
      echo "Announcement created successfully";
    } else {
      echo "Error creating announcement: " . mysqli_error($conn);
    }
  }

  mysqli_close($conn);
  exit;
}

die('Invalid request.');

?>