<script>
// Create a new XMLHttpRequest object
let xhr = new XMLHttpRequest();

// Set the request URL and method
xhr.open('GET', 'fetch-users.php', true);

// Set the response type
xhr.responseType = 'json';

// Define the onload handler
xhr.onload = function() {
  // Check if the request was successful
  if (xhr.status === 200) {
    // Get the response data
    let users = xhr.response;

    // Create a new table row for each user
    let html = '';
    for (let i = 0; i < users.length; i++) {
      html += '<tr><td>' + users[i].firstname + '</td><td>' + users[i].lastname + '</td><td>' + users[i].email + '</td></tr>';
    }

    // Set the HTML of the users tbody element
    document.querySelector('#users').innerHTML = html;
  } else {
    // Handle the error
    console.error('Error:', xhr.statusText);
  }
};

// Define the onerror handler
xhr.onerror = function() {
  console.error('Error:', xhr.statusText);
};

// Send the request
xhr.send();
</script>