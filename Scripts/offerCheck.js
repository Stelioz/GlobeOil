function validateOffer() {
    // Αντιστοίχιση των μεταβλητών με τη φόρμα της HTML
    var price = parseFloat(document.getElementsByName("Price")[0].value).toFixed(3);
    var expDate = document.getElementsByName("ExpirationDate")[0].value;
    const curDate = new Date(); // Λαμβάνουμε την σημερινή ημερομηνία

    console.log(curDate);
    console.log(expDate);
    
  
    // Έλεγχος αν είναι συμπληρωμένα τα πεδία από τον χρήστη
    if (price == "") {
        alert("Παρακαλούμε συμπληρώστε την τιμή της προσφοράς!");
        return false;
    }
    
    if (expDate == "") {
        alert("Παρακαλούμε συμπληρώστε την ημερομηνία λήξης της προσφοράς!");
        return false;
    }
    
    // Έλεγχος αν η τιμή είναι θετικός αριθμός
    if (isNaN(price) ||  price < 0) {
        alert("Η τιμή προσφοράς θα πρέπει να είναι θετικός αριθμός!");
        return false;
    }

    // Έλγχος αν η ημερομηνία λήξης είναι μετά τη σημερινή
    if (new Date(expDate) < curDate) {
        alert("Η ημερομηνία λήξης δε μπορεί να είναι πριν τη σημερινή!")
        return false;
    }
  
    return true;
  }