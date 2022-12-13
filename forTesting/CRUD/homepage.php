<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Best Before</title>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- icon -->
    <link rel="icon" href="img/letter-b.png">
    <!-- css -->
    <link rel="stylesheet" href="style.css" />
    <!-- boostrap connect -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
</head>

<body>
    <!-- nav bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="homepage.php"><img src="img/letter-b.png" alt="" id="main-icon" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="homepage.php" id="navbar-links2">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" id="navbar-links2">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- nav bar -->

    <div class="intro-container">
        <div class="d-flex justify-content-center">
            <div class="quote-container">
                <p id="quote-title" style="text-shadow:5px 5px 5px black;">
                    <b> "A HEALTHY OUTSIDE STARTS FROM THE INSIDE"</b>
                </p>
                <div class="d-flex justify-content-center">
                    <a href="login.php">
                        <button class="btn btn-success" id="main-button">
                            Start Tracking Your Food
                        </button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="guide-container">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,224L48,202.7C96,181,192,139,288,133.3C384,128,480,160,576,192C672,224,768,256,864,245.3C960,235,1056,181,1152,176C1248,171,1344,213,1392,234.7L1440,256L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
        <div class="d-flex justify-content-center">
            <div class="guide-content-container">
                <div class="d-flex justify-content-center">
                    <div class="guide-content">
                        <h1 id="about"><b>About</b></h1>
                        <hr>
                        <h4 id="guide-desc">List all your food and <b>keep track</b> of the expiration date of
                            your food</h4>
                        <hr id="guide-separator">

                        <div class="row">
                            <div class="col">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>

</html>