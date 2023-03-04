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

            // Αντλούμε το UserID του τελευταίου χρήστη
            $sql_userid = "SELECT MAX(UserID) AS max_id FROM users";
            $result_userid = $conn->query($sql_userid);
            $row = $result_userid->fetch_assoc();
            $max_id = $row['max_id'];
            $user_id = $max_id + 1;

        ?>
        
        <!-- Φόρμα καταχώρησης χρήστη -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="BrandName">
                <span class="left-item"> Επωνυμία Επιχείρησης: </span>
                <span class="right-item"> <input type="text" required maxlength="120" name='BrandName'> </span>
            </div>
            <div class="VAT">
                <span class="left-item"> A.Φ.Μ.: </span>
                <span class="right-item"> <input type="number" required maxlength="9" minlength="9" name='VAT'> </span>
            </div>
            <div class="Address">
                <span class="left-item"> Διεύθυνση: </span>
                <span class="right-item"> <input type="text" required maxlength="120" name='Address'> </span>
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
                <span class="right-item"> <input type="email" name='Email' required> </span>
            </div>
            <div class="Username">
                <span class="left-item"> <label for="password"> Username: </label></span>
                <span class="right-item"> <input type="text" name='Username' required minlength="6"> </span>
            </div>
            <div class="Password">
                <span class="left-item"> <label for="password"> Κωδικός: </label> </span>
                <span class="right-item"> <input type="password" name='Password' required minlength="8"> </span>
            </div>
            <div class="ConfirmPassword">
                <span class="left-item"> <label for="password"> Επιβεβαίωση Κωδικού: </label></span>
                <span class="right-item"> <input type="password" name='ConfirmPassword' required minlength="8"> </span>
            </div>
            <br>
            <div class="SubButton">
                <span class="right-text"> </span>
                <input type="submit" name="submit" value="Register">
                <!-- <span class="right-item"> <a href="offer.php" target="_self" title="submit"> <button class="sumbit-button"> Εγγραφή </button> </a> </span> -->
            </div>
        </form>
        
        <!-- PHP για έλεγχο καταχώρησης και εγγραφής στη Βάση Δεδομένων -->
        <?php

        // Ελέγχουμε αν έγινε καταχώρηση της φόρμας
        if (isset($_POST['submit'])) {
            
            // Πέρνουμε τα στοιχεία που εισήγαγε ο χρήστης
            $BrandName = $_POST['BrandName'];
            $VAT = $_POST['VAT'];
            $Address = $_POST['Address'];
            $MunicipalityID = $_POST['Municipality'];
            $CountyID = $_POST['County'];
            $Email = $_POST['Email'];
            $Username = $_POST['Username'];
            $Password = $_POST['Password'];
            $ConfirmPassword = $_POST['ConfirmPassword'];
        
            // Ελέγχουμε αν οι κωδικοί ταιριάζουν
            if ($Password != $ConfirmPassword) {
                die("Οι κωδικοί δεν ταιριάζουν!");
            }

            // Εισαγωγή των στοιχείων στην Βάση Δεδομένων
            $sql_register = "INSERT INTO users (UserID, BrandName, VAT, Address, MunicipalityID, CountyID, Email, Username, Password) VALUES ('$user_id', '$BrandName', '$VAT', '$Address', '$MunicipalityID', '$CountyID', '$Email', '$Username', '$Password')";
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