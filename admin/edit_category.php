<?php
include("./includes/header.php");
include("./includes/aside.php");

if(isset($_GET['id'])){
    $category_id = $_GET['id'];
    $category = $db_connection->prepare("SELECT * FROM categories WHERE id = :id");
    $category->execute([':id' => $category_id]);
    
    $category = $category->fetch();
}

if(isset($_POST['edit_category'])){
    if(trim($_POST['title']) != ""){
        $title = $_POST['title'];
        $category_update = $db_connection->prepare("UPDATE categories SET title = :title WHERE id = :id");
        $category_update->execute([':title' => $title , ':id' => $category_id]);

        header("Location:category.php");
        exit();
    } else {
        header("Location:edit_category.php?id=$category_id&err_msg=فیلد عنوان الزامی هست");
        exit();
    }
}
?>

<form method="post">

    <h2>ویرایش دسته</h2>
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
        <input class="form-control" value="<?php echo $category['title'] ?>" type="text" name="title" id="title">
    </div>

    <div class="p-1">
        <button type="submit" name="edit_category" class="btn btn-outline-primary">ویرایش</button>
    </div>

</form>

<?php
include("./includes/footer.php");
?>