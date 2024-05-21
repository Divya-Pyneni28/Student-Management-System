<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - University of Greenwich</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here */

        body {
            padding-top: 56px;
            font-family: Arial, sans-serif;
            background-size: cover;
            background-position: absolute;
            color: #333;
        }

        .login-container {
            width: 29%;
            margin: 50px auto;
            
        }

        .login-form {
            position: relative;
            padding: 30px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .login-form img {
            position: absolute;
            top: 10px;
            left: 10px;
            max-width: 120px;
        }

        .form-group {
            margin-bottom: 20px;
            margin-top: 50px; /* Adjust top margin for better alignment */
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-group input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
        }

        .login-text {
            text-align: center;
        }
        .lg {
            position: relative;
            text-align: center;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body background="apply_picture.jpg">
    <div class="login-container">
        <div class="login-form">
            <img src="greenwich.png" alt="University of Greenwich Logo">
             <h4 class="lg">Sign in</h4>
             <?php
             if(isset($_GET['Message'])){
                echo $_GET['Message'];
             }
             ?>
            <form action="login_process.php" method="POST">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
