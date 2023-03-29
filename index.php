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
                    <h1> G L O B E&nbsp;&nbsp;&nbsp;O I L </h1>
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
                        <li> <a href="index.php" class="current"> AΡΧΙΚΗ </a> </li>
                        <li> <a href="search.php"> ΑΝΑΖΗΤΗΣΗ </a> </li>
                        <li> <a href="offer.php"> ΚΑΤΑΧΩΡΗΣΗ </a> </li>
                        <li> <a href="announce.php"> ΑΝΑΚΟΙΝΩΣΕΙΣ </a> </li>
                    </ul>
                </nav>
            </section>
        </header>

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
        $result = mysqli_query($conn, "SELECT Price FROM offers");
        if (!$result) {
            die("Το ερώτημα απέτυχε!");
        }

        // Ζητάμε τη μέγιστη, τη μέση και την ελάχιστη τιμή για κάθε τύπο καυσίμου
        // Μέγιστη τιμή
        $sql_max95 = "SELECT MAX(Price) AS max_value FROM offers WHERE FuelID = 1";
        $sql_max98 = "SELECT MAX(Price) AS max_value FROM offers WHERE FuelID = 2";
        $sql_max100 = "SELECT MAX(Price) AS max_value FROM offers WHERE FuelID = 3";
        $sql_maxDiesel = "SELECT MAX(Price) AS max_value FROM offers WHERE FuelID = 4";
        $sql_maxThermal = "SELECT MAX(Price) AS max_value FROM offers WHERE FuelID = 5";
        // Μέση τιμή
        $sql_avg95 = "SELECT AVG(Price) AS avg_value FROM offers WHERE FuelID = 1";
        $sql_avg98 = "SELECT AVG(Price) AS avg_value FROM offers WHERE FuelID = 2";
        $sql_avg100 = "SELECT AVG(Price) AS avg_value FROM offers WHERE FuelID = 3";
        $sql_avgDiesel = "SELECT AVG(Price) AS avg_value FROM offers WHERE FuelID = 4";
        $sql_avgThermal = "SELECT AVG(Price) AS avg_value FROM offers WHERE FuelID = 5";
        // Ελάχιστη τιμή
        $sql_min95 = "SELECT MIN(Price) AS min_value FROM offers WHERE FuelID = 1";
        $sql_min98 = "SELECT MIN(Price) AS min_value FROM offers WHERE FuelID = 2";
        $sql_min100 = "SELECT MIN(Price) AS min_value FROM offers WHERE FuelID = 3";
        $sql_minDiesel = "SELECT MIN(Price) AS min_value FROM offers WHERE FuelID = 4";
        $sql_minThermal = "SELECT MIN(Price) AS min_value FROM offers WHERE FuelID = 5";

        // Κάνουμε τα ερωτήματα για τις μέγιστες τιμές των καυσίμων
        $result_max95 = mysqli_query($conn, $sql_max95);
        if ($result_max95 === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }
        $result_max98 = mysqli_query($conn, $sql_max98);
        if ($result_max98 === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }
        $result_max100 = mysqli_query($conn, $sql_max100);
        if ($result_max100 === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }
        $result_maxDiesel = mysqli_query($conn, $sql_maxDiesel);
        if ($result_maxDiesel === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }
        $result_maxThermal = mysqli_query($conn, $sql_maxThermal);
        if ($result_maxThermal === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }

        // Κάνουμε τα ερωτήματα για τη μέση τιμή των καυσίμων
        $result_avg95 = mysqli_query($conn, $sql_avg95);
        if ($result_avg95 === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }
        $result_avg98 = mysqli_query($conn, $sql_avg98);
        if ($result_avg98 === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }
        $result_avg100 = mysqli_query($conn, $sql_avg100);
        if ($result_avg100 === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }
        $result_avgDiesel = mysqli_query($conn, $sql_avgDiesel);
        if ($result_avgDiesel === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }
        $result_avgThermal = mysqli_query($conn, $sql_avgThermal);
        if ($result_avgThermal === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }

        // Κάνουμε τα ερωτήματα για την ελάχιστη τιμή των καυσίμων
        $result_min95 = mysqli_query($conn, $sql_min95);
        if ($result_min95 === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }
        $result_min98 = mysqli_query($conn, $sql_min98);
        if ($result_min98 === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }
        $result_min100 = mysqli_query($conn, $sql_min100);
        if ($result_min100 === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }
        $result_minDiesel = mysqli_query($conn, $sql_minDiesel);
        if ($result_minDiesel === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }
        $result_minThermal = mysqli_query($conn, $sql_minThermal);
        if ($result_minThermal === false) {
            die("Το ερώτημα απέτυχε: " . mysqli_error($conn));
        }

        // Ανακτούμε τις μέγιστες τιμές για κάθε τύπο καυσίμου
        $row_max95 = mysqli_fetch_assoc($result_max95);
        $max_value_95 = $row_max95['max_value'];
        $row_max98 = mysqli_fetch_assoc($result_max98);
        $max_value_98 = $row_max98['max_value'];
        $row_max100 = mysqli_fetch_assoc($result_max100);
        $max_value_100 = $row_max100['max_value'];
        $row_maxDiesel = mysqli_fetch_assoc($result_maxDiesel);
        $max_value_Diesel = $row_maxDiesel['max_value'];
        $row_maxThermal = mysqli_fetch_assoc($result_maxThermal);
        $max_value_Thermal = $row_maxThermal['max_value'];

        // Ανακτούμε τις μέσες τιμές για κάθε τύπο καυσίμου
        $row_avg95 = mysqli_fetch_assoc($result_avg95);
        $avg_value_95 = $row_avg95['avg_value'];
        $avg_formatted_95 = number_format($avg_value_95, 3); // Κρατάμε τα 3 δεκαδικά ψηφία
        $row_avg98 = mysqli_fetch_assoc($result_avg98);
        $avg_value_98 = $row_avg98['avg_value'];
        $avg_formatted_98 = number_format($avg_value_98, 3); // Κρατάμε τα 3 δεκαδικά ψηφία
        $row_avg100 = mysqli_fetch_assoc($result_avg100);
        $avg_value_100 = $row_avg100['avg_value'];
        $avg_formatted_100 = number_format($avg_value_100, 3); // Κρατάμε τα 3 δεκαδικά ψηφία
        $row_avgDiesel = mysqli_fetch_assoc($result_avgDiesel);
        $avg_value_Diesel = $row_avgDiesel['avg_value'];
        $avg_formatted_Diesel = number_format($avg_value_Diesel, 3); // Κρατάμε τα 3 δεκαδικά ψηφία
        $row_avgThermal = mysqli_fetch_assoc($result_avgThermal);
        $avg_value_Thermal = $row_avgThermal['avg_value'];
        $avg_formatted_Thermal = number_format($avg_value_Thermal, 3); // Κρατάμε τα 3 δεκαδικά ψηφία

        // Ανακτούμε τις μέσες τιμές για κάθε τύπο καυσίμου
        $row_min95 = mysqli_fetch_assoc($result_min95);
        $min_value_95 = $row_min95['min_value'];
        $row_min98 = mysqli_fetch_assoc($result_min98);
        $min_value_98 = $row_min98['min_value'];
        $row_min100 = mysqli_fetch_assoc($result_min100);
        $min_value_100 = $row_min100['min_value'];
        $row_minDiesel = mysqli_fetch_assoc($result_minDiesel);
        $min_value_Diesel = $row_minDiesel['min_value'];
        $row_minThermal = mysqli_fetch_assoc($result_minThermal);
        $min_value_Thermal = $row_minThermal['min_value'];
        ?>

        <section class="prices">
            <h1>Ημερήσια Σύνοψη Τιμών</h1>
            <h3><?php echo date('d/m/Y'); ?></h3> <!-- Τρέχουσα ημέρα -->
            <hr>
            <div>
                <ul class="unleaded95"> <!-- Τιμές για Βενζίνη 95 -->
                    <li>
                        <h2>Τιμή Αμόλυβδης Βενζίνης 95</h2>
                    </li>
                    <h3>Μέγιστη: <?php echo "$max_value_95" ?>€ / Ελάχιστη: <?php echo "$min_value_95" ?>€ / Μέση: <?php echo "$avg_formatted_95" ?>€</h3></br>
                </ul>
                <ul class="unleaded98"> <!-- Τιμές για Βενζίνη 98 -->
                    <li>
                        <h2>Τιμή Αμόλυβδης Βενζίνης 98</h2>
                    </li>
                    <h3>Μέγιστη: <?php echo "$max_value_98" ?>€ / Ελάχιστη: <?php echo "$min_value_98" ?>€ / Μέση: <?php echo "$avg_formatted_98" ?>€</h3></br>
                </ul>
                <ul class="unleaded100"> <!-- Τιμές για Βενζίνη 100 -->
                    <li>
                        <h2>Τιμή Αμόλυβδης Βενζίνης 100</h2>
                    </li>
                    <h3>Μέγιστη: <?php echo "$max_value_100" ?>€ / Ελάχιστη: <?php echo "$min_value_100" ?>€ / Μέση: <?php echo "$avg_formatted_100" ?>€</h3></br>
                </ul>
                <ul class="diesel"> <!-- Τιμές για Πετρέλαιο Κίνησης -->
                    <li>
                        <h2>Τιμή Πετρελαίου Κίνησης</h2>
                    </li>
                    <h3>Μέγιστη: <?php echo "$max_value_Diesel" ?>€ / Ελάχιστη: <?php echo "$min_value_Diesel" ?>€ / Μέση: <?php echo "$avg_formatted_Diesel" ?>€</h3></br>
                </ul>
                <ul class="thermal"> <!-- Τιμές για Πετρέλαιο Θέρμανσης -->
                    <li>
                        <h2>Τιμή Πετρελαίου Θέρμανσης</h2>
                    </li>
                    <h3>Μέγιστη: <?php echo "$max_value_Thermal" ?>€ / Ελάχιστη: <?php echo "$min_value_Thermal" ?>€ / Μέση: <?php echo "$avg_formatted_Thermal" ?>€</h3>
                </ul>
            </div>
        </section>
        <br><br>
        <section class="announcements">
            <h1>Τελευταίες Ανακοινώσεις</h1>
            <hr>

            <?php
            // Ζητάμε τις 3 τελευταίες ανακοινώσεις από τη Βάση Δεδομένων 
            $sql_announce = "SELECT * FROM announcements ORDER BY RegistrationDate DESC LIMIT 3";
            $result_announce = mysqli_query($conn, $sql_announce);

            // Εμφάνηση των 3 τελευταίες ανακοινώσεις ή μηνύματος λάθους
            if (mysqli_num_rows($result_announce) == 0) {
                echo "Δεν βρέθηκαν ανακοινώσεις!";
            } else {
                echo '<ul>';
                while ($row = mysqli_fetch_assoc($result_announce)) {
                    $date = date('d/m/Y', strtotime($row['RegistrationDate']));
                    $title = htmlspecialchars($row['Title'], ENT_QUOTES);
                    $id = $row['AnnouncementID'];
                    echo "<li><h3>$date</h3></li>"; // Εμφάνιση των ημερομηνιών
                    echo "<a href='announce.php#$id'><h2>$title</h2></a></br>"; // Εμφάνιση των τίτλων με link για τη σελίδα Ανακοινώσεων
                }
            }
            ?>
        </section>
        <footer> <!-- Υποσέλιδο της Σελίδας-->
            <span class="left-text"><a href="Pdf\Oroi.pdf" target="_blank"> « Όροι Χρήσης »</a></span>
            <span class="separator">|</span>
            <span class="right-text"><a href="Pdf\Policy.pdf" target="_blank">« Πολιτική Απορρήτου »</a></span>
        </footer>
    </div>
</body>

</html>