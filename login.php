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
        
        <section class="logon">
            <h1>Είσοδος Χρήστη</h1>
            <hr>
        </section>
        <form action="login.php" method="post">
            <div class="name">
                <span class="left-item"><label for="username">Όνομα Χρήστη :</label></span>
                <span class="center-item"><input type="text" id="username" name="username" required></span>
                <span class="right-item"></span>
            </div>
            <br>
            <div class="pass">
                <span class="left-item"><label for="password">Κωδικός:</label></span>
                <span class="center-item"><input type="password" id="password" name="password" required></span>
                <span class="right-item"></span>
            </div>
            <br>
            <div class="sub-button">
                <span class="right-text"></span>
                <span class="center-item"><a href="offer.html" target="_self" title="submit"><button class="sumbit-button">Είσοδος</button></a></span>
                <span class="right-item"></span>
            </div>
        </form>
        <br>
        <div class="text">
            <span class="right-text"></span>
            <span class="center-item"><a href="register.php">Εγγραφή Νέας Επιχείρησης</a></span>
            <span class="right-item"></span>
        </div>
        <br><br>
        
        <footer>
            <span class="left-text"><a href="C:\Users\steal\Documents\Visual Code\HTML Projects\Globe Oil\Pdf\Oroi.pdf" target="_blank"> « Όροι Χρήσης »</a></span>
            <span class="separator">|</span>
            <span class="right-text"><a href="C:\Users\steal\Documents\Visual Code\HTML Projects\Globe Oil\Pdf\Policy.pdf" target="_blank">« Πολιτική Απορρήτου »</a></span>
        </footer>

    </div>
</body>

</html>