<?php
    session_start();
    if (isset($_SESSION['UserID'])) {
        header("Location: addEntry.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log in</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel = "stylesheet" href="css/loginandsignupStyle.css">
    <link rel="stylesheet" href="css/loginandsignupMobile.css" media="only screen and (max-width: 768px)">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bungee&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class = "flexContainer_outer">
        <div>
            <header>
                <p>log in for Elliot Scott's blog</p>
            </header>
        </div>
        <div>
            <main>
                <h1>Log in to your account</h1>
                <p>Don't have an account? <a href="sign up.html">Sign up</a></p>
            </main>
        </div>
        <div>
            <form action = "loginProcess.php" method = "post" id = "myForm">
                <div class = "flexContainer">
                    <div>
                        <label for="username"></label>
                        <input type="text" id="username" name="username" required placeholder="Username">
                    </div>
                    <div>
                        <label for="password"></label>
                        <input type="password" id="password" name="password" required minlength="6" placeholder = "password">
                    </div>
                    <div id = "ResetAndSubmit">
                        <button type="submit">Log In</button>
                        <button type="reset">Clear</button>
                    </div>
                </div>
            </form>
        </div>
        <div>
            <footer>
                <p>&copy; 2026 Elliot Scott. All rights reserved.</p>
                <br>
                <a href = "index.php">Return to Home Page</a>
            </footer>
        </div>
    </div>
    <script src = "js/loginandsignup.js"></script>
</body>
</html>