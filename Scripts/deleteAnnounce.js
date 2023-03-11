function deleteAnnouncement(id) {
    if (confirm('Are you sure you want to delete this announcement?')) {
      // Send an AJAX request to delete the announcement
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          // Reload the page to show the updated announcements list
          location.reload();
        }
      };
      xhr.open('POST', 'announce.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.send('delete_announcement=' + id);
    }
  }
  