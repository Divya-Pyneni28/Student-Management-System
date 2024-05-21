<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Apply - Student Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            background-size: cover;
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

        .form-container {
            margin-top: 50px;
            max-width: 500px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            background-color: gainsboro;

        }

        .form-container .form-group {
            margin-bottom: 20px;
        }

        .form-container label {
            font-weight: bold;
        }

        .form-container button[type="submit"] {
            margin-top: 20px;
        }
    </style>
</head>

<body background="apply_picture.jpg">


    <div class="form-container container">
        <h2>Online Application Form</h2>
        <form action="apply_process.php" method="POST">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="mobileNumber">Mobile Number</label>
                <input type="tel" class="form-control" id="mobileNumber" name="mobileNumber" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" class="form-control" id="nationality" name="nationality" required>
            </div>
            <div class="form-group">
                <label for="courseSelect">Select Course</label>
                <select class="form-control" id="courseSelect" name="selectedCourse">
                    <option value="Introduction to Computer Science">Introduction to Computer Science</option>
                    <option value="Business Administration">Business Administration</option>
                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                    <option value="Psychology">Psychology</option>
                    <!-- Add more course options here -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
