<style>
  .navbar {
            background-color: skyblue!important;
        }
        /* Sidebar styling */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
             /* Adjust top padding to accommodate navigation bar */
            margin-top: 77px;
        }

        .sidebar .list-group-item {
            border: none;
            background-color: #f8f9fa;
            color: #333;
        }

        .sidebar .list-group-item:hover {
            background-color: #e9ecef;
            color: #333;
        }
        .navbar-brand img {
            max-height: 50px; /* Adjust the max-height for better visibility */
            width: 120px;
        }  
</style>


<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
        <a class="navbar-brand" href="student_dashboard.php">
                <img src="greenwich.png" alt="University of Greenwich Logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="my_modules.php">My Modules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="list-group">
            <a href="student_dashboard.php" class="list-group-item list-group-item-action">Dashboard</a>
            <a href="my_modules.php" class="list-group-item list-group-item-action">My Modules</a>
            <a href="profile.php" class="list-group-item list-group-item-action">Update Profile</a>
            <a href="paying_fee.php" class="list-group-item list-group-item-action">Payment</a>
            <a href="view_results.php" class="list-group-item list-group-item-action">View Results</a>
            
        </div>
    </div>