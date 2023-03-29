function validateSubmit() {
  // Αντιστοίχιση των μεταβλητών UserID και FuelID με τη φόρμα  
  var user_id = document.getElementsByName("UserID")[0].value;
  var fuel_id = document.getElementsByName("Fuels")[0].value;

  // AJAX request αν τα UserID και FuelID υπάρχουν στην Bάση Δεδομένων
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "exists") {
          alert("Υπάρχει ήδη παρόμοια προσφορά στη βάση δεδομένων!");
          return false;
        }
    }
  }

  // Εποικινωνία με το offerCheck.php
  xhr.open("GET", "Scripts/offerSubmit.php?user_id=" + user_id + "&fuel_id=" + fuel_id, true);
  xhr.send();

  return true;
}