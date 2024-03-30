<?php
include("querry.php");
//session_unset();
unset($_SESSION['user_E']);
echo "<script>location.assign('index.php')</script>"
?>