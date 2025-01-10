document.getElementById('donate').addEventListener('change', function () {
  const selectedValue = this.value;
  const dynamicContent = document.getElementById('dynamic-content');
  dynamicContent.style.display = 'block';

  if (selectedValue === 'money') {
    dynamicContent.innerHTML = `
      <h3>Account Details for Janmamithra Trust:</h3>
      <table>
        <tr><th>Name</th><td>Janmamithra</td></tr>
        <tr><th>Bank</th><td>Axis Bank</td></tr>
        <tr><th>Branch</th><td>No.28 Jnanabharathi Main Road, Nagarbhavi Circle, Bangalore-560072</td></tr>
        <tr><th>Account Type</th><td>Current Account</td></tr>
        <tr><th>Account Number</th><td>919020031459809</td></tr>
        <tr><th>IFSC Code</th><td>UTIB0001447</td></tr>
        <tr><th>Google Pay</th><td>9611047143</td></tr>
      </table>
      <img src="scanner.jpeg" alt="Scanner QR Code">
      <label for="utr">UTR Number:</label>
      <input type="text" id="utr" name="utr" placeholder="Enter UTR number">
    `;
  } else if (selectedValue === 'clothes') {
    dynamicContent.innerHTML = `
      <h3>Clothes Donation Instructions:</h3>
      <ul>
        <li>Ensure clothes are washed and neatly packed.</li>
        <li>Label the packages with size and gender (e.g., "Men - Large").</li>
        <li>Drop off at the nearest Janmamithra collection center.</li>
      </ul>
    `;
  } else if (selectedValue === 'food') {
    dynamicContent.innerHTML = `
      <h3>Food Donation Instructions:</h3>
      <ul>
        <li>Ensure the food is fresh and hygienically packed.</li>
        <li>Avoid donating food items with a short shelf life.</li>
        <li>Contact our team for perishable food collection arrangements.</li>
      </ul>
    `;
  } else if (selectedValue === 'other') {
    dynamicContent.innerHTML = `
      <h3>Other Items Donation Instructions:</h3>
      <ul>
        <li>Contact us with details of the items you wish to donate.</li>
        <li>Ensure items are in usable condition.</li>
        <li>Pack the items securely before drop-off.</li>
      </ul>
      <label for="otherDetails">Describe the items:</label>
      <textarea id="otherDetails" name="details" placeholder="Describe your items"></textarea>
    `;
  }
});
