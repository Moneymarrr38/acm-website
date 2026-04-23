<?php
session_start();
session_unset();
session_destroy();

header("Location: login2T2.php?msg=You have been logged out");
exit;
?>