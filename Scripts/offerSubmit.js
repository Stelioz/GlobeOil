function validateSubmit() {
  // Αντιστοίχιση των μεταβλητών UserID και FuelID με τη φόρμα της HTML  
  var user_id = document.getElementsByName("UserID")[0].value;
  var fuel_id = document.getElementsByName("Fuels")[0].value;

  // Δημιουργία XMLHttpRequest αντικειμένου για τον έλεγχο των UserID και FuelID
  var xmlhttp_offer = new XMLHttpRequest();

  // Έλεγχος αν τα UserID και FuelID υπάρχουν στην Bάση Δεδομένων
  xmlhttp_offer.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "exists") {
          alert("Υπάρχει ήδη παρόμοια προσφορά στη βάση δεδομένων!");
          return false;
        }
    }
  }

  // Εποικινωνία με το offerCheck.php
  xmlhttp_offer.open("GET", "Scripts/offerSubmit.php?user_id=" + user_id + "&fuel_id=" + fuel_id, true);
  xmlhttp_offer.send();

  return true;
}