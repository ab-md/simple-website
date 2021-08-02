<?php
$query_slider = "SELECT * FROM posts_slider";
$posts_slider = $connection->query($query_slider);
?>


<section id="slider">

    <div class="carousel slide mb-5" id="slider" data-bs-ride="carousel">

        <ol class="carousel-indicators">
            <li class="active" data-bs-target="#slider" data-bs-slide-to="0"></li>
            <li class="" data-bs-target="#slider" data-bs-slide-to="1"></li>
            <li class="" data-bs-target="#slider" data-bs-slide-to="2"></li>
            <li class="" data-bs-target="#slider" data-bs-slide-to="3"></li>
        </ol>

        <div class="carousel-inner">

            <?php
            if ($posts_slider->rowCount() > 0) {
                foreach ($posts_slider as $post_slider) {
                    $post_id = $post_slider['post_id'];
                    $query_post = "SELECT * FROM posts WHERE id = $post_id";

                    $post = $connection->query($query_post)->fetch();
            ?>

                    <div class="carousel-item <?php echo ($post_slider['active']) ? "active" : "" ?>">
                        <img src="./images/posts/<?php echo $post['image'] ?>" alt="" class="d-block w-100">
                        <div class="carousel-caption #d-none d-md-block">
                            <h5><?php echo $post['title'] ?></h5>
                            <p><?php echo substr($post['text'] ,0, 200). "..." ?></p>
                            <a href="single.php?post=<?php echo $post['id'] ?>" class="btn btn-outline-warning text-dark">ادامه مطلب</a>
                        </div>
                    </div>

            <?php
                    }
                }
            ?>

        </div>

    </div>

</section>