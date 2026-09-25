<?php
    session_start();
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "eswebsitedb";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/loginandsignupStyle.css">
    <link rel = "stylesheet" href="css/loginandsignupStyle.css">
    <link rel = "stylesheet" href="css/loginandsignupMobile.css " media = "only screen and (max-width: 768px)">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bungee&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>Log In</title>
</head>
<body>  
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM USERS WHERE username='$username'";
        $result = $conn->query($sql);
        if($result->num_rows > 0) { 
            $row = $result->fetch_assoc();
            if ($row['password'] === $password) {
                $_SESSION['UserID'] = $username;
                $_SESSION['is_admin'] = $row['is_admin'];
                header('Location: index.php');
                $conn->close();
                exit();
            }else{
                echo "<main><h2>Password is incorrect</h2>";
                echo "<p><a href = 'login.php'>Try logging in again</a></p></main>";
                $conn->close();
            }
        }else {
            echo "<main><h2>Username doesn't exist</h2>";
            echo "<p><a href='signup.php'>Try signing up</a> or try <a href = 'login.php'>logging in again.</a></p></main>";
            $conn->close();
        }
    }
?>