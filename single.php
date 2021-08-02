<?php
include("./includes/header.php");

if (isset($_GET['post'])) {
    $post_id = $_GET['post'];

    $post = $connection->prepare("SELECT * FROM posts WHERE id = :id");
    $post->execute([':id' => $post_id]);
    $post = $post->fetch();
}

if (isset($_POST['send'])) {
    if (trim($_POST['name']) != "" || trim($_POST['comment']) != "") {
        $name = $_POST['name'];
        $comment = $_POST['comment'];

        $send_comment = $connection->prepare("INSERT INTO comments (name, comment, post_id) VALUES (:name , :comment , :post_id)");
        $send_comment->execute([':name' => $name, ':comment' => $comment, ':post_id' => $post_id]);
        header("Location:single.php?post=$post_id");
        exit();
    } else {
?>
        <p class="m-1">*<span style="color: red;">فیلد ها نباید خالی باشند!</span>
        </p>
<?php
    }
}
?>

<section class="row m-1">

    <main class="col-sm-8">

        <?php
        if ($post) {
            $category_id = $post['category_id'];
            $category_post = "SELECT * FROM categories WHERE id = $category_id";
            $post_category = $connection->query($category_post)->fetch();

            $post_id = $post['id'];
            $comments = $connection->prepare("SELECT * FROM comments WHERE post_id = :id AND status = 1");
            $comments->execute([':id' => $post_id]);
        ?>

            <div class="row">

                <div>
                    <img src="./images/posts/<?php echo $post['image'] ?>" class="w-100">
                </div>

                <div>
                    <h2><?php echo $post['title'] ?></h2>
                    <span class="badge bg-secondary">دسته: <?php echo $post_category['title'] ?></span>
                </div>

                <article>
                    <p><?php echo $post['text'] ?></p>
                    <span>نویسنده: <?php echo $post['author'] ?></span>
                </article>
            </div>

            <br>
            <br>

            <hr>

            <br>
            <br>

            <div id="forms" class="row">
                <div class="col-12 form">
                    <form method="post" action="">
                        <input class="form-control" type="text" name="name" placeholder="نام">
                        <!-- <input type="email" name="email" placeholder="ایمیل"> -->
                        <textarea class="form-control" name="comment" id="" cols="30" rows="5" placeholder="نظر خود را بنویسید"></textarea>

                        <div class="justify-center">
                            <button class="btn btn-primary" name="send">ارسال</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row m-1">

                <p>تعداد کامنت: <?php echo $comments->rowCount() ?></p>

                <?php
                if ($comments->rowCount() > 0) {
                    foreach ($comments as $comment) {
                ?>

                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $comment['name'] ?></h5>
                                    <p class="card-text"><?php echo $comment['comment'] ?></p>
                                </div>
                            </div>
                        </div>

                <?php
                    }
                }
                ?>

            </div>

        <?php
        } else {
        ?>
            <div class="alert alert-danger m-1">مقاله مورد نظر پیدا نشد!!!</div>
        <?php
        }
        ?>

    </main>

    <?php
    include "./includes/aside.php";
    ?>

</section>

<?php
include("./includes/footer.php");
?>