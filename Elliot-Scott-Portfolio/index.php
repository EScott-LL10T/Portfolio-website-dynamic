<?php
    session_start();
    if(isset($_SESSION['UserID'])) {
        $flag = true;
    } else {
        $flag = false;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Home Page</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/indexStyle.css">
    <link rel="stylesheet" href="css/indexMobile.css" media="only screen and (max-width: 768px)">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bungee&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class = "gridContainer">
        <header>
            <h1>Home Page of: Elliot Scott</h1>
        </header>
        <nav>
            <div class = "flexContainer">
                <div>
                    <a href = "education.html">My education</a>
                </div>
                <div>
                    <a href = "portfolio.html">My portfolio</a>
                </div>
                <div>
                    <a href = "skills.html">My skills</a>
                </div>
            </div>
        </nav>
        <article>
            <h2>Welcome to My Home Page</h2>
            <p>This is the home page for the website all about me, wether that is my personal interests or my professional background. 
                However this is mainly a place for me to showcase my work and interests.
            </p>
            <hr>
            <section>
                <h3>My profession</h3>
                <p>My main love is computer science more specifically development and whilst i still have alot to learn, I am eager 
                    and passionate about improving my skills.
                </p>
            </section>
            <hr>
            <section>
                <h3>My Current situation</h3>
                <p>
                    I am currently a student at Queen Mary university London studying computer science with a year in industry and attend 4 days
                    of the week.
                </p>
            </section>
            <hr>
            <section>
                <h3>My Hobbies</h3>
                <p>
                    I have a wide range of hobbies but my main ones are gaming, music and sports.
                </p>
            </section>
            <hr>
            <section>
                <h3>My goals</h3>
                <p>
                    My main goal is to become a software developer and work on projects that I am passionate about.
                </p>
            </section>
        </article>
        <aside>
            <figure>

                <img src = "images/proffesionalPicuterOfMe.png" alt = "A picture of me">
                <figcaption>My professional picture</figcaption>
            </figure>
            <br>
            <h4>Sign up for my blog:</h4>
            <p>
                There is a blog where you can post your thoughts questions advice or anything else you want to share with me and the other 
                visitors. To sign up click the sign up link and to log in etc.
            </p>
            <?php if (!$flag): ?>
                <div class = "buttonContainer">
                    <div>
                        <a href = "viewBlog.php"><button>Go to blog</button></a>
                    </div>
                    <div>
                        <a href = "signup.php"><button>sign up</button></a>
                    </div>
                    <div>
                        <a href = "login.php"><button>log in</button></a>
                    </div>
                </div>
            <?php else: ?>
                <div class = "buttonContainer">
                    <div>
                        <a href = "viewBlog.php"><button>Go to blog</button></a>
                    </div>
                    <div>
                        <a href = "addEntry.php"><button>Post to blog</button></a>
                    </div>
                    <div>
                        <a href = "logout.php"><button>log out</button></a>
                    </div>
                </div>
            <?php endif ?>
            <h4>Contact me:</h4>
            <p>Feel free to reach out to me via email 
                at <a href="mailto:elliotscott2111@gmail.com">elliot.scott@gmail.com</a>. Alternatively you can text me at <a href="tel:07803796513">07803796513</a>. Or you can follow me on <a href = "https://www.linkedin.com/in/elliot-scott-0301662b9/">LinkedIn</a>.</p>
        </aside>
        <footer>
            <p>&copy; 2026 Elliot Scott</p>
            <a href = "https://www.linkedin.com/in/elliot-scott-0301662b9/"><img src="images/linkedinIcon.webp" alt="LinkedIn Profile"></a>
            <a href = "https://github.com/EScott-LL10T?tab=repositories"><img src="images/gitHubIcon.png" alt="GitHub Profile"></a>

        </footer>
    </div>
</body>
</html>