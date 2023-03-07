<!DOCTYPE html>
<html lang="gr"> <!-- Γλώσσα Σελίδας -->

<head> <!-- Στοιχεία Σελίδας -->
    <meta charset="utf-8"> <!--Κωδικοποίηση Σελίδας -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Συμβατρότητα Σελίδας στους Browsers -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Αρχικοποίηση Σελίδας στον Browser -->
    <title> Globe Oil </title> <!-- Τίτλος Σελίδας -->
    <link rel="stylesheet" href="css/styles.css"> <!-- Σύνδεση με την CSS -->
    <!-- Κώδικας της JavaScript για κλήση του ελέγχου της φόρμας καταχώρησης πλην του ΑΦΜ -->
    <script src="Scripts/formCheck.js"></script>
    <!-- Κώδικας της JavaScript για κλήση του ελέγχου του ΑΦΜ -->
    <script src="Scripts/vatCheck.js"></script>
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
                        <li> <a href="search.php"> ΑΝΑΖΗΤΗΣΗ </a> </li>
                        <li> <a href="offer.php"> ΚΑΤΑΧΩΡΗΣΗ </a> </li>
                        <li> <a href="announce.php"> ΑΝΑΚΟΙΝΩΣΕΙΣ </a> </li>
                    </ul>
                </nav>
            </section>
        </header>
        
        <!-- PHP για σύνδεση με τη Βάση Δεδομένων -->
        <?php           
            $conn = mysqli_connect("localhost", "root", "password");
            if (!$conn) {
                die("Η σύνδεση απέτυχε!");
            }
    
            if (!mysqli_select_db($conn, "zindros_database")) {
                die("Η Βάση Δεδομένων δεν βρέθηκε!");
            }

            // Επιλέγουμε τις τους Δήμους και τους Νομούς
            $result_municipalities = mysqli_query($conn, "SELECT * FROM municipalities");
            if (!$result_municipalities) {
                die("Το ερώτημα απέτυχε!");
            }
            $result_counties = mysqli_query($conn, "SELECT * FROM counties");
            if (!$result_counties) {
                die("Το ερώτημα απέτυχε!");
            }

            // Τοποθετούμε τους Δήμους και τους Νομούς σε πίνακες
            $municipalities = array();
            $counties = array();
            while ($row = $result_municipalities->fetch_assoc()) {
                $municipalities[$row['MunicipalityID']] = $row['MunicipalityName'];
            }           
            while ($row = $result_counties->fetch_assoc()) {
                $counties[$row['CountyID']] = $row['CountyName'];
            }

            // Αντλούμε το UserID του τελευταίου χρήστη
            $sql_userid = "SELECT MAX(UserID) AS max_id FROM users";
            $result_userid = $conn->query($sql_userid);
            $row = $result_userid->fetch_assoc();
            $max_id = $row['max_id'];
            // Το user_id θα χρησιμοποιηθεί κατά την εγγραφή στη Βάση Δεδομένων
            $user_id = $max_id + 1;
        ?>

        <section class="offer">
            <h1>Εγγραφή Επιχείρησης</h1>
            <hr>
        </section>
        
        <!-- Φόρμα καταχώρησης χρήστη -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="myForm" onsubmit="return validateVAT() && validateForm()">
            <div class="BrandName">
                <span class="left-item"> Επωνυμία Επιχείρησης: </span>
                <span class="right-item"> <input type="text" name='BrandName'> </span>
            </div>
            <div class="VAT">
                <span class="left-item"> A.Φ.Μ.: </span>
                <span class="right-item"> <input type="text" name='VAT'> </span>
            </div>
            <div class="Address">
                <span class="left-item"> Διεύθυνση: </span>
                <span class="right-item"> <input type="text" name='Address'> </span>
            </div>
            <div class="Municipality">
                <span class="left-item"> Δήμος: </span>
                <span class="right-item">
                    <select id="dropdown-menu1" name='Municipality'> <!-- Χρηση Dropdown Menu για τους Δήμους -->
                        <?php foreach ($municipalities as $id => $name): ?>
                        <option value="<?php echo $id; ?>"> <?php echo $name; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </span>
            </div>
            <div class="County">
                <span class="left-item"> Νομός: </span>
                <span class="right-item">
                    <select id="dropdown-menu2" name='County'> <!-- Χρηση Dropdown Menu για τους Νομούς -->
                        <?php foreach ($counties as $id => $name): ?>
                        <option value="<?php echo $id; ?>"> <?php echo $name; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </span>
                <span class="right-item"></span>
            </div>
            <div class="Email">
                <span class="left-item"> <label for="password"> Email: </label></span>
                <span class="right-item"> <input type="email" name='Email'> </span>
            </div>
            <div class="Username">
                <span class="left-item"> <label for="password"> Username: </label></span>
                <span class="right-item"> <input type="text" name='Username'> </span>
            </div>
            <div class="Password">
                <span class="left-item"> <label for="password"> Κωδικός: </label> </span>
                <span class="right-item"> <input type="password" name='Password'> </span>
            </div>
            <div class="ConfirmPassword">
                <span class="left-item"> <label for="password"> Επιβεβαίωση Κωδικού: </label></span>
                <span class="right-item"> <input type="password" name='ConfirmPassword'> </span>
            </div>
            <br>
            <div class="SubButton">
                <span class="right-text"> </span>            
                <input type="submit" name="submit" value="Register">
            </div>
        </form>
        
        <!-- Κώδικας PHP για καταχώρηση των στοιχείων στην Βάση Δεδομένων -->
        <?php
            if (isset($_POST["submit"])) {
                // Λαμβάνουμε τις τιμές από τη φόρμα καταχώρησης
                $brandName = $_POST["BrandName"];
                $vat = $_POST["VAT"];
                $address = $_POST["Address"];
                $municipality = $_POST["Municipality"];
                $county = $_POST["County"];
                $email = $_POST["Email"];
                $username = $_POST["Username"];
                $password = $_POST["Password"];

                // Αυτόματη ανάθεση τιμής για τη στήλη Role
                $role = "Επιχείρηση";

                // Προετοιμασία για εισαγωγή του νεου χρήστη στη Βάση Δεδομένων
                $sql = "INSERT INTO users (UserID, BrandName, VAT, Address, MunicipalityID, CountyID, Email, Role, Username, Password) VALUES ('$user_id', '$brandName', '$vat', '$address', '$municipality', '$county', '$email', '$role', '$username', '$password' )";
                
                // Εκτέλση  εντολής εισαγωγής και έλεγχος καταχώρησης
                if (!mysqli_query($conn, $sql)) {
                    die("Ανεπιτυχής εγγραφή!");
                }
                
                echo "Επιτυχής εγγραφή!";
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