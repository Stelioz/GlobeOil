function deleteAnnouncement(id) {
    if (confirm('Are you sure you want to delete this announcement?')) {
      // AJAX request για τη διαγραφή της ανακοίνωσης
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          // Επαναφόρτωση της σελίδας για να σβηστεί η διαγεγραμένη ανακοίνωση
          location.reload();
        }
      };
      // Εποικινωνία με το createAnnounce.php
      xhr.open('POST', 'announce.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.send('delete_announcement=' + id);
    }
  }
  