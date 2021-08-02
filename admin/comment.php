<?php
include("./includes/header.php");
include("./includes/aside.php");

$query_comments = "SELECT * FROM comments ORDER BY id DESC";
$comments = $db_connection->query($query_comments);

if(isset($_GET['action']) && isset($_GET['id'])){
    $action = $_GET['action'];
    $id = $_GET['id'];

    if($action == "delete"){
        $query = $db_connection->prepare("DELETE FROM comments WHERE id = :id");
        $query->execute([':id' => $id]);

        header("Location:comment.php");
        exit();
    } else {
        $query = $db_connection->prepare("UPDATE comments SET status = '1' WHERE id = :id");
        $query->execute([':id' => $id]);

        header("Location:comment.php");
        exit();
    }
}
?>

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
                            <?php
                            if ($comment['status']) {
                            ?>
                                <a href="" class="btn btn-outline-primary">تایید</a>
                            <?php
                            } else {
                            ?>
                                <a href="comment.php?action=approved&id=<?php echo $comment['id'] ?>" class="btn btn-outline-success">در انتظار تایید</a>
                            <?php
                            }
                            ?>
                            <a href="comment.php?action=delete&id=<?php echo $comment['id'] ?>" class="btn btn-outline-danger">حذف</a>
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

<?php
include("./includes/footer.php");
?>