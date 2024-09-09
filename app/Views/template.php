<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($business['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-F6Za7jjj2jaDqKtKDUpV6z+V62aCDpVVXFqfF8ZbVoPxTXEY4gUgXjPWx8uHHp3s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .image-column {
            width: 20%; 
        }
        .image-column img {
            max-width: 100px; 
            height: auto;
        }
        .total-row:last-child td {
        border-bottom: 2px solid black !important;
        }

        .total-row td {
        border-top: 2px solid black !important;
        }
        .btn-check:checked + .btn,
        .btn-check:checked + .btn:hover {
        background-color: #6c757d;
        color: white;
        }

        .btn-check:not(:checked) + .btn,
        .btn-check:not(:checked) + .btn:hover {
        color: #6c757d;
        }
    </style>
    <script>
        function confirmDelete() {
            var r = confirm("Are you sure you want to delete this item?");
            if (r == true) {
            }
        }
    </script>
</head>
<body>
    <!-- Navbar for the page-->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-black">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="<?= base_url('images/MscBlack.png'); ?>" alt="MenuScanOrder Icon" height="30" class="me-2"> 
                    <?= esc($business['name']) ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                    <!-- Add another navigation if it is admin -->
                    <?php if (session()->get('isAdmin')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'admin' ? 'active' : ''; ?>" href="<?= base_url("admin"); ?>">Admin Panel</a>
                        </li>
                    <?php endif; ?>
                    <!-- Navbar for the user -->
                      <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url('')?>" >Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/register-menu/' . $user['id']); ?>">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/tables/' . $user['id']); ?>">Table</a>
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
        <?= $this->renderSection('content') ?>
    </main>

<body>

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

</html>