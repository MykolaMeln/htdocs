<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = 'root';
    $DATABASE_NAME = 'workagency';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        exit('Failed to connect to database!');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>$title</title>
        <link href="style.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    </head>
    <body>
    <nav class="navtop">
        <div>
            <h1>Agency</h1>
            <a href="index.php"><i class="fas fa-home"></i>Home</a>
            <a href="login.php"><i class="fas fa-sign-in-alt"></i>Log in</a>
            <a href="register.php"><i class="fas fa-user-plus"></i>Register</a>
        </div>
    </nav>
EOT;
}
function template_footer() {
echo <<<EOT
    <div align=center class="myfooter">
        <footer>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="index.php">Home</a></li>
                <li class="list-inline-item"><a href="index.php">About</a></li>
                <li class="list-inline-item"><a href="index.php">Terms</a></li>
                <li class="list-inline-item"><a href="index.php">Privacy Policy</a></li>
            </ul>
            <p class="copyright">Agency © 2021</p>
        </footer>
    </div>
    </body>
</html>
EOT;
}
function template_footere() {
echo <<<EOT
    <div align=center class="myfooter">
        <footer>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="homee.php">Home</a></li>
                <li class="list-inline-item"><a href="homee.php">About</a></li>
                <li class="list-inline-item"><a href="homee.php">Terms</a></li>
                <li class="list-inline-item"><a href="homee.php">Privacy Policy</a></li>
            </ul>
            <p class="copyright">Agency © 2021</p>
        </footer>
    </div>
    </body>
</html>
EOT;
}
function template_footerr() {
echo <<<EOT
    <div align=center class="myfooter">
        <footer>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="homer.php">Home</a></li>
                <li class="list-inline-item"><a href="homer.php">About</a></li>
                <li class="list-inline-item"><a href="homer.php">Terms</a></li>
                <li class="list-inline-item"><a href="homer.php">Privacy Policy</a></li>
            </ul>
            <p class="copyright">Agency © 2021</p>
        </footer>
    </div>
    </body>
</html>
EOT;
}
function template_footerad() {
echo <<<EOT
    <div align=center class="myfooter">
        <footer>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="homead.php">Home</a></li>
                <li class="list-inline-item"><a href="homead.php">About</a></li>
                <li class="list-inline-item"><a href="homead.php">Terms</a></li>
                <li class="list-inline-item"><a href="homead.php">Privacy Policy</a></li>
            </ul>
            <p class="copyright">Agency © 2021</p>
        </footer>
    </div>
    </body>
</html>
EOT;
}
function template_footerm() {
echo <<<EOT
    <div align=center class="myfooter">
        <footer>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="homem.php">Home</a></li>
                <li class="list-inline-item"><a href="homem.php">About</a></li>
                <li class="list-inline-item"><a href="homem.php">Terms</a></li>
                <li class="list-inline-item"><a href="homem.php">Privacy Policy</a></li>
            </ul>
            <p class="copyright">Agency © 2021</p>
        </footer>
    </div>
    </body>
</html>
EOT;
}
function template_headere($title, $name) {//employee
echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>$title</title>
        <link href="style.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    </head>
    <body>
    <nav class="navtop">
        <div>
            <h1>Agency</h1>
            <a href="homee.php"><i class="fas fa-home"></i>Home</a>
            <a href="resume.php"><i class="far fa-sticky-note"></i>Resume</a>
            <a href="employeedata.php"><i class="fas fa-user"></i>Employee Data</a>
            <a href="profilee.php"><i class="fas fa-user"></i>Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            <a><i></i>$name</a>
        </div>
    </nav>
EOT;
}
function template_headerr($title, $name) {//employer
echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>$title</title>
        <link href="style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    </head>
    <body>
    <nav class="navtop">
        <div>
            <h1>Agency</h1>
            <a href="homer.php"><i class="fas fa-home"></i>Home</a>
            <a href="myvacancies.php"><i class="far fa-sticky-note"></i>My Vacancies</a>
            <a href="employerdata.php"><i class="fas fa-user"></i>Employer Data</a>
            <a href="profiler.php"><i class="fas fa-user"></i>Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            <a><i></i>$name</a>
        </div>
    </nav>
EOT;
}
function template_headerad($title, $name) {//admin
echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>$title</title>
        <link href="style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    </head>
    <body>
    <nav class="navtop">
        <div>
            <h1>Agency</h1>
            <a href="homead.php"><i class="fas fa-home"></i>Home</a>
            <a href="users.php"><i class="fas fa-users"></i>Users</a>
            <a href="profilead.php"><i class="fas fa-user"></i>Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            <a><i></i>$name</a>
        </div>
    </nav>
EOT;
}
function template_headerm($title, $name) {//moder
echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>$title</title>
        <link href="style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    </head>
    <body>
    <nav class="navtop">
        <div>
            <h1>Agency</h1>
            <a href="homem.php"><i class="fas fa-home"></i>Home</a>
            <a href="works.php"><i class="fas fa-address-book"></i>Works</a>
            <a href="profilem.php"><i class="fas fa-user"></i>Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            <a><i></i>$name</a>
        </div>
    </nav>
EOT;
}
?>
