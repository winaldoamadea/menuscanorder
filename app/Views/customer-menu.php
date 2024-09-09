<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuScanOrder</title>
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
    /* Sets the number of columns for the card layout */
    .card-columns {
        column-count: 1;
    }

    /* Styles for cards */
    .card {
        border-radius: 20px; /* Rounded corners */
        overflow: hidden; /* Prevents content from overflowing */
    }

    /* Container for quantity input */
    .qtyContainer {
        display: flex; /* Displays flex items */
        align-items: center; /* Aligns items vertically */
    }

    /* Quantity input field */
    .input-qty {
        width: 60px; /* Width of the input field */
        text-align: center; /* Aligns text in the center */
        padding: 6px; /* Adds padding */
        border: 1px solid #ced4da; /* Border style */
        border-radius: 5px; /* Rounded corners */
    }

    /* Styles for plus and minus buttons */
    .button-minus,
    .button-plus {
        padding: 4px 8px; /* Adds padding */
        font-size: 0.75rem; /* Font size */
        height: auto; /* Adjusts height automatically */
    }

    /* Media query for smaller screens */
    @media (max-width: 576px) {
        .button-minus,
        .button-plus {
            padding: 2px 4px; /* Adjusted padding for smaller screens */
            font-size: 0.5rem; /* Adjusted font size for smaller screens */
        }
    }

    /* Icon shape */
    icon-shape {
        display: inline-flex; /* Displays as inline flex */
        align-items: center; /* Aligns items vertically */
        justify-content: center; /* Centers content horizontally */
        text-align: center; /* Aligns text in the center */
        vertical-align: middle; /* Aligns vertically */
    }   

    /* Small icon */
    .icon-sm {
        width: 2rem; /* Width of the icon */
        height: 2rem; /* Height of the icon */
    }

    /* Styles for input group */
    .input-group {
        display: flex; /* Displays flex items */
        align-items: center; /* Aligns items vertically */
        justify-content: center; /* Centers content horizontally */
    }

    /* Styles for quantity field */
    .quantity-field {
        text-align: center; /* Aligns text in the center */
    }

    /* Additional styles for quantity input */
    .input-qty {
        text-align: center; /* Aligns text in the center */
        padding: 6px 10px; /* Adds padding */
        border: 1px solid #d4d4d4; /* Border style */
        max-width: 80px; /* Maximum width */
    }

    /* Fixes table layout */
    table {
        table-layout: fixed; /* Forces table layout to be fixed */
    }

    /* Imports Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');

    /* Styles for the Anton font */
    .anton-regular {
        font-family: "Anton", sans-serif; /* Font family */
        font-weight: 400; /* Font weight */
        font-style: normal; /* Normal font style */
    }

    /* Button styles */
    .qtyButton {
        padding: 5px 10px; /* Adds padding */
        font-size: 15px; /* Font size */
        border: 1px solid #000000; /* Border style */
        background-color: white; /* Background color */
        border-radius: 100px; /* Rounded corners */
        margin: 0 15px; /* Margin */
    }

    /* Hover effect for buttons */
    .qtyButton:hover {
        background-color: #808080; /* Background color on hover */
        color: white; /* Text color on hover */
    }

    /* Styles for Poppins font */
    .poppins-regular {
        font-family: "Poppins", sans-serif; /* Font family */
        font-weight: 400; /* Font weight */
        font-style: normal; /* Normal font style */
    }

    /* Additional styles for Poppins font */
    .poppins-semibold {
        font-family: "Poppins", sans-serif; /* Font family */
        font-weight: 600; /* Font weight */
        font-style: normal; /* Normal font style */
    }

    /* Category styles */
    .category {
        cursor: pointer; /* Sets cursor style to pointer */
        color: #000; /* Text color */
        font-size: 1.2rem; /* Font size */
    }

    /* Hover and active effects for category */
    .category:hover,
    .category:active {
        text-decoration: underline; /* Underlines text on hover or when active */
        text-decoration-color: #ffffff; /* Text decoration color */
    }

    /* Styles for card image */
    .card-img-top {
        width: 100%; /* Sets image width to 100% */
        height: 200px; /* Adjusts image height */
        object-fit: cover; /* Ensures the image covers the entire space */
    }
</style>

</head>
<body style="background-color: #dcdcdc;">
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <!-- Navbar content -->
                <a class="navbar-brand d-flex align-items-center"></a>
            </div>
        </nav>
    </header>
    <main class="container-fluid mt-4">
        <!-- Category Links -->
        <div class="d-flex flex-wrap justify-content-center mb-4">
            <!-- Display category names -->
            <?php foreach ($categories as $category): ?>
                <span class="anton-regular category mx-2 mb-2"><?= $category['name'] ?></span>
            <?php endforeach; ?>
        </div>

        <!-- Horizontal Line -->
        <hr>

        <!-- Cart Button -->
        <div class="position-fixed" style="right: 20px; bottom: 20px; z-index: 1000;">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cartModal">
                <i class="bi bi-cart"></i>
            </button>
        </div>

        <!-- Product Cards -->
        <div class="card-columns">

            <?php foreach ($categories as $category): ?>
                <!-- Category Title -->
                <h2 class="my-3 poppins-semibold"><?= $category['name'] ?></h2>
                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 gx-3 gy-3">
                    <?php foreach ($products as $product): ?>
                        <?php if ($product['category_id'] == $category['id']): ?>
                            <!-- Product Card -->
                            <div class="col-lg-2 col-md-6 col-sm-4">
                                <div class="card">
                                    <!-- Product Image -->
                                    <img src="data:image/<?= esc($product['imageType']) ?>;base64,<?= esc($product['imageData']) ?>" alt="Product Image" style="width: 100%; height: 200px; object-fit: cover; border-radius: 20px 20px 0 0;">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <!-- Product Details -->
                                        <h5 class="card-title"><?= esc ($product['name']) ?></h5>
                                        <p class="card-text"><?=esc ($product['description']) ?></p>
                                        <p class="card-text item-price"><strong>$<?= esc($product['price']) ?></strong></p>
                                        <!-- Quantity Input -->
                                        <div class="input-group w-auto justify-content-center align-items-center">
                                            <div class="qtyContainer">
                                                <button class="qtyButton" onclick="addToCartModal('<?= esc($product['name']) ?>', <?= esc($product['price']) ?>, 'subtract', <?= esc($product['id']) ?>)">-</button>
                                                <span class="quantity" id="quantity">0</span>
                                                <button class="qtyButton" onclick="addToCartModal('<?= esc($product['name']) ?>', <?= esc($product['price']) ?>, 'add', <?= esc($product['id']) ?>)">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Your Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Table Number and Customer Name Input -->
                    <p>Table: <span><?= $table['number'] ?></span></p>
                    <!-- Cart Items Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Quantity</th>
                                <th style="width:25%" scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody id="cartItems">
                            <!-- Cart items will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <!-- Close and Add to Cart Buttons -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="addToCartButton" class="btn btn-primary">Add to Cart</button>
                </div>
                <div class="modal-footer">
                    <!-- Cart Total -->
                    <p class="cart-total" id="cartTotal">Total: $0.00</p>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-F6Za7jjj2jaDqKtKDUpV6z+V62aCDpVVXFqfF8ZbVoPxTXEY4gUgXjPWx8uHHp3s" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
var modalCart = [];
function addToCartModal(productName, price, action,id) {
    // console.log("Adding to modal cart:", productName);
    var cartItems = document.getElementById('cartItems');
    var existingItem = modalCart.find(item => item.productName === productName);
    
    if (existingItem) {
        // If the product already exists in the modal cart, update its quantity
        if (action === 'add') {
            // If the action is to add, increase the quantity
            existingItem.quantity++;
        } else if (action === 'subtract') {
            // If the action is to subtract, decrease the quantity
            existingItem.quantity--;
            
            // If the quantity becomes 0, remove the item from the modal cart
            if (existingItem.quantity === 0) {
                modalCart = modalCart.filter(item => item.productName !== productName);
            }
        }
        
        // Update the input field value as well
        var quantityElement = document.querySelector(`#modalCartItems .modal-quantity[data-product="${productName}"]`);
        if (quantityElement) {
            quantityElement.textContent = existingItem.quantity;
        }
    } else if (action === 'add') {
        // If the product does not exist in the modal cart and the action is to add, add a new row
        var row = document.createElement('tr');
        row.innerHTML = `
        <td>${productName}</td>
        <td class="quantity">1</td>
        <td>$${price.toFixed(2)}</td>
        `;
        cartItems.appendChild(row);
        // Add the new item to the modal cart array
        modalCart.push({ id: id, productName: productName, price: price, quantity: 1 });
        updateModalCart();
    }
}


function decreaseQuantity(element) {
    var quantityElement = element.parentElement.querySelector('.quantity');
    var quantity = parseInt(quantityElement.textContent);
    if (quantity > 0) {
        quantityElement.textContent = quantity - 1;
        
        // Update the modal cart and total
        updateModalCart();
    }
}


function increaseQuantity(element) {
    var quantityElement = element.parentElement.querySelector('.quantity');
    var quantity = parseInt(quantityElement.textContent);
    quantityElement.textContent = quantity + 1;

    // Update the input field value
    var inputQty = element.parentElement.querySelector('.input-qty');
    if (inputQty) {
        inputQty.value = quantity + 1;
    }

    updateModalCart();
}


// Update Modal Cart Function
function updateModalCart() {
    var modalCartTotal = 0;
    var cartItems = document.getElementById('cartItems');
    cartItems.innerHTML = ''; // Clear existing rows
    
    modalCart.forEach(function(item) {
        var productName = item.productName;
        var quantity = item.quantity;
        var price = item.price;
        
        // Create a new row for the product
        var row = document.createElement('tr');
        row.innerHTML = `
            <td>${productName}</td>
            <td class="quantity">${quantity}</td>
            <td>$${(price * quantity).toFixed(2)}</td>
        `;
        cartItems.appendChild(row);

        // Calculate subtotal for this item and add to total
        var subtotal = price * quantity;
        modalCartTotal += subtotal;
    });

    // Update the total in the modal
    var modalTotalElement = document.getElementById('cartTotal');
    if (modalTotalElement) {
        modalTotalElement.textContent = 'Total: $' + modalCartTotal.toFixed(2);
    }
}



// Event listeners for plus and minus buttons
var minusButtons = document.querySelectorAll('.qtyButton:nth-child(1)');
minusButtons.forEach(function (button) {
    button.addEventListener('click', function () {
        decreaseQuantity(this);
    });
});

var plusButtons = document.querySelectorAll('.qtyButton:nth-child(3)');
plusButtons.forEach(function (button) {
    button.addEventListener('click', function () {
        increaseQuantity(this);
    });
});

document.getElementById('addToCartButton').addEventListener('click', function(event) {
    const tableNumber = <?= json_encode($table['id']) ?>;

    // Prepare the data to be sent to the server
    const data = {
        tableNumber: tableNumber,
        items: modalCart
    };

    // Make a POST request to the OrderItem controller
    fetch('<?= base_url("orderitem"); ?>', {
        method: 'POST',
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
        // Handle the successful response
        console.log(data);
        location.reload();
        // Redirect or handle response as needed
    })
    .catch(error => {
        // Handle any errors that occur during the fetch operation
        console.error('Error:', error);
    });
});

</script>

</html>



