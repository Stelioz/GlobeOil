// Function to open the new announcement form
function openForm() {
    document.getElementById("announcementForm").style.display = "block";
  }
  
  // Function to close the new announcement form
  function closeForm() {
    document.getElementById("announcementForm").style.display = "none";
  }
  
  // Function to create a new announcement
  function createAnnouncement() {
    // Get the values from the form
    var title = document.getElementsByName("title")[0].value;
    var text = document.getElementsByName("text")[0].value;
  
    // Send an AJAX request to create the announcement
    var xhr11 = new XMLHttpRequest();
    xhr11.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Reload the page to show the new announcement
        location.reload();
      }
    };
    xhr11.open('POST', 'Scripts/createAnnounce.php', true);
    xhr11.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr11.send('title=' + title + '&text=' + text);
  }
  