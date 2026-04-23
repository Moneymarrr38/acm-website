<?php
$conID = new mysqli("localhost", "root", "", "acmmarcus");

if ($conID->connect_error) {
    die("Connection failed: " . $conID->connect_error);
}

// Check if username already exists
function usernameTaken($conID, $uName) {
    $sql = "SELECT * FROM memberpw2 WHERE UserName = '$uName'";
    $result = $conID->query($sql);
    return $result->num_rows > 0;
}

// Insert user into database
function write($conID, $fName, $lName, $eMail, $uName, $pw, $deposit) {

    // Generate salt
    $salt = bin2hex(random_bytes(16));

    // Hash password + salt
    $hashed_password = sha1($pw . $salt);

    // Insert into memberpw2 table
    $sql = "INSERT INTO memberpw2 (UserName, Password, eMail, Salt)
            VALUES ('$uName', '$hashed_password', '$eMail', '$salt')";

    if ($conID->query($sql) === TRUE) {
        $memberNo = $conID->insert_id;
    } else {
        die("Error inserting user: " . $conID->error);
    }

    // Insert into member2 table
    $sql2 = "INSERT INTO member2 (MemberNo, FirstName, LastName, Deposit)
             VALUES ('$memberNo', '$fName', '$lName', '$deposit')";

    if ($conID->query($sql2) === TRUE) {
        return true;
    } else {
        die("Error inserting member info: " . $conID->error);
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fName = $_POST['fname'];
    $lName = $_POST['lname'];
    $eMail = $_POST['email'];
    $uName = $_POST['username'];
    $pw = $_POST['password'];
    $deposit = $_POST['deposit'];

    if (usernameTaken($conID, $uName)) {
        echo "Username already taken";
    } else {
        if (write($conID, $fName, $lName, $eMail, $uName, $pw, $deposit)) {

            // Redirect to login page
            header("Location: login.php?msg=Registration successful. Please log in.");
            exit;
        }
    }
}

$conID->close();
?>