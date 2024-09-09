<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuScanOrder</title>
    <!-- This is the main stylesheet for Bootstrap. It includes all the CSS necessary for Bootstrap's components and utilities to work. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Include Bootstrap Icons -->
    <!-- This link imports the Bootstrap Icons library, which provides a wide range of SVG icons for use in your projects. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        .navbar-dark .navbar-brand {
            color: white; /* Change navbar brand text color to white */
        }

        .navbar-dark .navbar-nav .nav-link {
            color: white; /* Change navbar links text color to white */
        }

        .bg-black {
            background-color: black !important; /* Change navbar background color to black */
        }
        /* Set the main section to take up 100% of the viewport height */
        main {
            min-height: 100vh;
        }
        /* Set the login section to take up 50% of the viewport width */
        .login-section {
            min-height: 100%;
            display: flex;
            align-items: center;
        }
    
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        .poppins-bold {
            font-family: "Poppins", sans-serif;
            font-weight: 700;
            font-style: normal;
        }

        .poppins-regular {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        @media (max-width: 768px) {
            .login-section {
                order: 1; 
            }
            .card {
                height: auto; 
            }
        }
        
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-black">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="<?= base_url('images/MscBlack.png'); ?>" alt="MenuScanOrder Icon" height="30" class="me-2"> <!-- Adjust the path, alt text, and height as needed -->
                MenuScanOrder
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("logout"); ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>


<main>
    <section class="gradient-custom" style="background-image: linear-gradient(to right, yellow, orange); position: relative; overflow: hidden;">
        <div class="container-fluid py-5">
            <div class="row align-items-center">
                <div class="col-md-6 p-0 order-md-2" style="height:60%">
                    <div class="card bg-dark text-white" style="border-radius: 1rem; height: 100vh;">
                        <div class="card-body p-5">
                            <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                            <p class="text-white-50 mb-5">Please enter your menu name</p>
                            <form id="menuForm"> <!-- Changed the form ID to match the JavaScript -->
                                <div class="mb-4">
                                    <label class="form-label text-white">Menu Name</label>
                                    <input class="form-control form-control-lg" name="title"> <!-- Added name attribute for the business name input -->
                                    <input type="hidden" class="form-control form-control-lg" name="business_id"> <!-- Added name attribute for the tables input -->
                                </div>
                                <button class="btn btn-outline-light btn-lg btn-custom" type="button">Back</button> <!-- Changed type to button to prevent form submission -->
                                <button id="saveMenu" class="btn btn-outline-light btn-lg btn-custom ms-3" type="submit">Submit</button> <!-- Changed the button ID and added type submit -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="row mb-5 align-items-center order-md-1">
                        <div class="col-md-4 mb-4">
                            <div class="d-flex flex-column align-items-center">
                                <img src="<?= base_url('images/easytouse.png'); ?>" alt="Easy to Use Icon" width="150" height="150"> 
                                <div class="text-center mt-3">
                                    <p class="m-0 fs-5 poppins-bold">Easy to Use</p>
                                    <small class="fs-6 poppins-regular"><b>MenuScanOrder</b> is easy to use for both business owner and customer</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="d-flex flex-column align-items-center">
                                <img src="<?= base_url('images/attendance-management.png'); ?>" alt="Easy to Manage Icon" width="150" height="150"> 
                                <div class="text-center mt-3">
                                    <p class="m-0 fs-5 poppins-bold">Easy to Manage</p>
                                    <small class="fs-6 poppins-regular">It is easy to manage your business menu with <b>MenuScanOrder</b></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="d-flex flex-column align-items-center">
                                <img src="<?= base_url('images/1507683.png'); ?>" alt="QR Icon" width="150" height="150"> 
                                <div class="text-center mt-3">
                                    <p class="m-0 fs-5 poppins-bold">Can Generate QR</p>
                                    <small class="fs-6 poppins-regular">You can generate each table with different QR with <b>MenuScanOrder</b></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</main>


<footer class="bg-dark text-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>&copy; 2024 MenuScanOrder. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="text-light me-3">Privacy Policy</a>
                <a href="#" class="text-light">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
        document.getElementById('saveMenu').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission behavior
            // Get the form element
            const form = document.getElementById('menuForm');
            // Create a FormData object from the form
            const formData = new FormData(form);
            // Convert the FormData object to a plain object
            const data = Object.fromEntries(formData.entries());
            const businessId = <?= json_encode($business['business_id']) ?>;
            data.business_id = businessId;

            // Make a POST request to the specified endpoint
            fetch('<?= base_url("menu"); ?>', {
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
                // Redirect or perform any other action as needed
                window.location.href = '<?= base_url("register-menu"); ?>/' + <?= $user['id']; ?>;
                
            })
            .catch(error => {
                // Handle any errors that occur during the fetch operation
                console.error('Error:', error);
            });
        });
</script>
</body>
<?= $this->include('footer') ?>
</html>
