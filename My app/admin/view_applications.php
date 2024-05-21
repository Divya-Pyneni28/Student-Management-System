<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Applications - Admin Panel</title>
    <!-- Include necessary stylesheets, scripts, or meta tags -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;  background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .main-content {
            margin-left: 250px; /* Adjust this margin based on your sidebar width */
            padding: 20px;
        }

        .application {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            position: relative;
            margin-right: 50px;
        }

        .application p {
            margin: 5px 0;
        }
      

       
        .action-buttons {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .action-buttons button {
            margin-left: 5px; /* Adjust the space between buttons */
        }
        h1{
            padding-top: 5px;
            padding-bottom: 20px;
        }

    </style>
</head>

<body>
  <?php include 'admin_nav_sidebar.php'; ?>

    <div class="main-content" style="margin-top: 70px;">
        <h1>View Applications</h1>
        <?php
        // Perform database connection here
        error_reporting(0);
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "student";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            $error = "Connection failed: " . $conn->connect_error;
        } else {
            // Query to select all applications
            $sql = "SELECT * FROM applications ORDER BY id DESC";
            $result = $conn->query($sql);

            // Check if there are results
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    // Display application details, customize this according to your table structure
                    echo "<div class='application'>";
                    echo "<p>Application ID: " . $row["id"] . "</p>";
                    echo "<p>First Name: " . $row["first_name"] . "</p>";
                    echo "<p>Last Name: " . $row["last_name"] . "</p>";
                    echo "<p>Email: " . $row["email"] . "</p>";
                    echo "<p>Mobile: " . $row["mobile_number"] . "</p>";
                    // Add more fields as needed
                    echo "<p>Nationality: " . $row["nationality"] . "</p>";
                    echo "<p>Selected Course: " . $row["selected_course"] . "</p>";
                    echo "<form action='process_application.php' method='POST' class='action-buttons'>";
                    echo "<input type='hidden' name='application_id' value='" . $row["id"] . "'>";
                    if ($row["status"] === "accepted") {
                        echo "<span class='accepted-icon'><i class='fa fa-check-circle'></i> Accepted</span>";
                    } elseif ($row["status"] === "rejected") {
                        echo "<span class='rejected-icon'><i class='fa fa-times-circle'></i> Rejected</span>";
                    } else {
                        echo "<button type='submit' name='accept' value='" . $row["id"] . "' class='btn btn-success'>Accept</button>";
                        echo "<button type='submit' name='reject' value='" . $row["id"] . "' class='btn btn-danger'>Reject</button>";
                    }
                    echo "</form>";
                    echo "</div><hr>"; // Separator between applications
                }
                
            } else {
                echo "<p>No applications found</p>";
            }
            $conn->close();
        }
        ?>
    </div>
</body>

</html>
