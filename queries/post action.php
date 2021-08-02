<?php
    $con = new PDO("mysql:host=localhost;dbname=my_website;charset=utf8" , "root" , "");
    // $query = "INSERT INTO posts (id, title, category_id, text, author, image) VALUES (:id, :title, :c_id, :text, :author, :image)";

    // $stmt = $con->prepare($query);

    // $id = $_POST['id'];
    // $title = $_POST['title'];
    // $c_id = $_POST['c_id'];
    // $text = $_POST['text'];
    // $author = $_POST['author'];
    // $image = $_POST['image'];

    // $params = ['id' => $id , 'title' => $title , ':c_id' => $c_id , 'text' => $text , 'author' => $author , 'image' => $image];
    
    // if ( $stmt->execute($params) ) {
    //     echo "Done";
    // } else {
    //     echo "Error!";
    // }


    
    // $query2 = "UPDATE posts SET text = :text2 WHERE id > :id2";

    // $stmt2 = $con->prepare($query2);

    // $id2 = 0;
    // $text2 = $_POST['text'];

    // $params2 = [':id2' => $id2 , ':text2' => $text2];

    // if($stmt2->execute($params2)){
    //     echo "Done";
    // }else{
    //     echo "Error!";
    // }
?>