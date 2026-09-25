<?php
    date_default_timezone_set('Europe/London');
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
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href = "css/viewBlogStyle.css">
    <link rel="stylesheet" href="css/viewBlogMobile.css" media="only screen and (max-width: 768px)">
    <title>Add Comment</title>
</head>
<body>
<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitcomment'])) {
        $_POST['comment_text'] = trim($_POST['comment_text']);
        if(strlen($_POST['comment_text']) < 5 || strlen($_POST['comment_text']) > 500) {
            echo "<div class = 'main'><h2>Comment cannot be less than 5 characters or more than 500 characters</h2>";
            echo "<a href='viewBlog.php'>Back to Blog</a>";
            echo "<a href='index.php'>back home</a></div>";
            $conn->close();
            exit();
        }
    }else{
        echo "<div class = 'main'><h2>Invalid request</h2>";
        echo "<a href='viewBlog.php'>Back to Blog</a>";
        echo "<a href='index.php'>back home</a></div>";
        $conn->close();
        exit();
    }
    $sql = "SELECT * FROM BLOGCOMMENTS WHERE id = " . $_POST['id'] . " AND comment_text = '" . $_POST['comment_text'] . "'";
    $result = $conn->query($sql);
    if($result->num_rows < 1) {
        $comment_text = $_POST['comment_text'];
        $id = $_POST['id'];
        $comment_datetime = date('Y-m-d H:i:s');
        $sql = "INSERT INTO BLOGCOMMENTS (id, comment_text, comment_datetime) VALUES ('$id', '$comment_text', '$comment_datetime')";
        if ($conn->query($sql) === TRUE) {
            header('Location: viewBlog.php');
            $conn->close();
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            echo "<div class = 'main'><p><a href='index.php'>back home</a></p></div>";
        }
    } else {
        echo "<div class = 'main'><h2>Comment already exist</h2>";
        echo "<a href='viewBlog.php'>Back to Blog</a>";
        echo "<a href='index.php'>back home</a></div>";
        $conn->close();
    }
?>
</body>
</html>