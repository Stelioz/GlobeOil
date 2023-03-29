function validateForm() {
  // Αντιστοίχιση των μεταβλητών με τη φόρμα της HTML
  var brandName = document.getElementsByName("BrandName")[0].value;
  var address = document.getElementsByName("Address")[0].value;
  var email = document.getElementsByName("Email")[0].value;
  var username = document.getElementsByName("Username")[0].value;
  var password = document.getElementsByName("Password")[0].value;
  var confirmPassword = document.getElementsByName("ConfirmPassword")[0].value;

  // Έλεγχος αν είναι συμπληρωμένα τα πεδία από τον χρήστη
  if (brandName == "") {
    alert("Παρακαλούμε συμπληρώστε την Επωνυμία της επιχείρησης!");
    return false;
  }

  if (address == "") {
    alert("Παρακαλούμε συμπληρώστε τη διεύθυνση σας!");
    return false;
  }

  if (email == "") {
    alert("Παρακαλούμε συμπληρώστε το email σας!");
    return false;
  }

  if (username == "") {
    alert("Παρακαλούμε συμπληρώστε το Username σας!");
    return false;
  }

  if (password == "") {
    alert("Παρακαλούμε συμπληρώστε τον κωδικό πρόσβασης!");
    return false;
  }

  if (confirmPassword == "") {
    alert("Παρακαλούμε συμπληρώστε την επιβεβαίωση του κωδικού πρόσβασης!");
    return false;
  }

  // Έλεγχος αν ο κωδικός είναι τουλάχιστον 8 χαρακτήρες και έχει 1 κεφαλαίο γράμμα και 1 αριθμό
  const passwordRegex = /^(?=.*\d)(?=.*[A-Z])[a-zA-Z0-9]{8,}$/;
  if (!passwordRegex.test(password)) {
    alert("Ο κωδικός θα πρέπει να έχει μήκος τουλάχιστον 8 χαρακτήρων και να περιέχει 1 κεφαλαίο γράμμα και 1 αριθμό!");
    return false;
  }

  // Έλεγχος αν τα password and confirmPassword ταιριάζουν
  if (password !== confirmPassword) {
    alert("Ο κωδικός πρόσβασης και η επιβεβαίωσή του δεν ταιριάζουν!");
    return false;
  }

  return true;
}