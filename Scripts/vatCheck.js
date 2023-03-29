function validateVAT() {
  // Αντιστοίχιση της μεταβλητής VAT με τη φόρμα  
  var vat = document.getElementsByName("VAT")[0].value;

  // Δημιουργία XMLHttpRequest αντικειμένου για τον έλεγχο του ΑΦΜ
  var xmlhttp_vat = new XMLHttpRequest();

  // Έλεγχος αν το ΑΦΜ είναι αριθμός
  if (isNaN(vat)) {
    alert("Δώστε έναν ορθό ΑΦΜ!");
    return false;
  }

  // Έλεγχος αν το ΑΦΜ είναι ακριβώς 9 ψηφία
  if (!/^\d{9}$/.test(vat)) {
    alert("Ο ΑΦΜ πρέπει να αποτελείται από 9 ψηφία!");
    return false;
  }

  // Έλεγχος αν το VAT υπάρχει στην Bάση Δεδομένων
  xmlhttp_vat.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "exists") {
        alert("Ο ΑΦΜ που εισάγατε υπάρχει ήδη στη βάση δεδομένων!");
        return false;
      }
    }
  };

  // Εποικινωνία με το vatCheck.php
  xmlhttp_vat.open("GET", "Scripts/vatCheck.php?vat=" + vat, true);
  xmlhttp_vat.send();

  return true;
}