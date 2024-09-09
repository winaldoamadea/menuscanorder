<?= esc($this->extend('template')) ?>

<?= esc($this->section('content')) ?>

<div class="container">
    <h1 class="text-center my-4">Tables Order</h1>
        <div class="row">
            <div class="col-md-4 col-12">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tablesModal">
                    Add Table
                </button>
            </div>
        </div>
    <hr style="border-top: 5px solid black;">
<div class="row">


<?php foreach ($tables as $table): ?> <!-- Loop through each table -->

<div class="col-md-3 mb-4">
    <div class="card position-relative" data-table-id="<?= esc($table['id']) ?>"> <!-- Display card for each table -->
      <h2 class="card-header">Table <?= esc($table['number']) ?></h2> <!-- Display table number as card header -->
      <button type="button" class="btn btn-danger position-absolute top-0 end-0 mt-1 me-2 delete-table" onclick="confirmDelete()">Remove</button> <!-- Button to remove the table -->
      <div class="card-body">

        <?php if ($table['order']): ?> <!-- Check if the table has an order -->
          <?php if ($table['order']['status'] === 'Not Complete'): ?> <!-- Check if the order status is 'Not Complete' -->
            <h5 class="card-title mb-2">Status: <span style="color: red;"><?= esc($table['order']['status']) ?></span></h5> <!-- Display order status in red -->
          <?php else: ?>
            <h5 class="card-title mb-2">Status: <?= esc($table['order']['status']) ?></h5> <!-- Display order status -->
          <?php endif; ?>
        <?php else: ?>
          <p class="card-text mb-1">No active order</p> <!-- Display message for no active order -->
        <?php endif; ?>
        <a href="#" class="btn btn-primary btn-sm view-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"  
        <?php if (isset($table['order']['id'])): ?> 
            data-order-items-id="<?= esc($table['order']['id']) ?>" 
        <?php endif; ?>
        data-order-items='<?= esc(json_encode($table['orderItems'])) ?>'>View</a> <!-- Set data attribute with order items -->
        <button type="button" class="btn btn-primary btn-sm" onclick="generateAndOpenQRModal(<?= esc($table['id']) ?>)">Generate QR</button> <!-- Button to generate QR code -->
      </div>
    </div>
  </div>
<?php endforeach; ?> <!-- End loop -->


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Date:</strong> <span id="receipt-date">2024-11-20</span></p>
                        <p><strong>Order Number:</strong> #2342</p>
                        <p><strong>Table:</strong> 1</p>
                        <p><strong>Customer:</strong> John Doe</p>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Order items will be dynamically inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Complete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrModalLabel">QR Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="qrCodeContainer" class="modal-body d-flex justify-content-center">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="tablesModal" tabindex="-1" aria-labelledby="tablesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tablesModalLabel">Number of tables</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="tableForm">
            <div class="mb-3">
              <label for="numberOfTables" class="form-label">Number of Tables</label>
              <input type="number" name="number" class="form-control" id="numberOfTables" min="1">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="saveTables" type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-F6Za7jjj2jaDqKtKDUpV6z+V62aCDpVVXFqfF8ZbVoPxTXEY4gUgXjPWx8uHHp3s" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

  function generateAndOpenQRModal(tableNumber) {
      // Make an AJAX request to fetch the QR code data
      $.ajax({
          url: '<?= esc(base_url('qrcode/')) ?>' + tableNumber,
          type: 'GET',
          success: function(data) {
              // Update the QR code container with the generated QR code image
              $('#qrCodeContainer').html('<img src="data:image/png;base64,' + data + '" alt="QR Code" style="max-width: 100%; max-height: 400px;">');
              // Open the QR modal
              $('#qrModal').modal('show');
          },
          error: function(xhr, status, error) {
              console.error(error);
          }
      });
  }

</script>
<script>
$(document).ready(function() {
    // Function to handle click event of the "View" button
    $('.view-btn').click(function() {
        // Get the order items object from the data-order-items attribute
        var orderItemsObj = $(this).data('order-items');
        var orderItemsId = $(this).data('order-items-id');

        // Update modal content with order items information
        var modalBody = $('#exampleModal .modal-body');
        modalBody.empty(); // Clear previous content
        modalBody.append('<h5 class="mb-3">Order Items Information:</h5>');
        
        // Create a table to display order items
        var table = $('<table class="table"></table>');
        table.append('<thead><tr><th scope="col">Product Name</th><th scope="col">Quantity</th><th scope="col">Price</th></tr></thead>');
        var tbody = $('<tbody></tbody>');

        var totalPrice = 0;

        // Add each order item to the table
        $.each(orderItemsObj, function(index, item) {
            // Check if an item with the same name already exists in the table
            var existingRow = tbody.find('tr[data-product-name="' + item.product_name + '"]');
            if (existingRow.length > 0) {
                // If the item exists, update its quantity and price
                var existingQuantity = parseInt(existingRow.find('.quantity').text());
                var existingPrice = parseFloat(existingRow.find('.price').text().replace('$', ''));
                var newQuantity = existingQuantity + parseInt(item.quantity); // Convert quantity to integer
                var newPrice = existingPrice + (item.product_price * parseInt(item.quantity)); // Convert quantity to integer
                existingRow.find('.quantity').text(newQuantity);
                existingRow.find('.price').text('$' + newPrice.toFixed(2));
            } else {
                // If the item doesn't exist, create a new row
                var row = $('<tr data-product-name="' + item.product_name + '"></tr>');
                row.append('<td>' + item.product_name + '</td>');
                row.append('<td class="quantity">' + item.quantity + '</td>');

                // Calculate the total price for the order item
                var itemTotalPrice = item.product_price * item.quantity;
                row.append('<td class="price">$' + itemTotalPrice.toFixed(2) + '</td>');

                totalPrice += itemTotalPrice;

                tbody.append(row);
            }
        });
        // Add a row for the total price
        table.append(tbody);
        modalBody.append(table);

        // Handle "Complete" button click
        $('#exampleModal .modal-footer .btn-primary').click(function() { // Get the order_items_id from the button
            var data = {
                id : orderItemsId,
                status: 'Complete'
            };


            fetch('<?= esc(base_url("order/")) ?>' + orderItemsId, { // Use order_items_id in the URL
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                location.reload();

                // Redirect or update UI as needed
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});

document.addEventListener('click', event => {
    if (event.target.classList.contains('delete-table')) {
        if (confirm('Are you sure you want to delete this table?')) {
            const tableId = event.target.closest('.card').dataset.tableId;
            console.log(tableId);
            fetch(`<?= esc(base_url('tables/')) ?>${tableId}`, {
                method: 'DELETE'
            })
            .then(response => {
                if (response.ok) {
                    // Assuming you want to remove the entire card element
                    event.target.closest('.col-md-3').remove();
                    // Or if you want to just remove the order section within the card
                    // event.target.closest('.card').querySelector('.card-body').innerHTML = '<p class="card-text mb-1">No active order</p>';
                } else {
                    throw new Error('Failed to delete the table');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle error as needed, show alert or log
            });
        }
    }
});

</script>

<script>
        document.getElementById('saveTables').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission behavior

            // Get the form element
            const form = document.getElementById('tableForm');
            // Create a FormData object from the form
            const formData = new FormData(form);
            // Convert the FormData object to a plain object
            const data = Object.fromEntries(formData.entries());
            const userId = <?= esc(json_encode($user['id'])) ?>;
            data.user_id = userId;

            console.log(JSON.stringify(data));
            // Make a POST request to the specified endpoint
            fetch('<?= esc(base_url("tables")); ?>', {
                method: 'POST', // Specify the request method
                headers: {
                    'Content-Type': 'application/json' // Specify the content type of the request body
                },
                body: JSON.stringify(data) // Convert the data object to JSON format
            })
            .then(response => {
                // Check if the response is successful
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                // Parse the JSON response
                return response.json();
            })
            .then(data => {
            // Handle the successful response
                console.log(data);
                // Redirect to the register-menu page with user_id as a parameter
            })
            .catch(error => {
                // Handle any errors that occur during the fetch operation
                console.error('Error:', error);
            });
        });
</script>

<?= esc($this->endSection()) ?>

