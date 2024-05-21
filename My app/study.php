<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Study - University of Greenwich</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .navbar {
            background-color: skyblue!important;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .navbar-brand img {
            max-height: 50px; /* Adjust the max-height for better visibility */
            width: 120px;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #fff;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 28px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-body {
            padding: 20px;
        }

        .course-name {
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .modules {
            margin-bottom: 15px;
        }

        .modules h6 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .modules ul {
            list-style-type: none;
            padding-left: 0;
        }

        .modules li {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .fee {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
        <a class="navbar-brand" href="index.php">
                <img src="greenwich.png" alt="University of Greenwich Logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="study.php">Study</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="apply.php">Apply</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2>Study at University of Greenwich</h2>
                <p>Explore our available courses:</p>

                <!-- Course Information -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="course-name">Course: Introduction to Computer Science</h5>
                        <p class="duration">Duration: 3 year</p>
                        <div class="modules">
                            <h6>Modules:</h6>
                            <ul>
                                <li>Fundamentals of Computing</li>
                                <li>Programming Concepts</li>
                                <li>Data Structures</li>
                                <li>Algorithms</li>
                                <li>Computer Networks</li>
                            </ul>
                        </div>
                        <p class="fee">Fee: £18,000</p>
                        <a href="apply.php" class="btn btn-primary">Apply</a>
                    </div>
                </div>

                <!-- Additional Courses -->
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="course-name">Course: Business Administration</h5>
                        <p class="duration">Duration: 2 years</p>
                        <div class="modules">
                            <h6>Modules:</h6>
                            <ul>
                                <li>Management Principles</li>
                                <li>Marketing Strategies</li>
                                <li>Financial Accounting</li>
                                <li>Business Ethics</li>
                                <li>Human Resource Management</li>
                            </ul>
                        </div>
                        <p class="fee">Fee: £12,000</p>
                        <a href="apply.php" class="btn btn-primary">Apply</a>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="course-name">Course: Mechanical Engineering</h5>
                        <p class="duration">Duration: 2 years</p>
                        <div class="modules">
                            <h6>Modules:</h6>
                            <ul>
                                <li>Statics</li>
                                <li>Dynamics</li>
                                <li>Thermodynamics</li>
                                <li>Fluid Mechanics</li>
                                <li>Manufacturing Processes</li>
                            </ul>
                        </div>
                        <p class="fee">Fee: £15,000</p>
                        <a href="apply.php" class="btn btn-primary">Apply</a>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="course-name">Course: Psychology</h5>
                        <p class="duration">Duration: 1 year</p>
                        <div class="modules">
                            <h6>Modules:</h6>
                            <ul>
                                <li>Introduction to Psychology</li>
                                <li>Developmental Psychology</li>
                                <li>Cognitive Psychology</li>
                                <li>Abnormal Psychology</li>
                                <li>Social Psychology</li>
                            </ul>
                        </div>
                        <p class="fee">Fee: £9,000</p>
                        <a href="apply.php" class="btn btn-primary">Apply</a>
                    </div>
                </div>

                <!-- Add more course cards similarly -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
