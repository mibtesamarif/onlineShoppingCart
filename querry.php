<?php
session_start();
include("adminPanel\html\dbcon.php");
if(isset($_POST['login'])){
    $userEmail  = $_POST['userEmail'];
     $userPassword  = $_POST['userPassword'];
     $query = $pdo->prepare("SELECT * FROM user WHERE email = :uEmail AND pass = :uPassword");
     $query->bindParam('uEmail',$userEmail);
     $query->bindParam('uPassword',$userPassword);
     $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
    if($user['role_id'] ==1){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['admin_E'] = $user['email'];
        $_SESSION['usName'] = $user['name'];
        echo "<script>alert('login successfully');
        location.assign('adminPanel\html\index.php')</script>";
    }
    else if($user['role_id'] ==2){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_E'] = $user['email'];
        $_SESSION['usName_1'] = $user['name'];
        echo "<script>alert('login successfully');
        location.assign('index.php')</script>";
    }
}
?>