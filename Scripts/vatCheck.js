function validateVAT() {
  // Αντιστοίχιση της μεταβλητής του ΑΦΜ με τη φόρμα της HTML  
  var vat = document.getElementsByName("VAT")[0].value;
  // Δημιουργία XMLHttpRequest αντικειμένου για τον έλεγχο του ΑΦΜ
  var xmlhttp = new XMLHttpRequest();
    
    // Έλεγχος αν το ΑΦΜ είναι αριθμός
    if (isNaN(vat)) {
        alert("Δώστε έναν ορθό ΑΦΜ!");
        return false;
    }

    // Έλεγχος αν το ΑΦΜ είναι ακριβώς 9 ψηφία
    if (!/^\d{9}$/.test(vat)) {
        alert("Ο Α.Φ.Μ. πρέπει να αποτελείται από 9 ψηφία!");
        return false;
    }
    
    // Έλεγχος αν το ΑΦΜ υπάρχει στην βάση Δεδομένων
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "exists") {
          alert("Ο Α.Φ.Μ. που εισάγατε υπάρχει ήδη στη βάση δεδομένων!");
          return false;
        }
      }
    };
  
    xmlhttp.open("GET", "Scripts/vatCheck.php?vat=" + vat, true);
    xmlhttp.send();
  
    return true;
  }