<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Course - Admin Panel</title>
    <!-- Include necessary stylesheets, scripts, or meta tags -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
         
        .main-content {
            margin-left: 400px; /* Adjust margin to match sidebar width */
            padding: 20px;
            margin-top: 20px; /* Height of the navigation bar */
            margin-right: 400px;
            
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            
            background-color: bisque;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    
<?php include 'admin_nav_sidebar.php'; ?>

    <!-- Main Content Area -->
    <div class="main-content" style="margin-top: 70px;">
        <h1>Add Course</h1>
        <form action="process_add_course.php" method="POST" class="form">
            <div class="form-group">
                <label for="courseName">Course Name</label>
                <input type="text" class="form-control" id="courseName" name="courseName" required>
            </div>
            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" class="form-control" id="department" name="department" required>
            </div>
            <div class="form-group">
                <label for="duration">Duration</label>
                <input type="text" class="form-control" id="duration" name="duration" required>
            </div>
            <div class="form-group">
                <label for="fee">Fee</label>
                <input type="text" class="form-control" id="fee" name="fee" required>
            </div>
            <div class="form-group">
                <label for="module1">Module 1</label>
                <input type="text" class="form-control" id="module1" name="module1" required>
            </div>
            <div class="form-group">
                <label for="module2">Module 2</label>
                <input type="text" class="form-control" id="module2" name="module2" required>
            </div>
            <div class="form-group">
                <label for="module3">Module 3</label>
                <input type="text" class="form-control" id="module3" name="module3" required>
            </div>
            <div class="form-group">
                <label for="module4">Module 4</label>
                <input type="text" class="form-control" id="module4" name="module4" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Course</button>
        </form>
    </div>
    <?php if (isset($_GET['success'])) : ?>
        <script>
            alert("New course added successfully");
            window.location.href = "add_course.php"; // Redirect to the same page
        </script>
    <?php endif; ?>
    <!-- Bootstrap and other scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
