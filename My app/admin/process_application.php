<?php
// Process the application status change
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accept']) || isset($_POST['reject'])) {
    $applicationId = $_POST['application_id'];
    $status = isset($_POST['accept']) ? 'accepted' : 'rejected';

    // Perform database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the application status in the database
    $sql1 = "UPDATE applications SET status='$status' WHERE id='$applicationId'";

    if ($status === 'accepted'&& $conn->query($sql1) === TRUE ) {
        // Retrieve application details based on the accepted ID
        $sql = "SELECT * FROM applications WHERE id='$applicationId'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // Fetch application details
            $row = $result->fetch_assoc();

            // Redirect to add_student.php with application details
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $email = $row['email'];
            $mobile = $row['mobile_number'];
            $nationality = $row['nationality'];
            $selectedCourse = $row['selected_course'];

            // Redirect with application details as URL parameters
            header("Location: add_student.php?firstName=$firstName&lastName=$lastName&email=$email&mobile=$mobile&nationality=$nationality&course=$selectedCourse");
            exit();
        } else {
            // Redirect to an error page if no application found
            header("Location: error.php");
            exit();
        }
    } else {
        // Redirect back to view_applications.php after updating the status for rejection
        header("Location: view_applications.php");
        exit();
    }

    $conn->close();
} else {
    // Redirect to an error page or handle the situation when no action is performed
    header("Location: error.php");
    exit();
}
?>
