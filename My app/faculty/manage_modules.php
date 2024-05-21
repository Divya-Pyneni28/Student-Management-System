<?php
session_start();

// Check for session and user type
if (!isset($_SESSION['email']) || $_SESSION['usertype'] == 'admin') {
    header("location:../login.php");
    exit;
}

// Your database connection and any other necessary logic here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM faculty_modules WHERE faculty_email='$email'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Modules - Faculty Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>
<?php include 'faculty_nav_sidebar.php'; ?>

    <div class="main-content">
        <h1>Manage Modules</h1>
        <h2>Assigned Modules</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Module Name</th>
                    <!-- Add more columns if needed -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $serial = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $serial . "</td>";
                        echo "<td>" . $row['selected_module'] . "</td>";
                        // Add more columns' data
                        echo "</tr>";
                        $serial++;
                    }
                } else {
                    echo "<tr><td colspan='2'>No modules found</td></tr>";
                }
                ?>
            </tbody>
        </table>
<div class="upload-form">
    <h3>Upload File for Module</h3>
    <form action="upload_material.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="file">Select File:</label>
            <input type="file" class="form-control-file" name="materialFile" id="materialFile">
        </div>
        <div class="form-group">
            <label for="module">Select Module:</label>
            <select class="form-control" id="module" name="module">
                <?php
                // Reset the pointer of $result to start from the beginning
                mysqli_data_seek($result, 0);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['selected_module'] . "'>" . $row['selected_module'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No modules found</option>";
                }
                ?>
            </select>
        </div>
        
        <input type="submit" value="Upload" name="submit">
    </form>
</div>
<!-- File management section -->
<div class="file-management">
    <h2>Uploaded Files for Module</h2>
    <hr>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="module-select">
            <label for="module">Select Module:</label>
            <select class="form-control" id="module" name="module" onchange="this.form.submit()">
                <option value="">Select Module</option>
                <?php
                // Reset the pointer of $result to start from the beginning
                mysqli_data_seek($result, 0);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $selected = ($_POST['module'] === $row['selected_module']) ? 'selected' : '';
                        echo "<option value='" . $row['selected_module'] . "' $selected>" . $row['selected_module'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No modules found</option>";
                }
                ?>
            </select>
        </div>
    </form>
    
    <?php
    if (!empty($_POST['module'])) {
        $selectedModule = $_POST['module'];
        $sqlFiles = "SELECT * FROM materials WHERE module_name = '$selectedModule'";
        $resultFiles = $conn->query($sqlFiles);
        
        if ($resultFiles->num_rows > 0) {
            echo "<ul>";
            while ($row = $resultFiles->fetch_assoc()) {
                echo '<li>';
                echo $row['file_name'];
                echo '<button onclick="deleteFile(' . $row['id'] . ')">Delete</button>';
                echo '</li>';
            }
            echo "</ul>";
        } else {
            echo "<p>No files uploaded for this module.</p>";
        }
    } else {
        echo "<p>Please select a module to display uploaded files.</p>";
    }
    ?>
</div>


    </div>

    <!-- Bootstrap and other scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<!-- Add this script in your manage_modules.php -->
<script>
    function deleteFile(fileId) {
        var confirmation = confirm("Are you sure you want to delete this file?");
        if (confirmation) {
            fetch('delete_file.php?file_id=' + fileId, {
                method: 'DELETE'
            })
            .then(response => {
                // Handle response as needed
                console.log('File deleted successfully.');
                // Optionally, refresh the page or update the file list
            })
            .catch(error => {
                // Handle errors
                console.error('Error deleting file:', error);
            });
        }
    }
</script>
