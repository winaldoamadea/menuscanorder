<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuScanOrder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
    /* Styles for the navbar brand in dark mode */
    .navbar-dark .navbar-brand {
        /* Add your styles here */
    }

    /* Styles for the navbar links in dark mode */
    .navbar-dark .navbar-nav .nav-link {
        /* Add your styles here */
    }

    /* Background color override */
    .bg-black {
        background-color: black !important; /* Overrides background color */
    }

    /* Imports Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    /* Styles for Poppins font with semibold weight */
    .poppins-semibold {
        font-family: "Poppins", sans-serif; /* Font family */
        font-weight: 600; /* Font weight */
        font-style: normal; /* Normal font style */
    }

    /* Styles for "Get Started" button */
    .btn-get-started {
        font-family: "Poppins", sans-serif;
            text-transform: uppercase;
            font-weight: 500;
            font-size: 16px;
            letter-spacing: 1px;
            display: inline-block;
            padding: 8px 28px;
            border-radius: 50px;
            transition: 0.5s;
            margin: 10px;
            border: 2px solid #000;
            color: #fff;
            background-color: black;
            text-decoration: none;
            outline: none !important;
    }

    /* Hover effect for "Get Started" button */
    .btn-get-started:hover {
        /* Button hover styles */
    }

    /* Styles for Poppins font with regular weight */
    .poppins-regular {
        font-family: "Poppins", sans-serif; /* Font family */
        font-weight: 400; /* Font weight */
        font-style: normal; /* Normal font style */
    }

    /* Styles for Nanum Gothic Coding font with regular weight */
    .nanum-gothic-coding-regular {
        font-size: 1.5rem; /* Font size */
    }

    /* Media query for smaller screens */
    @media (max-width: 768px) {
        /* Styles for smaller screens */
    }

    /* Media query for even smaller screens */
    @media (max-width: 576px) {
        /* Styles for even smaller screens */
    }

    /* Typing animation styles */
    .typing-animation {
        /* Styles for typing animation */
    }

    /* Keyframes for typing animation */
    @keyframes typing {
        /* Typing animation keyframes */
    }

    /* Keyframes for blinking caret in typing animation */
    @keyframes blink-caret {
        /* Blinking caret keyframes */
    }

    /* Styles for text container */
    .text-container {
        max-width: 100%; /* Maximum width */
        display: inline-block; /* Displays as inline block */
    }

    /* Styles for center image */
    .center-image {
        width: 300px; /* Width of the image */
    }

    /* Media query for smaller screens */
    @media (max-width: 576px) {
        /* Adjustments for smaller screens */
    }
</style>

</head>
<body>

<!-- Homepage header -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-black">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="<?= base_url('images/MscBlack.png'); ?>"alt="MenuScanOrder Icon" height="30" class="me-2"> 
                MenuScanOrder
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar  -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= service('router')->getMatchedRoute()[0] == '/' ? 'active' : ''; ?>" href="<?= base_url(); ?>">Home</a>
                    </li>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <?php if (session()->get('isAdmin')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'admin' ? 'active' : ''; ?>" href="<?= base_url("admin"); ?>">Admin Panel</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/register-menu/' . session()->get('id')); ?>">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/tables/' . session()->get('id')); ?>">Table</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url("logout"); ?>">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'login' ? 'active' : ''; ?>" href="<?= base_url("login"); ?>">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>


<main> 
    <!-- Main Section -->
    <section class="py-8 text-center" style="background-image: linear-gradient(to right, yellow, orange); height: 100vh; position: relative; overflow: hidden;"> 
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-6 mx-auto text-container">
                    <h1 class="display-5 mt-5 poppins-semibold">Start Building Your Own Menu</h1>
                    <div>
                    <p class="lead nanum-gothic-coding-regular typing-animation" style="margin-top: 20px; margin-bottom: 20px;">
                        Digitalize Your <b>Menu</b> Effortlessly Instant
                    </p>
                    <div>
                        <a href="<?= base_url("login"); ?>" class="btn-get-started">Get Started</a>
                    </div>
                    <p> Already a member?</p>
                    <a href="<?= base_url("login"); ?>" class="nav-link <?= service('router')->getMatchedRoute()[0] == 'login' ? 'active' : ''; ?>">Sign In</a>
                </div>
            </div>
        </div>
        <img src="<?= base_url('images/menuscan (1).png'); ?>" alt="Center Image" class="center-image" style="position: absolute; bottom: 10%; left: 50%; transform: translateX(-50%);">
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?= $this->include('footer') ?>
</body>
</html>
