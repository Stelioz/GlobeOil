function validateOffer() {
    // Αντιστοίχιση των μεταβλητών με τη φόρμα της HTML
    var brandName = document.getElementsByName("BrandName")[0].value;
    var vat = parseFloat(document.getElementsByName("VAT")[0].value);
    var address = document.getElementsByName("Address")[0].value;
    var municipality = document.getElementsByName("Municipality")[0].value;
    var county = document.getElementsByName("County")[0].value;
    // Θέλουμε η τιμή να είναι float με 3 δεκαδικά ψηφία
    var price = parseFloat(document.getElementsByName("Price")[0].value).toFixed(3);
    var date = document.getElementsByName("ExpirationDate")[0].value;

    
  
    // Έλεγχος αν είναι συμπληρωμένα τα πεδία από τον χρήστη
    if (brandName == "") {
        alert("Παρακαλούμε συμπληρώστε την Επωνυμία της επιχείρησης!");
        return false;
    }

    if (vat == "") {
        alert("Παρακαλούμε συμπληρώστε τον ΑΦΜ της επιχείρησης!");
            return false;
    }
    // Έλεγχος αν το ΑΦΜ είναι αριθμός
    if (isNaN(vat)) {
        alert("Ο ΑΦΜ που δώσατε δεν είναι ορθός!");
        return false;
    }

    // Έλεγχος αν το ΑΦΜ είναι ακριβώς 9 ψηφία
    if (!/^\d{9}$/.test(vat)) {
        alert("Ο Α.Φ.Μ. πρέπει να αποτελείται από 9 ψηφία!");
        return false;
    }

    if (address == "") {
        alert("Παρακαλούμε συμπληρώστε τη διεύθυνση σας!");
        return false;
   }
  
   if (municipality == "") {
        alert("Παρακαλούμε συμπληρώστε τον Δήμο σας!");
        return false;
  }
  
    if (county == "") {
        alert("Παρακαλούμε συμπληρώστε τον Νομό σας!");
        return false;
    }
  
    if (price == "") {
        alert("Παρακαλούμε συμπληρώστε την τιμή της προσφοράς!");
        return false;
    }
    
    // Έλεγχος αν η τιμή έχει θετική τιμή με 3 δεκαδικά ψηφία
    if (isNaN(price) || !isFinite(price) || price < 0) {
        alert("Δώστε μία θετική τιμή με τρία δεκαδικά ψηφία!");
        return false;
    }

    if (date == "") {
        alert("Παρακαλούμε συμπληρώστε την ημερομηνία λήξης της προσφοράς!");
        return false;
    }
  
    return true;
  }