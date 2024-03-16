function confirmLogout() {
    // Add your logout logic here
    // For example, redirect to the PHP script that handles logout
    window.location.href = "logout.php";
  }

  function cancelLogout() {
    // Add any specific behavior for canceling logout
    // For example, close the modal
    document.getElementById('myModal').style.display = 'none';
  }