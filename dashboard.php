<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$memberno = $_SESSION['memberno'];

$conID = new mysqli("localhost", "root", "", "acmmarcus");

if ($conID->connect_error) {
    die("Connection failed: " . $conID->connect_error);
}

$SQL = "SELECT * FROM member2 WHERE MemberNo = $memberno";
$result = $conID->query($SQL);

if (!$result) {
    die("Query Error: " . $conID->error);
}

$row = $result->fetch_assoc();

if (!$row) {
    die("Member information not found.");
}

$conID->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - UNCP ACM</title>
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
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <div class="dashboard-box">
            <h2>Welcome, <?php echo htmlspecialchars($row['FirstName']); ?>!</h2>
            <p>You are logged in to the UNCP ACM member dashboard.</p>

            <table class="data-table">
                <tr>
                    <th>Member Number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Deposit</th>
                </tr>
                <tr>
                    <td><?php echo $row['MemberNo']; ?></td>
                    <td><?php echo htmlspecialchars($row['FirstName']); ?></td>
                    <td><?php echo htmlspecialchars($row['LastName']); ?></td>
                    <td><?php echo htmlspecialchars($row['Deposit']); ?></td>
                </tr>
            </table>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 UNCP ACM Chapter</p>
    </footer>
</body>
</html>