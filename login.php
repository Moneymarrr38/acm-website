<?php
session_start();

$memberNo1 = 0;
$error = '';
$conID = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['uName'];
    $password = $_POST['pw'];

    openDatabase($conID);

    if (pwOK($conID, $username, $password, $memberNo1)) {
        session_regenerate_id(true);
        $_SESSION['username'] = $username;
        $_SESSION['memberno'] = $memberNo1;

        header('Location: dashboard.php');
        exit;
    } else {
        $error = "User name or password is wrong. Try again.";
    }
}

function openDatabase(&$conID) {
    $host = "localhost";
    $db   = "acmmarcus";
    $usr  = "root";
    $pw   = "";

    try {
        $conID = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $usr, $pw);
        $conID->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

function pwOK($conID, $uName1, $pw1, &$memberNo1) {
    try {
        $stmt = $conID->prepare("SELECT * FROM memberpw2 WHERE UserName = :username");
        $stmt->bindParam(':username', $uName1, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return false;
        }

        $memberNo1 = $row['MemberNo'];
        $hpw = $row['Password'];
        $salt = $row['Salt'];

        if ($hpw != sha1($pw1 . $salt)) {
            return false;
        }

        return true;
    } catch (PDOException $e) {
        die("Query Error: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UNCP ACM</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>UNCP ACM Chapter</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="events.php">Events</a>
            <a href="contact.php">Contact</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </nav>
    </header>

    <main>
        <div class="form-container">
            <h2>Member Login</h2>

            <?php if (isset($_GET['msg'])): ?>
                <p class="message"><?php echo htmlspecialchars($_GET['msg']); ?></p>
            <?php endif; ?>

            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="post">
                <table>
                    <tr>
                        <td>User Name</td>
                        <td><input name="uName" type="text" required></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input name="pw" type="password" required></td>
                    </tr>
                    <tr>
                        <td><input name="login" value="Login" type="submit"></td>
                        <td><input type="reset"></td>
                    </tr>
                </table>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 UNCP ACM Chapter</p>
    </footer>
</body>
</html>