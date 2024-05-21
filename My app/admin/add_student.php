<?php
// Retrieve application details from URL parameters
$firstName = $_GET['firstName'] ?? '';
$lastName = $_GET['lastName'] ?? '';
$email = $_GET['email'] ?? '';
$mobile = $_GET['mobile'] ?? '';
$course = $_GET['course'] ?? '';
$nationality = $_GET['nationality'] ?? '';
$userType = 'student'; // Set default user type



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Student - Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .main-content {
            margin: 20px;
        }
        h1{
            text-align: center;
            margin-top: 85px;
            padding-top: 20px;
            padding-bottom: 20px;
            background-color: bisque;
            margin-left: 350px;
            margin-right: 250px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-left: 350px;
            margin-right: 250px;
        }

        label {
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        button[type="submit"] {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php include 'admin_nav_sidebar.php'; ?>
    <div class="main-content" style="margin-top: 70px;">
        <h1>Add Student</h1>
        <form action="add_student_process.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>" required>
            </div>
            <div class="form-group">
                <label for="course">Course Name</label>
                <select class="form-control" id="course" name="course" required>
                    <option value="Introduction to Computer Science" <?php if ($course === 'Introduction to Computer Science') echo 'selected'; ?>>Introduction to Computer Science</option>
                    <option value="Business Administration" <?php if ($course === 'Business Administration') echo 'selected'; ?>>Business Administration</option>
                    <option value="Mechanical Engineering" <?php if ($course === 'Mechanical Engineering') echo 'selected'; ?>>Mechanical Engineering</option>
                    <option value="Psychology" <?php if ($course === 'Psychology') echo 'selected'; ?>>Psychology</option>
                    <!-- Add more course options here -->
                </select>
            </div>
            <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo htmlspecialchars($nationality); ?>" required>
            </div>
            <div class="form-group">
                <label for="userType">User Type</label>
                <input type="text" class="form-control" id="userType" name="userType" value="<?php echo htmlspecialchars($userType); ?>" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
    </div>
    <!-- Bootstrap scripts -->
</body>

</html>

