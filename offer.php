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
                        <li> <a href="offer.php" class="current"> ΚΑΤΑΧΩΡΗΣΗ </a> </li>
                        <li> <a href="announce.php"> ΑΝΑΚΟΙΝΩΣΕΙΣ </a> </li>
                    </ul>
                </nav>
            </section>

        </header>

        <section class="offer">
            <h1>Καταχώρηση Προσφοράς</h1>
            <hr>
        </section>
        <form action="submit-offer.php" method="post">
            <div class="corporation">
                <span class="left-item">Επωνυμία Επιχείρησης:</span>
                <span class="center-item"><input type="text" required></span>
                <span class="right-item"></span>
            </div>
            <div class="afm">
                <span class="left-item">A.Φ.Μ.:</span>
                <span class="center-item"><input type="number" required maxlength="9"></span>
                <span class="right-item"></span>
            </div>
            <div class="address">
                <span class="left-item">Διεύθυνση:</span>
                <span class="center-item"><input type="text" required></span>
                <span class="right-item"></span>
            </div>
            <div class="town">
                <span class="left-item">Δήμος:</span>
                <span class="center-item">
                    <select id="dropdown-search">
                        <option value="1"></option>
                        <option value="2">Δ. ΑΘΗΝΑΙΩΝ</option>
                        <option value="3">Δ. ΚΑΛΛΙΘΕΑΣ</option>
                        <option value="4">Δ. ΠΕΡΙΣΤΕΡΙΟΥ</option>
                        <option value="5">Δ. ΔΑΦΝΗΣ - ΥΜΜΗΤΟΥ</option>
                    </select>
                </span>
                <span class="right-item"></span>
            </div>
            <div class="area">
                <span class="left-item">Νομός:</span>
                <span class="center-item">
                    <select id="dropdown-search">
                        <option value="1"></option>
                        <option value="2">Ν. ΑΤΤΙΚΗΣ</option>
                        <option value="3">Ν. ΑΙΤΩΛΟΑΚΑΡΝΑΝΙΑΣ</option>
                        <option value="4">Ν. ΙΩΑΝΝΙΝΩΝ</option>
                        <option value="5">Ν. ΚΑΒΑΛΑΣ</option>
                    </select>
                </span>
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