<?php
$server = "mysql:host=localhost;dbname=onlineshoppingcart";
$user = "root";
$pass = "";
$pdo = new PDO($server,$user,$pass);
// if($pdo){
//     echo"<script>alert('connected')</script>";
// }