<?php
// Αρχίζει το session για την έξοδο
session_start();

// Μεταβάλουμε τις μεταβλητές
unset($_SESSION['loggedin']);
unset($_SESSION['username']);

// Κλείνουμε το session της εξόδου
session_destroy();

// Ανακατεύθυνση στην σελίδα εισόδου
header("Location: ../login.php");

?>