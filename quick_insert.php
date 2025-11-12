<!-- quick_insert.php -->
 <head><link rel="stylesheet" href="quick_insert.css"></head>
<section id="quickInsert">
    

  <h2>Quick Insert</h2>
  
  <label for="facultySelect">Select Faculty:</label>
  <select id="facultySelect">
    <option value="">--Choose Faculty--</option>
    <option value="science">Faculty of Applied Science</option>
    <option value="business">Faculty of Business Management</option>
    <option value="technology">Faculty of Technology Studies</option>
  </select>
  
  <br><br>
  
  <label for="itemName">Item Name:</label>
  <input type="text" id="itemName" placeholder="Enter item name" />
  
  <br><br>
  
  <label for="itemCount">Item Count:</label>
  <input type="number" id="itemCount" placeholder="Enter item count" min="1" />
  
  <br><br>
  
  <button onclick="insertItem()">Insert Item</button>
</section>

<script>
function insertItem() {
  const faculty = document.getElementById('facultySelect').value;
  const itemName = document.getElementById('itemName').value.trim();
  const itemCount = parseInt(document.getElementById('itemCount').value, 10);

  if (!faculty) {
    alert('Please select a faculty.');
    return;
  }
  if (!itemName) {
    alert('Please enter an item name.');
    return;
  }
  if (isNaN(itemCount) || itemCount < 1) {
    alert('Please enter a valid item count (1 or more).');
    return;
  }

  fetch('insert_item.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ faculty, itemName, itemCount })
  })
  .then(res => res.json())
  .then(data => {
    if(data.success) {
      alert('Item inserted successfully!');
      document.getElementById('itemName').value = '';
      document.getElementById('itemCount').value = '';
      document.getElementById('facultySelect').value = '';
    } else {
      alert('Insert failed: ' + data.message);
    }
  })
  .catch(err => {
    alert('Error: ' + err.message);
  });
}
</script>
