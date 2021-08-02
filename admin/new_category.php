<?php
include("./includes/header.php");
include("./includes/aside.php");

if(isset($_POST['add_category'])){
    if(trim($_POST['title']) != ""){
        $title = $_POST['title'];
        $category_insert = $db_connection->prepare("INSERT INTO categories (title) VALUES (:title)");
        $category_insert->execute([':title' => $title]);

        header("Location:category.php");
        exit();
    } else {
        header("Location:new_category.php?err_msg=فیلد عنوان الزامی هست");
        exit();
    }
}
?>

<form method="post">

    <h2>ایجاد دسته</h2>
    <hr>

    <?php
    if(isset($_GET['err_msg'])){
        ?>
        <div class="alert alert-danger"><?php echo $_GET['err_msg'] ?></div>
        <?php
    }
    ?>

    <div class="p-1">
        <label for="title" class="p-1">عنوان :</label>
        <input type="text" name="title" id="title" class="form-control">
    </div>

    <div class="p-1">
        <button type="submit" name="add_category" class="btn btn-outline-primary">ایجاد</button>
    </div>

</form>

<?php
include("./includes/footer.php");
?>