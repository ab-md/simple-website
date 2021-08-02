<?php
session_start();

$db_connection = new PDO("mysql:host=localhost;dbname=my_website;charset=utf8" , "root" , "");
// include("./config.php");
// include("./db_connection.php");

if( !isset($_SESSION['email'])){
    header("Location:signin.php?err_msg=ابتدا وارد سیستم شوید");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Admin Panel</title>
</head>

<body>

    <nav id="navbar">
        <div>
            <a href="./index.php">WebSite.com</a>
        </div>
        <div>
            <a href="./logout.php">خروج</a>
        </div>
    </nav>