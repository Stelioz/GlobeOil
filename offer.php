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

            //fetch data from the database
            $username = $_SESSION['username']; //assuming user_id is the unique identifier for your user
            $query = "SELECT BrandName, VAT, Address, MunicipalityID, CountyID FROM users WHERE Username = '$username'";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                printf("Error: %s\n", mysqli_error($conn));
                exit();
            }

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $BrandName = $row["BrandName"];
                $VAT = $row["VAT"];
                $Address = $row["Address"];
                $Municipality = $row["MunicipalityID"];
                $County = $row["CountyID"];
            }

            $conn->close();        
        ?>

        <section class="offer">
            <h1>Καταχώρηση Προσφοράς</h1>
            <hr>
        </section>
        <form action="submit-offer.php" method="post">
            <div class="BrandName">
                <span class="left-item">Επωνυμία Επιχείρησης:</span>
                <span class="center-item"><input type="text" name="BrandName" value="<?php echo $brandName; ?>"></span>
                <span class="right-item"></span>
            </div>
            <div class="VAT">
                <span class="left-item">A.Φ.Μ.:</span>
                <span class="center-item"><input type="text" name="VAT" value="<?php echo $VAT; ?>></span>
                <span class="right-item"></span>
            </div>
            <div class="Address">
                <span class="left-item">Διεύθυνση:</span>
                <span class="center-item"><input type="text" name="Address" value="<?php echo $Address; ?>></span>
                <span class="right-item"></span>
            </div>
            <div class="Municipality">
                <span class="left-item">Δήμος:</span>
                <span class="center-item"><input type="text" name="Municipality" value="<?php echo $Municipality; ?></span>
                <span class="right-item"></span>
            </div>
            <div class="County">
                <span class="left-item">Νομός:</span>
                <span class="center-item"><input type="text" name="County" value="<?php echo $County; ?>></span>
                <span class="right-item"></span>
            </div>
            <div class="fuel">
                <span class="left-item">Είδος Καυσίμου:</span>
                <span class="center-item">
                    <select id="fuel-search">
                        <option value="1"></option>
                        <option value="2">ΑΜΟΛΥΒΔΗ 95</option>
                        <option value="3">ΑΜΟΛΥΒΔΗ 100</option>
                        <option value="4">ΠΕΤΡΕΛΑΙΟ ΚΙΝΗΣΗΣ</option>
                        <option value="5">ΠΕΤΡΕΛΑΙΟ ΘΕΡΜΑΝΣ.</option>
                    </select>
                </span>
                <span class="right-item"></span>
            </div>
            <div class="price">
                <span class="left-item">Τιμή:</span>
                <span class="center-item"><input type="number" required pattern="^\d+(\.\d{1,2})?$"></span>
                <span class="right-item"></span>
            </div>
            <div class="date">
                <span class="left-item">Ημερομηνία Λήξης Προσφοράς:</span>
                <span class="center-item"><input type="date" required></span>
                <span class="right-item"></span>
            </div>
            <div class="sub-button">
                <span class="right-text"></span>
                <span class="center-item"><a href="offer.html" target="_self" title="submit"><button class="sumbit-button">Καταχώρηση</button></a></span>
                <span class="right-item"></span>
            </div>
        </form>
        <br><br>
        
        <footer>
            <span class="left-text"><a href="C:\Users\steal\Documents\Visual Code\HTML Projects\Globe Oil\Pdf\Oroi.pdf" target="_blank"> « Όροι Χρήσης »</a></span>
            <span class="separator">|</span>
            <span class="right-text"><a href="C:\Users\steal\Documents\Visual Code\HTML Projects\Globe Oil\Pdf\Policy.pdf" target="_blank">« Πολιτική Απορρήτου »</a></span>
        </footer>

    </div>
</body>

</html>