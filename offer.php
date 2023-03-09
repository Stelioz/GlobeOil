<!DOCTYPE html>
<html lang="gr"> <!-- Γλώσσα Σελίδας -->

<head> <!-- Στοιχεία Σελίδας -->
    <meta charset="utf-8"> <!--Κωδικοποίηση Σελίδας -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Συμβατρότητα Σελίδας στους Browsers -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Αρχικοποίηση Σελίδας στον Browser -->
    <title> Globe Oil </title> <!-- Τίτλος Σελίδας -->
    <link rel="stylesheet" href="css/styles.css"> <!-- Σύνδεση με την CSS -->
    <!-- Κώδικας της JavaScript για κλήση του ελέγχου της φόρμας καταχώρησης -->
    <script src="Scripts/offerCheck.js"></script>
    <script src="Scripts/offerSubmit.js"></script>
</head>

<body> <!-- Σώμα Σελίδας -->
    
    <!-- Περιορισμός πρόσβασης στους ανώνυμους χρήστες -->
    <?php
        // Αρχίζει το session για τον έλεγχο εισόδου / εξόδου
        session_start();
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            // Γίνεται ανακατεύθυνση στην σελίδα εισόδου
            header('location: login.php');
            exit;
        }
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
                <div class="login_button">
                    <?php
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
            </section>

            <!-- 2o Section του Header που αποτελείται από την Μπάρα Πλοήγησης -->
            <section class="lower_section">
                <nav>
                    <ul>
                        <li> <a href="index.php"> AΡΧΙΚΗ </a> </li>
                        <li> <a href="search.php"> ΑΝΑΖΗΤΗΣΗ </a> </li>
                        <li> <a href="offer.php" class="current"> ΚΑΤΑΧΩΡΗΣΗ </a> </li>
                        <li> <a href="announce.php"> ΑΝΑΚΟΙΝΩΣΕΙΣ </a> </li>
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

            // Επιλέγουμε τα καύσιμα
            $result_fuels = mysqli_query($conn, "SELECT * FROM fuels");
            if (!$result_fuels) {
                die("Το ερώτημα απέτυχε!");
            }

            // Τοποθετούμε τα καύσιμα σε πίνακες
            $fuels = array();
            while ($row = $result_fuels->fetch_assoc()) {
                $fuels[$row['FuelID']] = $row['FuelName'];
            }

            // Ανακτούμε τα δεδομένα από τη βάση δεδομένων ώστε να εισάγουμε αυτόματα στη φόρμα
            $username = $_SESSION['username'];
            // Κάνουμε JOIN το πίνακα users με τους πίνακες municipalities και counties ώστε να εμφανίσουμε τα ονόματα των Δήμων και των Νομών
            $query = "SELECT u.UserID, u.BrandName, u.VAT, u.Address, m.MunicipalityName, c.CountyName FROM users u 
                      INNER JOIN municipalities m ON u.MunicipalityID = m.MunicipalityID 
                      INNER JOIN counties c ON u.CountyID = c.CountyID 
                      WHERE u.Username = '$username'";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                printf("Error: %s\n", mysqli_error($conn));
                exit();
            }

            // Κάνουμε αντιστήχηση των δεδομένων σε μεταβλητές 
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user_id = $row["UserID"];
                $brandName = $row["BrandName"];
                $vat = $row["VAT"];
                $address = $row["Address"];
                $municipality = $row["MunicipalityName"];
                $county = $row["CountyName"];
            }   
        ?>

        <section class="offer">
            <h1>Καταχώρηση Προσφοράς</h1>
            <hr>
        </section>
        <form method="post" name= "myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="offerForm" onsubmit="return validateSubmit()">
            <div class="UserID">
                <span class="right-item"><input type="number" name="UserID" value="<?php echo "$user_id" ?>" readonly></span>
            </div>
            <div class="BrandName">
                <span class="left-item">Επωνυμία Επιχείρησης:</span>
                <span class="right-item"><input type="text" name="BrandName" value="<?php echo "$brandName" ?>" readonly></span>
            </div>
            <div class="VAT">
                <span class="left-item">A.Φ.Μ.:</span>
                <span class="right-item"><input type="text" name="VAT" value="<?php echo "$vat" ?>" readonly></span>
                <span class="right-item"></span>
            </div>
            <div class="Address">
                <span class="left-item">Διεύθυνση:</span>
                <span class="right-item"><input type="text" name="Address" value="<?php echo "$address" ?>" readonly></span>
            </div>
            <div class="Municipality">
                <span class="left-item">Δήμος:</span>
                <span class="right-item"><input type="text" name="Municipality" value="<?php echo "$municipality" ?>" readonly></span>
            </div>
            <div class="County">
                <span class="left-item">Νομός:</span>
                <span class="right-item"><input type="text" name="County" value="<?php echo "$county" ?>" readonly></span>
            </div>
            <div class="Fuels">
                <span class="left-item">Είδος Καυσίμου:</span>
                <span class="right-item">
                    <select id="dropdown-menu3" name='Fuels'> <!-- Χρηση Dropdown Menu για τα καύσιμα -->
                        <?php foreach ($fuels as $id => $name): ?>
                        <option value="<?php echo $id; ?>"> <?php echo $name; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </span>
            </div>
            <div class="Price">
                <span class="left-item">Τιμή σε €:</span>
                <span class="right-item"> <input type="text" name='Price'> </span>
            </div>
            <div class="ExpirationDate">
                <span class="left-item">Ημερομηνία Λήξης Προσφοράς:</span>
                <span class="right-item"> <input type="date" name='ExpirationDate'> </span>
            </div>
            <br>
            <div class="SubButton">
                <span class="right-text"></span>
                <input type="submit" name="submit" value="Καταχώρηση">
            </div>
        </form>

        <!-- Κώδικας PHP για καταχώρηση των στοιχείων στην Βάση Δεδομένων -->
        <?php
            if (isset($_POST["submit"])) {
                // Λαμβάνουμε τις τιμές από τη φόρμα καταχώρησης
                $user_id = $_POST["UserID"];
                $fuel_id = $_POST["Fuels"];
                $date = $_POST["ExpirationDate"];
                $price = $_POST["Price"];

                // Προετοιμασία για εισαγωγή της νέας προσφοράς στη Βάση Δεδομένων
                $sql = "INSERT INTO offers (UserID, FuelID, ExpirationDate, Price) VALUES ('$user_id', '$fuel_id', '$date', '$price')";
                
                // Εκτέλση  εντολής εισαγωγής και έλεγχος καταχώρησης
                if (!mysqli_query($conn, $sql)) {
                    die("Ανεπιτυχής εγγραφή!");
                } else {
                    echo "Επιτυχής εγγραφή!";
                }
                
                $conn->close();     
            }
        ?>

        <br><br>
        
        <footer>
            <span class="left-text"><a href="C:\Users\steal\Documents\Visual Code\HTML Projects\Globe Oil\Pdf\Oroi.pdf" target="_blank"> « Όροι Χρήσης »</a></span>
            <span class="separator">|</span>
            <span class="right-text"><a href="C:\Users\steal\Documents\Visual Code\HTML Projects\Globe Oil\Pdf\Policy.pdf" target="_blank">« Πολιτική Απορρήτου »</a></span>
        </footer>

    </div>
</body>

</html>