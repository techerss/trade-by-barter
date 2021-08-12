<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/boostrap4/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-5.15.2-web/css/all.css">
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
    <meta id="themecolor" name="theme-color" content="#008080">
    <title>Home Page</title>
</head>

 <?php
require_once('connection.php');

 	session_start();

    if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_Query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    $userid = $row['id'];
    $firstname = $row['firstname'];
    $surname = $row['surname'];
    $email = $row['email'];
    $state = $row['state'];
    $phone = $row['phone'];
    $photo = $row['photo'];
    $coin = $row['coin'];



  }

   
    