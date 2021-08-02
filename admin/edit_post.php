<?php
include("./includes/header.php");
include("./includes/aside.php");

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $posts = $db_connection->prepare("SELECT * FROM posts WHERE id = :id");
    $posts->execute([':id' => $post_id]);
    $posts = $posts->fetch();

    $query_categories = "SELECT * FROM categories";
    $categories = $db_connection->query($query_categories);
}

if (isset($_POST['edit_post'])) {
    if (trim($_POST['title']) != "" && trim($_POST['author']) != "" && trim($_POST['category_id']) != "" && trim($_POST['text']) != "") {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $category_id = $_POST['category_id'];
        $text = $_POST['text'];

        if (trim($_FILES['image']['name']) != "") {
            $image_name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            if (move_uploaded_file($tmp_name, "../images/posts/$image_name")) {
                echo "Upload success";
            } else {
                echo "Upload error";
            }

            $post_update = $db_connection->prepare("UPDATE posts SET title = :title, author = :author, category_id = :category_id, text = :text, image = :image WHERE id = :id");
            $post_update->execute([':title' => $title, ':author' => $author, ':category_id' => $category_id, ':text' => $text, ':image' => $image_name, ':id' => $post_id]);
        } else {
            $post_update = $db_connection->prepare("UPDATE posts SET title = :title, author = :author, category_id = :category_id, text = :text WHERE id = :id");
            $post_update->execute([':title' => $title, ':author' => $author, ':category_id' => $category_id, ':text' => $text, ':id' => $post_id]);
        }

        header("Location:post.php");
        exit();
    } else {
        header("Location:edit_post.php?id=$post_id&err_msg=تمام فیلد ها الزامی است");
        exit();
    }
}
?>

<form method="post" class="p-1" enctype="multipart/form-data">

    <h2>ویرایش مقاله</h2>
    <hr>

    <?php
    if (isset($_GET['err_msg'])) {
    ?>
        <div class="alert alert-danger">
            <?php echo $_GET['err_msg'] ?>
        </div>
    <?php
    }
    ?>

    <div class="p-1">
        <label class="p-1" for="title">عنوان :</label>
        <input class="form-control" type="text" name="title" id="title" value="<?php echo $posts['title'] ?>">
    </div>

    <div class="p-1">
        <label class="p-1" for="author">نویسنده :</label>
        <input class="form-control" type="text" name="author" id="author" value="<?php echo $posts['author'] ?>">
    </div>

    <div class="p-1">
        <label for="category_id">دسته بندی :</label>
        <select class="form-control" name="category_id" id="category_id">
            <?php
            if ($categories->rowCount() > 0) {
                foreach ($categories as $category) {
            ?>
                    <option value="<?php echo $category['id'] ?>" <?php echo ($category['id'] == $posts['category_id']) ? "selected" : "" ?>>
                        <?php echo $category['title'] ?>
                    </option>
            <?php
                }
            }
            ?>
        </select>
    </div>

    <div class="p-1">
        <label class="p-1" for="text">متن مقاله :</label>
        <textarea class="form-control" name="text" id="text" cols="30" rows="10">
        <?php echo $posts['text'] ?>
        </textarea>
    </div>

    <img src="../images/posts/<?php echo $posts['image'] ?>" class="w-100" alt="">

    <div class="p-1">
        <label class="p-1" for="image">تصویر :</label>
        <input class="form-control" type="file" name="image" id="image">
    </div>

    <div class="p-1">
        <button type="submit" name="edit_post" class="btn btn-outline-primary">ایجاد مقاله</button>
    </div>

</form>

<?php
include("./includes/footer.php");
?>