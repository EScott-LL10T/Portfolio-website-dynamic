<?php
    session_start();
    if (!isset($_SESSION['UserID'])) {
        header("Location: login.php");
        exit();
    }
    $draftTitle = $_SESSION['blog_preview']['title'] ?? '';
    $draftContent = $_SESSION['blog_preview']['content'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add entry</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href = "css/addEntryStyle.css">
    <link rel="stylesheet" href="css/addEntryMobile.css" media="only screen and (max-width: 768px)">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bungee&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class = "flexContainer">
        <div>
            <header>
                <h1>add entry to blog</h1>
            </header>
        </div>
        <div>
            <main>
                <form action="addPost.php" method="post" id = "myForm">
                    <label for="titleInput">Blog Post Title</label><br>
                    <input type="text" id="titleInput" name="title" value="<?php echo htmlspecialchars($draftTitle, ENT_QUOTES, 'UTF-8'); ?>"><br><br>
                    
                    <label for="content">Content</label><br>
                    <textarea id="content" name="content" rows="10" cols="50"><?php echo htmlspecialchars($draftContent, ENT_QUOTES, 'UTF-8'); ?></textarea><br><br>
                    <div class = "buttonContainer">
                        <input type="reset" value="clear" class="formButton">
                        <button type="submit" id="previewButton" class="formButton" formaction="viewBlog.php" formmethod="post" formnovalidate>preview</button>
                        <button type="submit" id="postButton" class="formButton">post</button>
                    </div>
                </form>
            </main>
        </div>
        <div>
            <footer>
                <p>&copy; 2026 Elliot Scott</p>
                <a href = "index.php">Back to home page</a>
            </footer>
        </div>
    </div>
    <script src="js/addEntry.js"></script>
</body>
</html>