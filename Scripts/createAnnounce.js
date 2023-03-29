// Ανοίγει τη φόρμα της νέας ανακοίνωσης
function openForm() {
    document.getElementById("announcementForm").style.display = "block";
  }
  
  // Κλείνει τη φόρμα της νέας ανακοίνωσης
  function closeForm() {
    document.getElementById("announcementForm").style.display = "none";
  }
  
  // Function ώστε να καταστεί δυνατή η δημιουργία νέας ανακοίνωσης
  function createAnnouncement() {
    // Αντιστοίχιση των μεταβλητών title και text με τη φόρμα 
    var title = document.getElementsByName("title")[0].value;
    var text = document.getElementsByName("text")[0].value;
  
    // AJAX request για τη δημιουργία νέας ανακοίνωσης
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Επαναφόρτωση της σελίδας για να εμφανιστεί η νέα ανακοίνωση
        location.reload();
      }
    };

    // Εποικινωνία με το createAnnounce.php
    xhr.open('POST', 'Scripts/createAnnounce.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('title=' + title + '&text=' + text);
  }
  