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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar_top">
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
                        <a href="#section-guide" id="navbar-links2">Guide</a>
                    </li>
                    <li class="nav-item">
                        <a href="#section-about" id="navbar-links2">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- nav bar -->

    <div class="intro-container">
        <div class="d-flex justify-content-center">
            <div class="quote-container">
                <p id="quote-title">
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
                <section id="section-guide">
                    <div class="d-flex justify-content-center">
                        <div class="guide-content">
                            <h1><b>GUIDE</b></h1>
                            <h4 id="guide-desc">Learn how to use <b>Best Before</b> to keep track of the expiration date
                                of
                                your food</h4>
                            <hr id="guide-separator">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="guide-instruction">
                            <div class="row">
                                <div class="col">
                                    <div class="card" style="width: 22rem;">
                                        <video class="card-img-top" width="420" height="340" autoplay muted loop
                                            playsinline>
                                            <source src="video/vid1.mp4" type="video/mp4">
                                        </video>
                                        <div class="card-body">
                                            <h5 class="card-text">To use <b>Best Before</b>, scroll on top and press the
                                                button below our motto</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card" style="width: 22rem;">
                                        <video class="card-img-top" width="380" height="340" autoplay muted loop
                                            playsinline>
                                            <source src="video/vid2.mp4" type="video/mp4">
                                        </video>
                                        <div class="card-body">
                                            <h5 class="card-text">Go ahead and create an account if you do not have one.
                                                Once created, you will be directed to the log in page.</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <div class="card" style="width: 22rem;">
                                        <video class="card-img-top" width="420" height="340" autoplay muted loop
                                            playsinline>
                                            <source src="video/vid3.mp4" type="video/mp4">
                                        </video>
                                        <div class="card-body">
                                            <h5 class="card-text">This is what your dashboard will look like. The short
                                                tutorial will guide you to use the the webapp.</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card" style="width: 22rem;">
                                        <video class="card-img-top" width="420" height="340" autoplay muted loop
                                            playsinline>
                                            <source src="video/vid4.mp4" type="video/mp4">
                                        </video>
                                        <div class="card-body">
                                            <h5 class="card-text">To use <b>Best Before</b>, scroll on top and press the
                                                button below our motto</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="sec-about" id="section-about">
                    <div class="d-flex justify-content-center">
                        <div class="guide-content">
                            <h1><b>ABOUT</b></h1>
                            <hr id="guide-separator">
                            <h4 id="guide-desc"><b>Best Before</b> is a webapp that allows you to track the expiration
                                date
                                of your food.</h4>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffff" fill-opacity="1"
                d="M0,96L60,128C120,160,240,224,360,224C480,224,600,160,720,154.7C840,149,960,203,1080,192C1200,181,1320,107,1380,69.3L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
            </path>
        </svg>
    </div>
    <div class="credits-container">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <img id="main-icon" src="img/letter-b.png" alt="" />
                    </div>
                </div>
                <p id="copyrights-credits">A product of the University of The East.</p>
                <p>© 2022 Best Before. All rights reserved.</p>
            </div>
            <div class="col">
                <p>Developers:</p>
                <p>Dylann Esteban | Shaira Pagaduan | Jude Abuan | Andre Lacra</p>
            </div>
        </div>
    </div>


    <script>
    document.addEventListener("DOMContentLoaded", function() {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.getElementById('navbar_top').classList.add('fixed-top');
                // add padding top to show content behind navbar
                navbar_height = document.querySelector('.navbar').offsetHeight;
                document.body.style.paddingTop = navbar_height + 'px';
            } else {
                document.getElementById('navbar_top').classList.remove('fixed-top');
                // remove padding top from body
                document.body.style.paddingTop = '0';
            }
        });
    });
    // DOMContentLoaded  end
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>

</html>