<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("location: ../login.php");
} elseif ($_SESSION['usertype'] == 'admin') {
    header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Paying Fee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            margin-top: 100px;
            margin-left: 570px;
            margin-right: 570px;
            background-color: bisque;
            padding-top: 20px;
            padding-bottom: 20px;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: calc(100% - 12px);
            margin-bottom: 20px;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease-in-out;
        }
        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        p {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <?php include 'student_nav_sidebar.php'; ?>
    <h1>Payment Details</h1>
    <form action="process_payment.php" method="post">
        <?php
       
        $email = $_SESSION['email']; // Retrieve logged-in student's email

        // Fetch the course associated with the student
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "student";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch the course associated with the student
        $courseQuery = "SELECT course FROM students WHERE email='$email'";
        $courseResult = $conn->query($courseQuery);

        if ($courseResult->num_rows > 0) {
            $row = $courseResult->fetch_assoc();
            $course = $row['course'];

            // Fetching fee details from the fee table based on the student's course
            $feeDetailsQuery = "SELECT fee, balance FROM fee WHERE email='$email' AND course='$course'";
            $feeDetailsResult = $conn->query($feeDetailsQuery);

            if ($feeDetailsResult->num_rows > 0) {
                $feeRow = $feeDetailsResult->fetch_assoc();
                $totalFee = $feeRow['fee'];
                $balanceAmount = $feeRow['balance'];

                // Display the total fee and balance amount
                echo "<p>Total Fee: $totalFee</p>";
                echo "<p>Balance Amount: $balanceAmount</p>";
            } else {
                echo "No fee details found for this student and course.";
            }
        } else {
            echo "No course found for this student.";
        }

        $conn->close();
        ?>

        <label for="amount">Enter Amount to Pay:</label>
        <!-- Modify your input field based on the balance condition -->
        <input type="text" id="amount" name="amount" pattern="[0-9]+" title="Please enter digits only" 
        <?php if ($balanceAmount <= 0) echo 'readonly'; ?> required>

        <input type="submit" value="Pay">
    </form>
</body>
</html>
