<?php
include("./includes/header.php");
include("./includes/aside.php");

$query_posts = "SELECT * FROM posts ORDER BY id DESC";
$posts = $db_connection->query($query_posts);

if( isset($_GET['action']) && isset($_GET['id']) ){
    $id = $_GET['id'];
    $query = $db_connection->prepare("DELETE FROM posts WHERE id = :id");
    $query->execute([':id' => $id]);

    header("Location:post.php");
}
?>

<div>
    <div class="con p-2">
        <h3>مقالات</h3>
        <a href="new_post.php" class="btn btn-outline-primary">ایجاد مقاله</a>
    </div>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>عنوان</th>
                <th>نویسنده</th>
                <th>دسته بندی</th>
                <th>تنظیمات</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if ($posts->rowCount() > 0) {
                foreach ($posts as $post) {
                    $category_id = $post['category_id'];
                    $category_post = "SELECT * FROM categories WHERE id = $category_id";
                    $post_category = $db_connection->query($category_post)->fetch();
            ?>
                    <tr>
                        <td><?php echo $post['id'] ?></td>
                        <td><?php echo $post['title'] ?></td>
                        <td><?php echo $post['author'] ?></td>
                        <td><?php echo $post_category['title'] ?></td>
                        <td>
                            <a href="edit_post.php?id=<?php echo $post['id'] ?>" class="btn btn-outline-primary">ویرایش</a>
                            <a href="post.php?action=delete&id=<?php echo $post['id'] ?>" class="btn btn-outline-danger">حذف</a>
                        </td>
                    </tr>

                <?php
                }
            } else {
                ?>
                <div class="alert alert-danger">مقاله ای برای نمایش وجود ندارد!!!</div>
            <?php
            }
            ?>


        </tbody>
    </table>
</div>