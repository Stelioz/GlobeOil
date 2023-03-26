<!DOCTYPE html>
<html lang="gr"> <!-- Γλώσσα Σελίδας -->

<head> <!-- Στοιχεία Σελίδας -->
    <meta charset="utf-8"> <!--Κωδικοποίηση Σελίδας -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Συμβατρότητα Σελίδας στους Browsers -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Αρχικοποίηση Σελίδας στον Browser -->
    <title> Globe Oil </title> <!-- Τίτλος Σελίδας -->
    <link rel="stylesheet" href="css/announce.css"> <!-- Σύνδεση με την CSS -->
    
    <script src="Scripts/deleteAnnounce.js"></script>
    <script src="Scripts/createAnnounce.js"></script>
    
</head>

<body> <!-- Σώμα Σελίδας -->
    
    <!-- Επιπλέον πρόσβασης στους Διαχειριστές -->
    <?php
        // Αρχίζει το session για τον έλεγχο ρόλου και εισόδου / εξόδου
        session_start();
        $is_admin = isset($_SESSION['role']) && $_SESSION['role'] == 'Διαχειριστής';
    ?>
    <div class="wrapper">        
        <header> <!-- Κεφαλίδα της Σελίδας-->
        
            <!-- 1o Section του Header που αποτελείται από το Λογότυπο, το Μότο και το Κουμπί Εισόδου -->
            <section class="upper_section">
                <!-- Λογότυπο Σελίδας -->
                <div class="logo">
                    <a href="index.php"> <img src="Photos/GlobeOilLogoM.png" alt="Logo"> </a>
                </div>
                
                <!--Μότο Σελίδας -->
                <div class="moto">
                    <h1> G L O B E&nbsp;&nbsp;&nbsp;O I L  </h1>
                    <h2> Το Μέλλον Στη Διανομή Καυσίμων </h2>
                </div>

                <!-- Κουμπί Εισόδου / Εξόδου -->
                <div>
                    <?php
                        // Έλεγχος αν ο χρήστης είναι συνδεδεμένος ή όχι
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                            // Αν είναι συνδεδεμένος, εμφανίζουμε το κουμπί εξόδου
                            echo '<div class="logout_button">';
                            echo '<a href="Scripts/logoutCheck.php" target="_self" title="Logout"> <button class="logout"> ΕΞΟΔΟΣ </button> </a>';
                            echo '</div>';
                        } else {
                            // Αν δεν είναι συνδεδεμένος, εμφανίζουμε το κουμπί εισόδου
                            echo '<div class="login_button">';
                            echo '<a href="login.php" target="_self" title="Login Page"> <button class="login"> ΕΙΣΟΔΟΣ </button> </a>';
                            echo '</div>';
                        }
                    ?>
                </div>
            </section>

            <!-- 2o Section του Header που αποτελείται από την Μπάρα Πλοήγησης -->
            <section class="lower_section">
                <nav>
                    <ul>
                        <li> <a href="index.php"> AΡΧΙΚΗ </a> </li>
                        <li> <a href="search.php"> ΑΝΑΖΗΤΗΣΗ </a> </li>
                        <li> <a href="offer.php"> ΚΑΤΑΧΩΡΗΣΗ </a> </li>
                        <li> <a href="announce.php" class="current"> ΑΝΑΚΟΙΝΩΣΕΙΣ </a> </li>
                    </ul>
                </nav>
            </section>
        </header>
        
        <!-- PHP για σύνδεση με τη Βάση Δεδομένων -->
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

            // Επιλέγουμε τις τιμές από τον πίνακα offers
            $result = mysqli_query($conn, "SELECT * FROM announcements ORDER BY RegistrationDate DESC");
            if (!$result) {
                die("Το ερώτημα απέτυχε!");
            }
        ?>

<section class="announcements">
  <span>
    <h1>Ανακοινώσεις</h1> 
    <?php
    // Εμφάνιση του κουμπιού για Νέα Ανακοίωνση μόνο για τους Διαχειριστές
    if ($is_admin == true) {
        echo '<button onclick="openForm()">Νέα Ανακοίνωση</button>';
    }
    ?>
    <hr>
  </span>
  
  <?php
  // Εμφάνιση Ανακοινώσεων
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<div id='" . $row["AnnouncementID"] . "'>";
      echo "<h2>" . $row["Title"] . "</h2>";
      echo "<p>Ημερομηνία Ανάρτησης: " . $row["RegistrationDate"] . "</p>";
      echo "<p>" . $row["Text"] . "</p>";
      
      // Εμφάνιση του κουμπιού για Διαγραφή Ανακοίνωσης μόνο για τους Διαχειριστές
      if ($is_admin == true) {
        echo "<button onclick='deleteAnnouncement(" . $row["AnnouncementID"] . ")'>Διαγραφή Ανακοίνωσης</button>";
      }
      echo "<p> <br> </p>";
      echo "</div>";
    }

    // Έναρξη της διαγραφής εφόσον πατηθεί το κουμπί Διαγραφή Ανακοίνωσης
    if (isset($_POST['delete_announcement'])) {
      $delete_id = $_POST['delete_announcement'];
      $sql = "DELETE FROM announcements WHERE AnnouncementID = $delete_id";
      if (mysqli_query($conn, $sql)) {
        echo "Η ανακοίνωση διαγράφηκε!";
      } else {
        echo "Σφάλμα κατά τη διαγραφή: " . mysqli_error($conn);
      }
    }
  } else {
    echo "Δεν βρέθηκαν ανακοινωσεις!";
  }
  ?>

  <!-- The New Announcement form -->
  <div id="announcementForm" class="form-popup" style="display:none">
    <form class="form-container" onsubmit="createAnnouncement(); return false;">
      <h1>New Announcement</h1>
      <label for="title"><b>Title</b></label>
      <input type="text" placeholder="Enter Title" name="title" required>

      <label for="text"><b>Text</b></label>
      <textarea placeholder="Enter Text" name="text" required></textarea>

      <button type="submit" class="btn">Submit</button>
      <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
  </div>

</section>



            
        <footer>
            <span class="left-text"><a href="C:\Users\steal\Documents\Visual Code\HTML Projects\Globe Oil\Pdf\Oroi.pdf" target="_blank"> « Όροι Χρήσης »</a></span>
            <span class="separator">|</span>
            <span class="right-text"><a href="C:\Users\steal\Documents\Visual Code\HTML Projects\Globe Oil\Pdf\Policy.pdf" target="_blank">« Πολιτική Απορρήτου »</a></span>
        </footer>

    </div>
</body>

</html>