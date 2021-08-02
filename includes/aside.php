<?php
$query_categories = "SELECT * FROM categories";
$categories = $connection->query($query_categories);
?>


<aside class="aside col-lg-4 col-sm-6">

    <div class="card">
        <form action="search.php"  method="get" id="search" class="card-body">
            <input class="form-control" type="search" name="search" placeholder="جستجو">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div id="categories">
        <div class="list-group">
            <a class="list-group-item active">دسته ها</a>

            <?php
            if ($categories->rowCount() > 0) {
                foreach ($categories as $category) {
            ?>
                    <a class="list-group-item not" href="index.php?category=<?php echo $category["id"] ?>">
                        <?php
                        echo $category['title']
                        ?>
                    </a>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <div id="register" class="card">

        <?php
        if (isset($_POST['register'])) {
            if (trim($_POST['name']) != "" || trim($_POST['email']) != "") {

                $register_query = "INSERT INTO subscribes (name, email) VALUES (:name , :email)";
                $register = $connection->prepare($register_query);

                $name = $_POST['name'];
                $email = $_POST['email'];

                $params = [':name' => $name, ':email' => $email];

                $register->execute($params);
            } else {
                echo "<b>فیلد ها نباید خالی باشند</b>";
            }
        }
        ?>

        <form class="card-body mx-auto" action="" method="post">
            <input class="form-control" type="text" name="name" placeholder="نام">
            <input class="form-control" type="email" name="email" placeholder="ایمیل">
            <button class="btn btn-secondary" type="submit" name="register">ورود</button>
        </form>
    </div>

    <div class="card">
        <div class="card-body">
            <h3 class="card-header">توضیحات اضافه</h3>
            <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه گیرد.</p>
        </div>
    </div>

</aside>

</main>