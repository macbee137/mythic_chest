<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('func.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Metamorphous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">





    <title>mystic-chest.shop</title>
</head>



<body>
    <div class="navbar">
        <div class="logo">
            <a href="/index.php">
                <img src="/imgs/logo2.png" alt="logo"></a>
        </div>
        <h2>mystic-chest</h2>
        <div class=" navmenu">
            <div class="productmenu">
                <a href="../public/products.php">All Products</a>
            </div>
            <a href="products.php">Categories</a>
            <div class="searchmenu">
                <form action="" method="POST">
                    <input type="text" class="search-input" name="search" placeholder="Search..">
                    <button class="searchbutton" name="searchbtn">Find</button>
                </form>
            </div>
        </div>
        <div class="navuser">
            <?php
            userLinks();

            if(isset($_POST['searchbtn'])) {
                header("Location: products.php");
            };
            ?>
        </div>
    </div>


    </div>
    <div class="main">