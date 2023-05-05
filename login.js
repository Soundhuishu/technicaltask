<script>
  // Get the form element
  const form = document.querySelector('form');

  // Add event listener for form submission
  form.addEventListener('submit', (e) => {
    e.preventDefault(); // prevent default form submission

    // Get the form data
    const formData = new FormData(form);
    
    // Send a POST request to the PHP login script
    fetch('php/login.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      if (data.includes('Login successful')) {
        // Redirect to the profile page
        window.location.href = '/profile.php';
      } else {
        // Display an error message
        const error = document.getElementById('error');
        error.textContent = data;
      }
    })
    .catch(error => console.error(error));
  });
</script>
