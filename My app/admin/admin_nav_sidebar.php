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
        <a class="navbar-brand" href="admin_dashboard.php">
                <img src="greenwich.png" alt="University of Greenwich Logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
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
            <a href="admin_dashboard.php" class="list-group-item list-group-item-action">Dashboard</a>
            <a href="view_applications.php" class="list-group-item list-group-item-action">View Applications</a>
            <a href="add_student.php" class="list-group-item list-group-item-action">Add Student</a>
            <a href="view_courses.php" class="list-group-item list-group-item-action">View Courses</a>
            <a href="add_course.php" class="list-group-item list-group-item-action">Add Course</a>
            <a href="fee_status.php" class="list-group-item list-group-item-action">Fee Status</a>
            <a href="view_students.php" class="list-group-item list-group-item-action">View Students</a>
            <a href="add_faculty.php" class="list-group-item list-group-item-action">Add Faculty</a>
            <a href="view_faculty.php" class="list-group-item list-group-item-action">View Faculty</a>
            <!-- Other sidebar links -->
        </div>
    </div>