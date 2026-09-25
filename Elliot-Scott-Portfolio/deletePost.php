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

    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['delete_post']) || !isAdmin()) {
        http_response_code(403);
        echo "Unauthorized request.";
        $conn->close();
        exit();
    }

    $postId = (int)$_POST['post_id'];

    $conn->begin_transaction();
    try {
        $conn->query("DELETE FROM BLOGCOMMENTS WHERE id = $postId");
        $conn->query("DELETE FROM BLOGDATA WHERE ID = $postId");
        $conn->commit();
        header('Location: viewBlog.php');
        $conn->close();
        exit();
    } catch (Throwable $exception) {
        $conn->rollback();
        echo "Error deleting post.";
        $conn->close();
    }
?>