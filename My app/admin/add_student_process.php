<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['mobile'] ?? '';
    $course = $_POST['course'] ?? '';
    $nationality = $_POST['nationality'] ?? '';
    $userType = $_POST['userType'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validations and sanitation should go here

    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "student";

    $conn = new mysqli($servername, $username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $username = strtolower(str_replace(' ', '', $firstName));

    // Inserting student details into students table
    $studentSQL = "INSERT INTO students (first_name, last_name, email, phone, course, nationality, user_type, password) 
        VALUES ('$firstName', '$lastName', '$email', '$phone', '$course', '$nationality', '$userType','$password')";

    if ($conn->query($studentSQL) === TRUE) {
        $feeSQL = "SELECT * FROM courses WHERE course_name = '$course'";
        $feeResult = $conn->query($feeSQL);

        if ($feeResult && $feeResult->num_rows > 0) {
            $row = $feeResult->fetch_assoc();
            $feeValue = intval($row['int_fee']);

            // Get admission ID of the inserted student
            $admissionIdQuery = "SELECT admission_id FROM students WHERE email = '$email' ORDER BY admission_id DESC LIMIT 1";
            $admissionIdResult = $conn->query($admissionIdQuery);

            if ($admissionIdResult && $admissionIdResult->num_rows > 0) {
                $admissionIdRow = $admissionIdResult->fetch_assoc();
                $admissionId = $admissionIdRow['admission_id'];

                $feeInsertSQL = "INSERT INTO fee (admission_id, email, course, fee, balance, status) 
                                VALUES ('$admissionId', '$email', '$course', $feeValue, $feeValue, 'Not Paid')";

                if ($conn->query($feeInsertSQL) === TRUE) {
                    $userSQL = "INSERT INTO users (username, email, password, usertype) 
                                VALUES ('$username', '$email', '$password', '$userType')";

                    if ($conn->query($userSQL) === TRUE) {
                        echo '<script>alert("Added a student into the Database");</script>';
                        echo '<script>window.location.href = "add_student.php";</script>'; // Redirect to home page
                        exit();
                    } else {
                        echo "Error: " . $userSQL . "<br>" . $conn->error;
                    }
                } else {
                    echo "Error: " . $feeInsertSQL . "<br>" . $conn->error;
                }
            } else {
                echo "Failed to retrieve admission ID.";
            }
        } else {
            echo "No fee found for the course.";
        }
    } else {
        echo "Error: " . $studentSQL . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    header("Location: error.php");
    exit();
}
?>
