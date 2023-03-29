<!DOCTYPE html>
<html lang="gr"> <!-- Γλώσσα Σελίδας -->

<head> <!-- Στοιχεία Σελίδας -->
    <meta charset="utf-8"> <!--Κωδικοποίηση Σελίδας -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Συμβατρότητα Σελίδας στους Browsers -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Αρχικοποίηση Σελίδας στον Browser -->
    <title> Globe Oil </title> <!-- Τίτλος Σελίδας -->
    <link rel="stylesheet" href="css/styles.css"> <!-- Σύνδεση με την CSS -->
</head>

<body> <!-- Σώμα Σελίδας -->
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
                <div class="login_button">
                    <?php
                        // Αρχίζει το session για τον έλεγχο εισόδου / εξόδου
                        session_start();
                        // Έλεγχος αν ο χρήστης είναι συνδεδεμένος ή όχι
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                            // Αν είναι συνδεδεμένος, εμφανίζουμε το κουμπί εξόδου
                            echo '<div class="login_button">';
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
                        <li> <a href="search.php" class="current"> ΑΝΑΖΗΤΗΣΗ </a> </li>
                        <li> <a href="offer.php"> ΚΑΤΑΧΩΡΗΣΗ </a> </li>
                        <li> <a href="announce.php"> ΑΝΑΚΟΙΝΩΣΕΙΣ </a> </li>
                    </ul>
                </nav>
            </section>
        </header>
        
        <?php           
            $conn = mysqli_connect("localhost", "root", "password");
            if (!$conn) {
                die("Η σύνδεση απέτυχε!");
            }
    
            if (!mysqli_select_db($conn, "zindros_database")) {
                die("Η Βάση Δεδομένων δεν βρέθηκε!");
            }

            // Επιλέγουμε τους Δήμους και τα Καύσιμα
            $result_counties = mysqli_query($conn, "SELECT * FROM counties");
            if (!$result_counties) {
                die("Το ερώτημα απέτυχε!");
            }
            $result_fuels = mysqli_query($conn, "SELECT * FROM fuels");
            if (!$result_fuels) {
                die("Το ερώτημα απέτυχε!");
            }

            // Τοποθετούμε τους Δήμους και τα Κάυσιμα σε πίνακες
            $counties = array();
            $fuels = array();
            while ($row = $result_counties->fetch_assoc()) {
                $counties[$row['CountyID']] = $row['CountyName'];
            }           
            while ($row = $result_fuels->fetch_assoc()) {
                $fuels[$row['FuelID']] = $row['FuelName'];
            }

        ?>

        <section class="filters">
            <h1>Φίλτρα</h1>
            <hr>
        </section>
        <form method="get">
            <span class="County">
                <span class="left-item"> Νομός: </span>
                <span class="right-item">
                    <select id="dropdown-menu3" name='County'> <!-- Χρηση Dropdown Menu για τους Νομούς -->
                        <?php foreach ($counties as $id => $name): ?>
                            <option value="<?php echo $id; ?>" <?php if(isset($_GET['County']) && $_GET['County'] == $id) echo 'selected'; ?>> <?php echo $name; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </span>
            </span>
            <span class="Fuels">
                <span class="left-item"> Καύσιμο: </span>
                <span class="right-item">
                <select id="dropdown-menu4" name='Fuel'> <!-- Χρηση Dropdown Menu για τα Καύσιμα -->
                        <?php foreach ($fuels as $id => $name): ?>
                            <option value="<?php echo $id; ?>" <?php if(isset($_GET['Fuel']) && $_GET['Fuel'] == $id) echo 'selected'; ?>> <?php echo $name; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </span>
            </span>
            <button type="submit" name="search" class="search-button">ΕΦΑΡΜΟΓΗ</button>
        </form>
        <br>
        
        <?php
            // Αρχικοποιούμε τις μεταβλητές.
            $county = '0';
            $fuel = '0';
            // Έλεγχος αν τα φίλτρα ενεργοποιήθηκαν
            if(isset($_GET['search'])) {
                // Λαμβάνουμε τις τιμές από τη φόρμα των φίλτρων
                $county = $_GET['County'];
                $fuel = $_GET['Fuel'];
            }

            // Κάνουμε JOIN το πίνακα offers με τους πίνακες users και counties ώστε να εμφανίσουμε τις ενεργείς προσφορές
            $query = "SELECT * FROM offers 
                      INNER JOIN users ON offers.UserID = users.UserID
                      WHERE FuelID = $fuel AND CountyID = $county AND ExpirationDate > NOW() ORDER BY Price ASC";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die("Το ερώτημα απέτυχε!");
            }
        ?>

        <section class="search-results">
            <h1>Αποτελέσματα</h1>
            <hr>
            <table>
                <tbody>
                    <?php
                        if(mysqli_num_rows($result) > 0) {
                        // Εμφάνιση των αποτελεσμάτων
                        echo "<table>";
                        echo "<tr><th>Επωνυμία Επιχείρησης | </th><th>Διεύθυνση Επιχείρησης | </th><th>Τιμή Καυσίμου (€) | </th><th>Λήξης Προσφοράς</th></tr>";
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['BrandName'] . "</td>";
                            // Η διεύθυνση της επιχείρησης ανοίγει νέα κατρέλα στο Goggle Maps
                            echo "<td> <a href='https://www.google.com/maps/place/" . urlencode($row['Address']) . "' target='_blank'>" . $row['Address'] . "</a> </td>";
                            echo "<td>" . $row['Price'] . "</td>";
                            echo "<td>" . $row['ExpirationDate'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                ?>
        </section>
        <br><br>
        <footer>
            <span class="left-text"><a href="C:\Users\steal\Documents\Visual Code\HTML Projects\Globe Oil\Pdf\Oroi.pdf" target="_blank"> « Όροι Χρήσης »</a></span>
            <span class="separator">|</span>
            <span class="right-text"><a href="C:\Users\steal\Documents\Visual Code\HTML Projects\Globe Oil\Pdf\Policy.pdf" target="_blank">« Πολιτική Απορρήτου »</a></span>
        </footer>

    </div>
</body>

</html>