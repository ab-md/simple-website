<?php
    // $connection = new PDO("mysql:host=localhost;dbname=my_website;charset=utf8" , "root" , "");
    include("./includes/config.php");
    include("./includes/db.php");

    $query = "SELECT * FROM categories";
    $categories = $connection->query($query);
?>


<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/font awsome/css/all.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>پروژه</title>
</head>
<body>

    <nav id="navbar" class="sticky-top">

        <div id="site-brand">
            <h3>
                <a href="./index.php" class="">وبسایت من</a>
            </h3>
        </div>

        <div class="nav-li">
            <ul class="">

            <?php
            if($categories->rowCount() > 0){
                foreach($categories as $category){
                        ?>
                        <li class="">
                            <a 
                            class="<?php echo ( isset($_GET['category']) && $category['id'] == $_GET['category'] ) ? "actived" : ""; ?>" 
                            href="index.php?category=<?php echo $category['id']; ?>"><?php echo $category['title']; ?></a>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>

    </nav>