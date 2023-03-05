function validateForm() {
  // Αντιστοίχιση των μεταβλητών με τη φόρμα της HTML
    const brandName = document.forms[0]["BrandName"].value;
    const vat = document.forms[0]["VAT"].value;
    const address = document.forms[0]["Address"].value;
    const email = document.forms[0]["Email"].value;
    const username = document.forms[0]["Username"].value;
    const password = document.forms[0]["Password"].value;
    const confirmPassword = document.forms[0]["ConfirmPassword"].value;
  
    // Έλεγχος αν όλα τα πεδία είνα συμπληρωμένα
    if (brandName === "" || vat === "" || address === "" || email === "" || username === "" || password === "" || confirmPassword === "") {
      alert("Συμπληρώστε όλα τα πεδία");
      return false;
    }
  
    // Check that the VAT field is a number
    if (isNaN(vat)) {
      alert("Please enter a valid VAT number");
      return false;
    }
    
    // Check that the VAT field has exactly 9 digits
    if (vat.length !== 9) {
      alert("VAT number should have exactly 9 digits");
      return false;
    }
  
    // Check that the password and confirm password fields match
    if (password !== confirmPassword) {
      alert("Passwords do not match");
      return false;
    }
  
    // Check that the password field is at least 8 characters and has at least one number and one capital letter
    const passwordRegex = /^(?=.*\d)(?=.*[A-Z])[a-zA-Z0-9]{8,}$/;
    if (!passwordRegex.test(password)) {
      alert("Password should be at least 8 characters long and contain at least one number and one capital letter");
      return false;
    }
  
    // Check that the email field is a valid email format
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      alert("Please enter a valid email address");
      return false;
    }
  
    // If all checks pass, return true to submit the form
    return true;
  }