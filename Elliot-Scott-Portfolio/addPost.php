<?php
    date_default_timezone_set('Europe/London');
    session_start();
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "eswebsitedb";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        $_SESSION['blog_preview'] = [
            'title' => $title,
            'content' => $content
        ];

        if ($title === '' || $content === '' || strlen($content) < 20) {
            header('Location: addEntry.php');
            $conn->close();
            exit();
        }

        $post_datetime = date('Y-m-d H:i:s');
        $sql = "SELECT * FROM BLOGDATA WHERE title='$title' OR content = '$content'";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            $_SESSION['blog_error'] = 'Blog post already exists.';
            header('Location: addEntry.php');
            $conn->close();
            exit();
        }

        $sql = "INSERT INTO BLOGDATA (title, content, post_datetime) VALUES ('$title', '$content', '$post_datetime')";

        if ($conn->query($sql) === TRUE) {
            unset($_SESSION['blog_preview']);
            unset($_SESSION['blog_error']);
            header('Location: viewBlog.php');
            $conn->close();
            exit();
        }

        echo "Error: " . $sql . "<br>" . $conn->error;
        echo "<main><p><a href='index.php'>back home</a></p></main>";
        $conn->close();
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href = "css/addEntryStyle.css">
    <link rel="stylesheet" href="css/addEntryMobile.css" media="only screen and (max-width: 768px)">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bungee&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>Add Post</title>
</head>
<body>
</body>
</html>