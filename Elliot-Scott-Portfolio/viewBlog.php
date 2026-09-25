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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['content'])) {
        $_SESSION['blog_preview'] = [
            'title' => trim($_POST['title']),
            'content' => trim($_POST['content'])
        ];
    }

    $previewPost = $_SESSION['blog_preview'] ?? null;

    $sql = "SELECT * FROM BLOGDATA";

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['month'])) {
        $month = $_GET['month'];
        if($_GET['month'] !== '' && $_GET['month'] !== '0'){
            $sql = "SELECT * FROM BLOGDATA WHERE MONTH(post_datetime) = '$month'";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog posts</title>
    <link rel = "stylesheet" href = "css/reset.css">
    <link rel="stylesheet" href="css/viewBlogStyle.css">
    <link rel="stylesheet" href="css/viewBlogMobile.css" media="only screen and (max-width: 768px)">
    <script src="js/viewBlogAdmin.js" defer></script>
</head>
<body>
    <div class = "flexContainer">
        <div class = "header">
            <?php echo date("Y-m-d H:i") . " London/Europe";?>
        </div>
        <div class = "filterContainer">
            <form action="viewBlog.php" method="get">
                <select class="dropdown" name="month">
                    <option value = "">filter by month</option>
                    <option value = "0">All</option> 
                    <option value="1">01</option>
                    <option value="2">02</option>
                    <option value="3">03</option>
                    <option value="4">04</option>
                    <option value="5">05</option>
                    <option value="6">06</option>
                    <option value="7">07</option>
                    <option value="8">08</option>
                    <option value="9">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <input type="submit" value="Filter" id = "filterBtn">
            </form>

        </div>
        <div class = "main">
            <?php if ($previewPost) { ?>
                <section class="preview-section">
                    <h2>Preview</h2>
                    <article>
                        <h2><?php echo htmlspecialchars($previewPost['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p><?php echo nl2br(htmlspecialchars($previewPost['content'], ENT_QUOTES, 'UTF-8')); ?></p>
                    </article>
                    <div class="preview-actions">
                        <form action="addPost.php" method="post" class="preview-submit-form">
                            <input type="hidden" name="title" value="<?php echo htmlspecialchars($previewPost['title'], ENT_QUOTES, 'UTF-8'); ?>">
                            <input type="hidden" name="content" value="<?php echo htmlspecialchars($previewPost['content'], ENT_QUOTES, 'UTF-8'); ?>">
                            <button type="submit" id = "previewSubmit">Submit Post</button>
                        </form>
                        <br>
                        <a id = "goBackLink" href="addEntry.php">Go Back to Add Entry</a>
                    </div>
                </section>
                <hr>
            <?php } ?>
            <?php
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // Fetch all rows into an array
                    $posts = [];
                    while($row = $result->fetch_assoc()) {
                        $posts[] = $row;
                    }
                    
                    // Quick sort algorithm for post_datetime
                    function quickSortByDate($array) {
                        if(count($array) <= 1) {
                            return $array;
                        }
                        $pivot = strtotime($array[0]['post_datetime']);
                        $left = [];
                        $right = [];
                        for($i = 1; $i < count($array); $i++) {
                            $current = strtotime($array[$i]['post_datetime']);
                            if($current > $pivot) { // Newer than pivot goes to left
                                $left[] = $array[$i];
                            } else {
                                $right[] = $array[$i];
                            }
                        }
                        return array_merge(quickSortByDate($left), [$array[0]], quickSortByDate($right));
                    }
                    $sortedPosts = quickSortByDate($posts);

                    // Display sorted posts
                    foreach($sortedPosts as $row) {
                        // Display your blog post here
                        echo "<article>";
                        echo "<p class='post-datetime'>" . $row['post_datetime'] . " Europe/London</p>";
                        echo "<h2>" . $row['title'] . "</h2>";
                        echo "<p>" . $row['content'] . "</p>";
                        if (isAdmin()) {
                            echo "<form action='deletePost.php' method='post' class='admin-delete-form'>";
                            echo "<input type='hidden' name='post_id' value='" . $row['ID'] . "'>";
                            echo "<button type='submit' name='delete_post' class='delete-button'>Delete Post</button>";
                            echo "</form>";
                        }
                        echo "</article><hr>";
                        $comment_sql = "SELECT * FROM BLOGCOMMENTS WHERE id = " . $row['ID'] . " ORDER BY comment_datetime DESC";
                        $comments_result = $conn->query($comment_sql);
                        if ($comments_result->num_rows > 0) {
                            echo"<div class='comments-section'>";
                            $count = 1;
                            echo"<h3 id = 'comment-title'>Comments</h3>";
                            while($comment = $comments_result->fetch_assoc()) {
                                echo "<div class='comment'>";
                                echo "<p class = 'post-datetime'>" . $comment['comment_datetime'] . "</p>";
                                echo "<p>Comment " . $count . ":</p>";
                                echo "<p>" . $comment['comment_text'] . "</p>";
                                if (isAdmin()) {
                                    echo "<form action='deleteComment.php' method='post' class='admin-delete-form'>";
                                    echo "<input type='hidden' name='comment_post_id' value='" . $row['ID'] . "'>";
                                    echo "<input type='hidden' name='comment_text' value='" . htmlspecialchars($comment['comment_text'], ENT_QUOTES, 'UTF-8') . "'>";
                                    echo "<input type='hidden' name='comment_datetime' value='" . $comment['comment_datetime'] . "'>";
                                    echo "<button type='submit' name='delete_comment' class='delete-button' id = 'deleteComment'>Delete Comment</button>";
                                    echo "</form>";
                                }
                                echo "</div>";
                                echo "<hr>";
                                $count++;
                            }
                            echo "</div>";
                        }
                        if(isset($_SESSION['UserID'])){
                            echo "<form action='addComment.php' method='post' class='comment-form'>";
                            echo "<input type='hidden' name='id' value='" . $row['ID'] . "'>";
                            echo "<br>";
                            echo "<label>Comment:</label>";
                            echo "<textarea class ='comment_text' name='comment_text' rows='2'></textarea>";
                            echo "<br>";
                            echo "<button type='submit' name='submitcomment' class='comment-button'>Post Comment</button>";
                            echo "</form><hr>";
                        }
                        

                    }
                } else {
                    echo "<p>No blog posts available.</p>";
                }
                $conn->close();
                if(!isset($_SESSION['UserID'])){
                    echo "<p>to write a comment, please <a href='login.php'>login</a>.</p>";
                }
                if ($previewPost && isset($_POST['title'], $_POST['content']) && basename($_SERVER['PHP_SELF']) === 'viewBlog.php') {
                    // keep the preview available until it is submitted or replaced
                }
            ?>
        </div>


        <div class = "footer">
            <p>&copy; 2026 Elliot Scott</p>
            <nav>
                <a href = "index.php">Home</a>  <a href = "addEntry.php">Add Entry</a><br>
                
                <a href = "https://www.linkedin.com/in/elliot-scott-0301662b9/"><img src="images/linkedinIcon.webp" alt="LinkedIn Profile"></a>
                <a href = "https://github.com/EScott-LL10T?tab=repositories"><img src="images/gitHubIcon.png" alt="GitHub Profile"></a>
            </nav>
        </div>
    </div>
</body>
</html>