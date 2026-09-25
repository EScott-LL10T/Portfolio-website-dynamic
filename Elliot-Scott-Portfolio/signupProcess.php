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
    <title>Sign Up</title>
</head>
<body>  
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM USERS WHERE Username='$email'";
        $result = $conn->query($sql);
        if($result->num_rows > 0) { 
            echo "<main><h2>Username already exists</h2>";
            echo "<a href='login.php'>Try logging in</a></main>";
            $conn->close();
            exit();
        } else {
            $sql = "INSERT INTO USERS (username, password) VALUES ('$email', '$password')";
        
            if ($conn->query($sql) === TRUE) {
                $_SESSION['UserID'] = $username;
                $_SESSION['is_admin'] = $row['is_admin'];
                header('Location: index.php');
                $conn->close();
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                echo "<p><a href='index.php'>back home</a></p>";
            }
            $conn->close();
        }
    }
?>


