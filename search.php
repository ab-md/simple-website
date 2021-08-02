<?php
include("./includes/header.php");

if (isset($_GET['search'])) {
    $keyword = $_GET['search'];

    $posts = $connection->prepare("SELECT * FROM posts WHERE title LIKE :keyword");

    $posts->execute([':keyword' => "%$keyword%"]);
}
?>


<main id="main" class="row">

    <div class="col-lg-8 col-sm-6">

    <div class="col-12 m-1">
        <div class="alert alert-primary">
            پست های مرتبط با کلمه [<?php echo $_GET['search'] ?>]
        </div>
    </div>

        <main class="row row-cols-1 row-cols-md-2 g-4">

            <?php

            if ($posts->rowCount() > 0) {
                foreach ($posts as $post) {
                    $category_id = $post['category_id'];
                    $category_post = "SELECT * FROM categories WHERE id = $category_id";

                    $post_category = $connection->query($category_post)->fetch();

            ?>

                    <div id="main-object" class="col">
                        <div class="card">
                            <img src="./images/posts/<?php echo $post['image'] ?>" class="card-img-top">
                            <div class="card-body">
                                <div class="ca-title">
                                    <h5 class="card-title"><?php echo $post['title'] ?></h5>
                                    <span class="badge bg-primary">دسته: <?php echo $post_category['title'] ?></span>
                                </div>
                                <p class="card-text"><?php echo substr($post['text'], 0, 500) . "..." ?></p>
                                <div class="ca-footer">
                                    <a href="single.php?post=<?php echo $post['id'] ?>" class="btn btn-primary p-2">مشاهده بیشتر</a>
                                    <p>نویسنده: <?php echo $post['author'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
            } else {
                ?>

        </main>
                <div class="col m-3">
                    <div class="alert alert-danger">مقاله مورد نظر یافت نشد!!!</div>
                </div>
            <?php
            }
            ?>

    </div>

    <?php
    include("./includes/aside.php");

    include("./includes/footer.php");
    ?>