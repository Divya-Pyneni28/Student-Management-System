<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amountPaid = $_POST['amount'] ?? '';

    // Validations for amount paid
    if (!is_numeric($amountPaid) || $amountPaid <= 0) {
        echo "Invalid amount entered. Please enter a valid amount greater than 0.";
        exit();
    }

    $email = $_SESSION['email']; // Retrieve logged-in student's email
     // Retrieve the course associated with the student

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch fee details from the fee table based on the student's course
    $feeQuery = "SELECT fee, balance FROM fee WHERE email='$email' ";
    $feeResult = $conn->query($feeQuery);

    if ($feeResult->num_rows > 0) {
        $row = $feeResult->fetch_assoc();
        $totalFee = $row['fee'];
        $balanceAmount = $row['balance'];

        // Check if the payment amount exceeds the balance amount
        if ($amountPaid > $balanceAmount) {
            echo "Payment amount exceeds the balance amount. Please enter a valid amount.";
            exit();
        }

        // Update balance amount after payment
        $newBalance = $balanceAmount - $amountPaid;

        $status = ($newBalance <= 0) ? 'Paid' : 'Not Paid';

        // Update balance and status in the database
        $updateQuery = "UPDATE fee SET balance=$newBalance, status='$status' WHERE email='$email'";

        

        if ($conn->query($updateQuery) === TRUE) {
            // Payment successful message
            echo "<script>alert('Payment successful! New balance: $newBalance');</script>";
            header("Location: paying_fee.php");
        } else {
            echo "Error updating balance: " . $conn->error;
        }
    } else {
        echo "No fee details found for this student and course.";
    }

    $conn->close();
} else {
    header("Location: error.php");
    exit();
}
?>
