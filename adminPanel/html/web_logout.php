<?php
session_start();
//session_unset();
unset($_SESSION['admin_E']);
echo "<script>location.assign('../index.php')</script>"
?>