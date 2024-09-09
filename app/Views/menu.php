<?= esc($this->extend('template')) ?>

<?= $this->section('content') ?>

<section class="py-5"> <!-- Section for registering menu -->
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Register Menu</h2> <!-- Title for the section -->
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <button class="btn btn-success me-2 mb-2 mb-md-0 btn-sm" data-bs-toggle="modal" data-bs-target="#addItemModal" type="button">Add Item</button> <!-- Button to add item -->
                    <button type="button" class="btn btn-primary btn-sm me-2 mb-2 mb-md-0" data-bs-toggle="modal" data-bs-target="#addCategoryModal" type="button">Add Category</button> <!-- Button to add category -->
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <?php if (empty($products)) : ?> <!-- Check if there are no products -->
                <p>No products</p> <!-- Display message if no products -->
            <?php else : ?>
                <table class="table table-striped"> <!-- Table to display products -->
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Categories</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?> <!-- Loop through each product -->
                            <tr>
                                <td><?= esc($product['id']) ?></td> <!-- Display product ID -->
                                <td class="image-column">
                                    <img src="data:image/<?= esc($product['imageType']) ?>;base64,<?= esc($product['imageData']) ?>" alt="Product Image"> <!-- Display product image -->
                                </td>
                                <td><?= esc($product['name']) ?></td> <!-- Display product name -->
                                <td><?= esc($product['category_name']) ?></td> <!-- Display product category -->
                                <td><?= esc($product['price']) ?></td> <!-- Display product price -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#viewItemModal" data-product-id="<?= esc($product['id']) ?>" data-product-name="<?= esc($product['name']) ?>" data-product-categories="<?= esc($product['category_name']) ?>" data-product-price="<?= esc($product['price']) ?>" data-product-description="<?= esc($product['description']) ?>">View</button> <!-- Button to view product details -->
                                        <button class="btn btn-sm btn-info me-2" data-bs-toggle="modal" data-bs-target="#editItemModal" data-product-id="<?= esc($product['id']) ?>" data-product-name="<?= esc($product['name']) ?>" data-product-categories="<?= esc($product['category_name']) ?>" data-product-price="<?= esc($product['price']) ?>" data-product-description="<?= esc($product['description']) ?>">Edit</button> <!-- Button to edit product -->
                                        <button class="btn btn-sm btn-danger delete-menu" onclick="confirmDelete()">Delete</button> <!-- Button to delete product -->
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $pager->links('default','custom_view');?>
            <?php endif; ?>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-F6Za7jjj2jaDqKtKDUpV6z+V62aCDpVVXFqfF8ZbVoPxTXEY4gUgXjPWx8uHHp3s" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addItemModalLabel">Add Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="itemForm">
            <div class="mb-3">
              <label for="itemName" class="form-label">Item Name</label>
              <input type="text" class="form-control" id="itemName">
            </div>
            <div class="mb-3">
                <label for="itemCategories" class="form-label">Item Categories</label>
                <select class="form-control" id="itemCategories">
                  <option value="">Select a category</option>
                  <option value="category1">Category 1</option>
                  <option value="category2">Category 2</option>
                  <option value="category3">Category 3</option>
                </select>
            </div>
            <div class="mb-3">
              <label for="itemPrice" class="form-label">Item Price</label>
              <input type="text" class="form-control" id="itemPrice">
            </div>
            <div class="mb-3">
                <label for="itemImage" class="form-label">Item Image</label>
                <div id="itemImageDropzone" class="dropzone"></div>
            </div>
            <input type="hidden" id="itemImageName" name="imageName">
            <div class="mb-3">
              <label for="itemDescription" class="form-label">Item Description</label>
              <textarea class="form-control" id="itemDescription" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" id="saveItem">Add Item</button>
          </form>
        </div>
      </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" id="addCategoryBtn" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="categoryForm">
            <div class="mb-3">
              <label for="categoryName" class="form-label">Category Name</label>
              <input type="text" class="form-control" id="categoryName" name="name">
            </div>
            <button type="submit" class="btn btn-primary" id="saveCategory">Add Category</button>
          </form>
        </div>
      </div>
    </div>
</div>


<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">View/Edit Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editItemForm">
                    <input type="hidden" id="newItemId"> <!-- Hidden input to store the item ID -->
                    <div class="mb-3">
                        <label for="newItemName" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="newItemName">
                    </div>
                    <div class="mb-3">
                        <label for="itemCategories2" class="form-label">Item Categories</label>
                        <select class="form-control" id="itemCategories2">
                        <option value="">Select a category</option>
                        <option value="category1">Category 1</option>
                        <option value="category2">Category 2</option>
                        <option value="category3">Category 3</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="newItemPrice" class="form-label">Item Price</label>
                        <input type="text" class="form-control" id="newItemPrice">
                    </div>
                    <div class="mb-3">
                        <label for="newItemDescription" class="form-label">Item Description</label>
                        <textarea class="form-control" id="newItemDescription" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="itemImage" class="form-label">Item Image</label>
                        <div id="editItemImageDropzone" class="dropzone"></div>
                    </div>
                    <input type="hidden" id="editItemImageName" name="imageName">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEditItemChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>


<!-- View Item Modal -->
<div class="modal fade" id="viewItemModal" tabindex="-1" aria-labelledby="viewItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewItemModalLabel">View Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="viewItemId" class="form-label">Item ID</label>
                        <p id="viewItemId" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label for="viewItemName" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="viewItemName" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="viewItemCategories" class="form-label">Item Categories</label>
                        <input type="text" class="form-control" id="viewItemCategories" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="viewItemPrice" class="form-label">Item Price</label>
                        <input type="text" class="form-control" id="viewItemPrice" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="viewItemDescription" class="form-label">Item Description</label>
                        <textarea class="form-control" id="viewItemDescription" rows="3" disabled></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    document.addEventListener('click', event => {
        if (event.target.classList.contains('delete-menu')) {
            if (confirm('Are you sure you want to delete this product?')) {
                const productId = event.target.closest('tr').querySelector('td:first-child').textContent;
                fetch(`<?= base_url('items/') ?>${productId}`, {
                    method: 'DELETE'
                })
                .then(response => {
                    if (response.ok) {
                        // Assuming you want to remove the entire row from the table
                        event.target.closest('tr').remove();
                        console.log('Product deleted successfully');
                    } else {
                        throw new Error('Failed to delete the product');
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

<!-- Modal Setup -->
<script>
    document.getElementById('saveCategory').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission behavior
    
    const form = document.getElementById('categoryForm');
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    const menuId = <?= json_encode($menu['id']) ?>;
    data.menu_id = menuId;

    fetch('<?= base_url("category"); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        console.log(JSON.stringify(data));
        if (!response.ok) {
          console.log(response);
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Handle successful response
        console.log(data);
        location.reload();
    })
    .catch(error => {
        // Handle error
        console.error('Error:', error);
    });
});
</script>
<script>
    // Function to fetch categories from the server
    function fetchCategories() {
        const menuId = <?= json_encode($menu['id']) ?>;
        const baseUrl = '<?= base_url("category/") ?>'; // Adjust the base URL as per your server setup
        const url = `${baseUrl}${menuId}`; // Appending menuId directly to the URL path
        
        return fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Function to populate categories dropdown
    function populateCategoriesDropdown(categories, dropdownId) {
        const select = document.getElementById(dropdownId);
        select.innerHTML = ''; // Clear previous options
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'Select a category';
        select.appendChild(defaultOption);
        categories.forEach(category => {
            const option = document.createElement('option');
            option.value = category.id; // Assuming category object has an 'id' property
            option.textContent = category.name; // Assuming category object has a 'name' property
            select.appendChild(option);
        });
    }

    // Event listener for modal show event
    $('#addItemModal').on('show.bs.modal', function () {
        // Fetch categories and populate dropdown when modal is shown
        fetchCategories().then(categories => {
            populateCategoriesDropdown(categories, 'itemCategories');
        });
    });


    // Event listener for form submission
    document.getElementById('saveItem').addEventListener('click', function(event) {
    
    // Get form data
    const itemName = document.getElementById('itemName').value;
    const itemCategories = document.getElementById('itemCategories').value;
    const itemPrice = document.getElementById('itemPrice').value;
    const itemDescription = document.getElementById('itemDescription').value;
    const itemImageName = document.getElementById('itemImageName').value;
    const menuId = <?= json_encode($menu['id']) ?>;
    const userId = <?= json_encode($user['id']) ?>;

    
    // Construct the data object
    const data = {
        itemName: itemName,
        itemCategories: itemCategories,
        itemPrice: itemPrice,
        itemDescription: itemDescription,
        itemImageName: itemImageName,
        menu_id: menuId,
        user_id: userId
    };

    // Submit form data to server
    fetch('<?= base_url("items"); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        console.log(JSON.stringify(data));
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        
        return response.json();
    })
    .then(data => {console.log(data);
        location.reload();
    })
    
    .catch(error=> console.error('Error:', error));
});

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
<!-- Correct Dropzone Configuration -->
<script>
    // Initialize Dropzone
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        $("#itemImageDropzone").dropzone({
            url: "<?= base_url('upload/') ?>" + <?= $user['id'] ?>, // Ensure this URL is correct
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 1, // Maximum number of files allowed
            acceptedFiles: "image/*", // Allowed file types
            addRemoveLinks: true, // Add remove button for each file
            init: function() {
                this.on("addedfile", function(file) {
                    // Do something when a file is added
                });
                this.on("removedfile", function(file) {
                    // Do something when a file is removed
                });
                this.on("success", function(file, response) {
                    // Do something when a file is successfully uploaded
                    // Set the value of the hidden input field with the filename or path
                    document.getElementById('itemImageName').value = file.name;
                });
                this.on("error", function(file, errorMessage) {
                    // Do something when an error occurs during file upload
                    console.error(errorMessage);
                });
            }
        });
    });
</script>

<script>

    function populateCategoriesDropdownEdit(categories, dropdownId, selectedCategory) {
        const select = document.getElementById(dropdownId);
        select.innerHTML = ''; // Clear previous options
        
        // Add default option
        const defaultOption = document.createElement('option');
        defaultOption.textContent = 'Select a category';
        select.appendChild(defaultOption);
        
        // Populate categories
        categories.forEach(category => {
            const option = document.createElement('option');
            option.value = category.id; // Set value to the category ID
            option.textContent = category.name; // Display category name
            select.appendChild(option);

            // Check if this option matches the selected category
            if (category.name === selectedCategory) {
                option.selected = true; // Select this option
            }
        });
    }
    // Event listener for edit modal show event
    $('#editItemModal').on('show.bs.modal', function (event) {
        // Get the button that triggered the modal
        var button = $(event.relatedTarget);
        
        // Extract product information from data-* attributes
        var productId = button.data('product-id');
        var productName = button.data('product-name');
        var productCategories = button.data('product-categories');
        var productPrice = button.data('product-price');
        var productDescription = button.data('product-description');
        var productImage = button.data('product-image');

        // Update modal input fields with product information
        var modal = $(this);
        modal.find('#newItemId').val(productId);
        modal.find('#newItemName').val(productName);
        modal.find('#newItemPrice').val(productPrice);
        modal.find('#newItemDescription').val(productDescription);
        
        // Populate categories dropdown
        fetchCategories().then(categories => {
            populateCategoriesDropdownEdit(categories, 'itemCategories2', productCategories);
        });
    });

// Event listener for form submission in the edit modal
document.getElementById('saveEditItemChanges').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission behavior
    
    const itemId = document.getElementById('newItemId').value;
    const itemName = document.getElementById('newItemName').value;
    const itemCategories = document.getElementById('itemCategories2').value;
    const itemPrice = document.getElementById('newItemPrice').value;
    const itemDescription = document.getElementById('newItemDescription').value;
    const itemImageName = document.getElementById('editItemImageName').value;
    
    // Construct the data object
    const data = {
        itemId: itemId,
        itemName: itemName,
        itemCategories: itemCategories,
        itemPrice: itemPrice,
        itemDescription: itemDescription,
        itemImageName: itemImageName
    };

    console.log(data);

    // Submit form data to server for updating the item
    fetch('<?= base_url("items/") ?>' + itemId, {
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
        console.log(data); // Log the response for debugging
        // Close the modal after successfully saving changes
        location.reload();
        $('#editItemModal').modal('hide');
    })
    .catch(error=> console.error('Error:', error));
});
</script>
<script>
$('#viewItemModal').on('show.bs.modal', function (event) {
    // Get the button that triggered the modal
    var button = $(event.relatedTarget);
    
    // Extract product information from data-* attributes
    var productId = button.data('product-id');
    var productName = button.data('product-name');
    var productCategories = button.data('product-categories');
    var productPrice = button.data('product-price');
    var productDescription = button.data('product-description');

    console.log(productCategories);

    // Update modal input fields with product information
    var modal = $(this);
    modal.find('#viewItemId').text(productId);
    modal.find('#viewItemName').val(productName);
    modal.find('#viewItemCategories').val(productCategories); // Set text content directly
    modal.find('#viewItemPrice').val(productPrice);
    modal.find('#viewItemDescription').val(productDescription).prop('disabled', true);
});

// Event listener for view modal hidden event
$('#viewItemModal').on('hidden.bs.modal', function (event) {
    // Clear modal content when it's hidden
    var modal = $(this);
    modal.find('#viewItemId').text('');
    modal.find('#viewItemName').val('');
    modal.find('#viewItemCategories').text('').prop('disabled', true);
    modal.find('#viewItemPrice').val('');
    modal.find('#viewItemDescription').val('').prop('disabled', true);
});
</script>


<?= $this->endSection() ?>