<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome to University of Greenwich</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here */

        body {
            padding-top: 56px;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .navbar {
            background-color: skyblue;
        }

        .navbar-brand img {
            max-height: 50px; /* Adjust the max-height for better visibility */
            width: 120px;
        }
        
        .navbar-nav .nav-link {
            font-weight: bold; /* Make the navigation links bold */
            color: #ffffff;
        }

        .jumbotron {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            margin-bottom: 40px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            text-align: center;
        }
        .contact-info {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .contact-info .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -100px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .contact-info .tooltip-text::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #333 transparent transparent transparent;
        }

        .contact-info:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="greenwich.png" alt="University of Greenwich Logo">
                
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="study.php">Study</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="apply.php">Apply</a>
                    </li>
                    <!-- Contact information dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle contact-info" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Contact Us
                            <span class="sr-only">(current)</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <span class="dropdown-item-text tooltip-text">Phone: +44 1234567890<br>Email: uniofgreenwich@gre.ac.uk</span>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to University of Greenwich</h1>
            <p class="lead">Shaping future leaders through quality education.</p>
        </div>

        <div class="row">
            <div class="col-md-8">
                <h2>About University of Greenwich</h2>
                <p>Established in 1998, University of Greenwich is committed to providing an exceptional educational experience. We offer a diverse range of programs designed to prepare students for success in their careers and beyond.</p>
                <p>Our university has achieved several milestones, including:</p>
                <ul>
                    <li>Groundbreaking research contributions in various fields</li>
                    <li>Consistent top rankings in national and international assessments</li>
                    <li>Significant community engagement and societal impact</li>
                </ul>
            </div>
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Apply for Courses</h5>
                        <p class="card-text">Explore our available courses and apply online.</p>
                        <a href="apply.php" class="btn btn-primary">Apply Now</a>
                    </div>
                </div>
                <div class="card bg-light mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Contact Us</h5>
                        <!-- Tooltip content -->
                        <div class="contact-tooltip">
                            <span class="tooltip-text">Phone: +44 1234567890<br>Email: uniofgreenwich@gre.ac.uk</span>
                            <span class="btn btn-primary">Contact</span>
                        </div>
                    </div>
                </div>
                <div class="card bg-light mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Login</h5>
                        <p class="card-text">Already a member? Log in to your account.</p>
                        <a href="login.php" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
