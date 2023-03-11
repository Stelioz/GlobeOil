<?php 
    // Αρχίζει το session για την είσοδο
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

    // Λαμβάνουμε τα username και password από τη φόρμα
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Επιλέγουμε τις κατάλληλες τιμές από τον πίνακα users
    $sql_registered = "SELECT * FROM users WHERE Username='$username' AND Password='$password' AND Role IS NOT NULL";
    $result_registered = mysqli_query($conn, $sql_registered);

    // Έλεγχος αν ο user είναι καταχωρημένος
    if (mysqli_num_rows($result_registered) == 1) {
        // Λαμβάνουμε την εγγραφή του χρήστη από το αποτέλεσμα του ερωτήματος
        $row = mysqli_fetch_assoc($result_registered);
        // Μεταβάλουμε τις μεταβλητές
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['Role']; // Αποθηκεύουμε τον ρόλο του χρήστη στο session
        // Ανακατεύθυνση στην σελίδα προσφορών
        header("Location: ../offer.php");
    } else {
        echo "Λανθασμένα Όνομα Χρήστη ή Κωδικός Πρόσβασης!";
    }

    mysqli_close($conn);
?>