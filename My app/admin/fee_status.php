<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fee Status - Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your styles here */
     
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
         
        }

        .main-content {
            margin-left: 300px;
            margin-top: 100px;
            margin-right: 200px;
        }

        h1 {
            padding-bottom: 10px;
            border-bottom: 2px solid #ccc;
            text-align: center;
            padding-top: 20px;
            background-color: bisque;
            margin-top: 75px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .no-results {
            margin-top: 20px;
            color: #888;
        }
    </style>
</head>

<body>
    <?php include 'admin_nav_sidebar.php'; ?>

    <div class="main-content" style="margin-top: 70px;">
        <h1>Fee Status of Students</h1>

        <!-- PHP code to fetch fee status -->
        <?php
        // Perform database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "student";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql1 = "SELECT * FROM students";
        $result = $conn->query($sql1);

        $sql2="SELECT *FROM fee";
        $f_result = $conn->query($sql2);

        if ($result && $result->num_rows > 0) {
            if($f_result && $f_result->num_rows >0){
            echo '<table>';
            echo '<tr><th>Admission ID</th><th>First Name</th><th>Last Name</th><th>Fee Status</th></tr>';
            while ($row = $result->fetch_assoc()) {
                $f_row=$f_result->fetch_assoc();
                echo '<tr>';
                echo '<td>' . $row['admission_id'] . '</td>';
                echo '<td>' . $row['first_name'] . '</td>';
                echo '<td>' . $row['last_name'] . '</td>';
                
                // Simulate fee status based on a condition
                $feeStatus = ($f_row['status'] == 'Paid') ? 'Paid' : 'Not Paid';
                
                echo '<td>' . $feeStatus . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } 
    }else {
            echo '<p class="no-results">No students found.</p>';
        }

        $conn->close();
        ?>
    </div>
    <!-- Bootstrap scripts -->
</body>

</html>
