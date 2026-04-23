<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - UNCP ACM</title>
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
            <h2>Create an Account</h2>

            <form action="register_process.php" method="post">
                <table>
                    <tr>
                        <td>First Name</td>
                        <td><input type="text" name="fname" required></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" name="lname" required></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td>User Name</td>
                        <td><input type="text" name="username" required></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password" required></td>
                    </tr>
                    <tr>
                        <td>Deposit</td>
                        <td><input type="number" name="deposit" required></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Register"></td>
                        <td><input type="reset" value="Reset"></td>
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