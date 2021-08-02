<?php
include("./includes/header.php");
include("./includes/aside.php");


if( isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id']) ){
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];

    if($action == "delete"){
        if($entity == "post"){
            $query = $db_connection->prepare("DELETE FROM posts WHERE id = :id");
        } elseif($entity == "category"){
            $query = $db_connection->prepare("DELETE FROM categories WHERE id = :id");
        } else {
            $query = $db_connection->prepare("DELETE FROM comments WHERE id = :id");
        }
        $query->execute([':id' => $id]);
    } else {
        $query = $db_connection->prepare("UPDATE comments SET status = '1' WHERE id = :id");
        $query->execute([':id' => $id]);
    }
}


$query_posts = "SELECT * FROM posts ORDER BY id DESC";
$posts = $db_connection->query($query_posts);

$query_comments = "SELECT * FROM comments WHERE status = '0' ORDER BY id DESC";
$comments = $db_connection->query($query_comments);

$query_categories = "SELECT * FROM categories ORDER BY id DESC";
$categories = $db_connection->query($query_categories);
?>

<div>
    <h3>داشبورد</h3>
</div>

<hr>

<div>
    <h3>مقالات اخیر</h3>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>عنوان</th>
                <th>نویسنده</th>
                <th>تنظیمات</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if ($posts->rowCount() > 0) {
                foreach ($posts as $post) {
            ?>
                    <tr>
                        <td><?php echo $post['id'] ?></td>
                        <td><?php echo $post['title'] ?></td>
                        <td><?php echo $post['author'] ?></td>
                        <td>
                            <a href="edit_post.php?id=<?php echo $post['id'] ?>" class="btn btn-outline-primary">ویرایش</a>
                            <a href="index.php?entity=post&action=delete&id=<?php echo $post['id'] ?>" class="btn btn-outline-danger">حذف</a>
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

<div>
    <h3>کامنت های اخیر</h3>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>نام</th>
                <th>کامنت</th>
                <th>تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($comments->rowCount() > 0) {
                foreach ($comments as $comment) {
            ?>
                    <tr>
                        <td><?php echo $comment['id'] ?></td>
                        <td><?php echo $comment['name'] ?></td>
                        <td><?php echo $comment['comment'] ?></td>
                        <td>
                            <a href="index.php?entity=comment&action=approved&id=<?php echo $comment['id'] ?>" class="btn btn-outline-primary">تایید</a>
                            <a href="index.php?entity=comment&action=delete&id=<?php echo $comment['id'] ?>" class="btn btn-outline-danger">حذف</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <div class="alert alert-danger">کامنتی برای نمایش وجود ندارد!!!</div>
            <?php
            }
            ?>

        </tbody>
    </table>
</div>

<div>
    <h3>دسته بندی ها</h3>
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
                            <a href="index.php?entity=category&action=delete&id=<?php echo $category['id'] ?>" class="btn btn-outline-danger">حذف</a>
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