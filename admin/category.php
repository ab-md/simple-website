<?php
include("./includes/header.php");
include("./includes/aside.php");

$query_categories = "SELECT * FROM categories ORDER BY id DESC";
$categories = $db_connection->query($query_categories);

if(isset($_GET['action']) && isset($_GET['id'])){
    $id = $_GET['id'];

    $query = $db_connection->prepare("DELETE FROM categories WHERE id = :id");
    $query->execute([':id' => $id]);

    header("Location:category.php");
    exit();
}
?>

<div>
    <div class="con p-2">
        <h3>دسته بندی ها</h3>
        <a href="new_category.php" class="btn btn-outline-primary">ایجاد دسته</a>
    </div>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>عنوان</th>
                <th>تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($categories->rowCount() > 0) {
                foreach ($categories as $category) {
            ?>
                    <tr>
                        <td><?php echo $category['id'] ?></td>
                        <td><?php echo $category['title'] ?></td>
                        <td>
                            <a href="edit_category.php?id=<?php echo $category['id'] ?>" class="btn btn-outline-primary">ویرایش</a>
                            <a href="category.php?action=delete&id=<?php echo $category['id'] ?>" class="btn btn-outline-danger">حذف</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <div class="alert alert-danger">دسته ای برای نمایش وجود ندارد!!!</div>
            <?php
            }
            ?>

        </tbody>
    </table>
</div>

<?php
include("./includes/footer.php");
?>