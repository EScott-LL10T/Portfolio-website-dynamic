<?php
    date_default_timezone_set('Europe/London');
    session_start();
    require_once 'admin.php';

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "eswebsitedb";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['delete_comment']) || !isAdmin()) {
        http_response_code(403);
        echo "Unauthorized request.";
        $conn->close();
        exit();
    }

    $postId = (int)$_POST['comment_post_id'];
    $commentText = $conn->real_escape_string($_POST['comment_text']);
    $commentDatetime = $conn->real_escape_string($_POST['comment_datetime']);

    $sql = "DELETE FROM BLOGCOMMENTS WHERE id = $postId AND comment_text = '$commentText' AND comment_datetime = '$commentDatetime' LIMIT 1";
    if ($conn->query($sql) === TRUE) {
        header('Location: viewBlog.php');
        $conn->close();
        exit();
    }

    echo "Error deleting comment.";
    $conn->close();
?>