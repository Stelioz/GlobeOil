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

                <!-- Κουμπί Εισόδου -->
                <div class="login_button">
                    <a href="login.php" target="_self" title="Login Page"> <button class="login"> ΕΙΣΟΔΟΣ </button> </a>
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

        <section class="offer">
            <h1>Εγγραφή Επιχείρησης</h1>
            <hr>
        </section>
        
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

            // Αντλούμε το UserID της τελευταίας εγγραφής
            $sql_userid = "SELECT MAX(UserID) AS max_id FROM users";

        ?>
        
        <!-- Φόρμα καταχώρησης χρήστη -->
        <form action="submit-offer.php" method="post" >
            <div class="BrandName">
                <span class="left-item"> Επωνυμία Επιχείρησης: </span>
                <span class="center-item"> <input type="text" required maxlength="120"> </span>
                <span class="right-item"> </span>
            </div>
            <div class="VAT">
                <span class="left-item"> A.Φ.Μ.: </span>
                <span class="center-item"> <input type="number" required maxlength="9"> </span>
                <span class="right-item"> </span>
            </div>
            <div class="Address">
                <span class="left-item"> Διεύθυνση: </span>
                <span class="center-item"> <input type="text" required maxlength="120"> </span>
                <span class="right-item"> </span>
            </div>
            <div class="Municipality">
                <span class="left-item"> Δήμος: </span>
                <span class="center-item">
                    <select id="dropdown-menu1"> <!-- Χρηση Dropdown Menu για τους Δήμους -->
                        <?php foreach ($municipalities as $id => $name): ?>
                        <option value="<?php echo $id; ?>"> <?php echo $name; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </span>
                <span class="right-item"></span>
            </div>
            <div class="County">
                <span class="left-item"> Νομός: </span>
                <span class="center-item">
                    <select id="dropdown-menu2"> <!-- Χρηση Dropdown Menu για τους Νομούς -->
                        <?php foreach ($counties as $id => $name): ?>
                        <option value="<?php echo $id; ?>"> <?php echo $name; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </span>
                <span class="right-item"></span>
            </div>
            <div class="Email">
                <span class="left-item"> <label for="password"> Email: </label></span>
                <span class="center-item"> <input type="email" required> </span>
                <span class="right-item"> </span>
            </div>
            <div class="Username">
                <span class="left-item"> <label for="password"> Username: </label></span>
                <span class="center-item"> <input type="text" required minlength="6"> </span>
                <span class="right-item"> </span>
            </div>
            <div class="Password">
                <span class="left-item"> <label for="password"> Κωδικός: </label> </span>
                <span class="center-item"> <input type="password" required minlength="8"> </span>
                <span class="right-item"> </span>
            </div>
            <div class="ConfirmPassword">
                <span class="left-item"> <label for="password"> Επιβεβαίωση Κωδικού: </label></span>
                <span class="center-item"> <input type="password" required minlength="8"> </span>
                <span class="right-item"> </span>
            </div>
            <br>
            <div class="SubButton">
                <span class="right-text"> </span>
                <span class="center-item"> <a href="offer.php" target="_self" title="submit"> <button class="sumbit-button"> Εγγραφή </button> </a> </span>
                <span class="right-item"> </span>
            </div>
        </form>
        
        <!-- PHP για έλεγχο καταχώρησης και εγγραφής στη Βάση Δεδομένων -->
        <?php

        // Ελέγχουμε αν έγινε καταχώρηση της φόρμας
        if (isset($_POST['submit'])) {
            
            // Πέρνουμε τα στοιχεία που εισήγαγε ο χρήστης
            $BrandName = $_POST['name'];
            $VAT = $_POST['vat_number'];
            $Address = $_POST['address'];
            $MunicipalityID = $_POST['municipality'];
            $CountyID = $_POST['county'];
            $Email = $_POST['email'];
            $Username = $_POST['username'];
            $Password = $_POST['password'];
            $ConfirmPassword = $_POST['confirm_password'];
        
            // Ελέγχουμε αν οι κωδικοί ταιριάζουν
            if ($Password != $ConfirmPassword) {
                die("Οι κωδικοί δεν ταιριάζουν!");
            }

            // Εισαγωγή των στοιχείων στην Βάση Δεδομένων
            $sql_register = "INSERT INTO users (BrandName, VAT, Address, MunicipalityID, CountyID, Email, Username, Password) VALUES ('$BrandName', '$VAT', '$Address', '$MunicipalityID', '$CountyID', '$Email', '$Username', '$Password')";
            if ($conn->query($sql_register) === TRUE) {
                echo "Επιτυχημένη Εγγραφή";
            } else {
                echo "Αποτυχημένη Εγγραφή";
            }    
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