<?php
include("./includes/header.php");
include("./includes/aside.php");

$query_categories = "SELECT * FROM categories";
$categories = $db_connection->query($query_categories);

if (isset($_POST['add_post'])) {
    if (trim($_POST['title']) != "" && trim($_POST['author']) != "" && trim($_POST['category_id']) != "" && trim($_POST['text']) != "" && trim($_FILES['image']['name']) != "") {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $category_id = $_POST['category_id'];
        $text = $_POST['text'];

        $image_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        if (move_uploaded_file($tmp_name, "../images/posts/$image_name")) {
            echo "Upload success!";
        } else {
            echo "Upload error!";
        }

        $post_insert = $db_connection->prepare("INSERT INTO posts (title, author, category_id, text, image) VALUES (:title, :author, :category_id, :text, :image)");
        $post_insert->execute([':title' => $title, ':author' => $author, ':category_id' => $category_id, ':text' => $text, ':image' => $image_name]);

        header("Location:post.php");
        exit();
    } else {
        header("Location:new_post.php?err_msg=تمامی فیلد ها الزامی هست");
        exit();
    }
}
?>

<form method="post" class="p-1" enctype="multipart/form-data">

    <h2>ایجاد مقاله</h2>
    <hr>

    <?php
    if (isset($_GET['err_msg'])) {
    ?>
        <div class="alert alert-danger"><?php echo $_GET['err_msg'] ?></div>
    <?php
    }
    ?>

    <div class="p-1">
        <label class="p-1" for="title">عنوان :</label>
        <input class="form-control" type="text" name="title" id="title">
    </div>

    <div class="p-1">
        <label class="p-1" for="author">نویسنده :</label>
        <input class="form-control" type="text" name="author" id="author">
    </div>

    <div class="p-1">
        <label for="category_id">دسته بندی :</label>
        <select class="form-control" name="category_id" id="category_id">
            <?php
            if ($categories->rowCount() > 0) {
                foreach ($categories as $category) {
            ?>
                    <option value="<?php echo $category['id'] ?>"> <?php echo $category['title'] ?> </option>
            <?php
                }
            }
            ?>
        </select>
    </div>

    <div class="p-1">
        <label class="p-1" for="text">متن مقاله :</label>
        <textarea class="form-control" name="text" id="text" cols="30" rows="10"></textarea>
    </div>

    <div class="p-1">
        <label class="p-1" for="image">تصویر :</label>
        <input class="form-control" type="file" name="image" id="image">
    </div>

    <div class="p-1">
        <button type="submit" name="add_post" class="btn btn-outline-primary">ایجاد مقاله</button>
    </div>

</form>

<?php
include("./includes/footer.php");
?>