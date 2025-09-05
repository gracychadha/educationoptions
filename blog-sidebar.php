<div class="ablog__sidebar mb-50">



    <div class="widget mb-45 wow fadeInUp">
        <h3 class="sidebar__widget--title mb-30">Recent Blogs </h3>
        <?php

        // fetch slider
        $stmtFetch = $db->prepare("SELECT *  FROM blog WHERE  status = 1");
        $stmtFetch->execute();
        $blog = $stmtFetch->get_result()->fetch_all(MYSQLI_ASSOC);
        foreach ($blog as $item) {
            ?>
            <div class="sidebar--widget__post mb-20 pb-20">
                <div class="sidebar__post--thumb">
                    <a href="blog-details?id=<?= htmlspecialchars(base64_encode($item['idblog'])) ?>">
                        <div class="post__img" data-background="admin/<?= $item['image'] ?>"></div>
                    </a>
                </div>
                <div class="sidebar__post--text">
                    <h4 class="sidebar__post--title"><a
                            href="blog-details?id=<?= htmlspecialchars(base64_encode($item['idblog'])) ?>"><?= $item['title'] ?></a>
                    </h4>
                    <span><?= $item['date'] ?></span>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <div class="widget mb-40 wow fadeInUp">
        <h3 class="sidebar__widget--title mb-25">Categories</h3>
        <div class="sidebar--widget__cat mb-20">
            <ul>
                <?php
                // ftech category
                $stmtcategory = $db->prepare("SELECT * FROM blog_category WHERE  status = 1");
                $stmtcategory->execute();
                $categories = $stmtcategory->get_result()->fetch_all(MYSQLI_ASSOC);
                foreach ($categories as $item) {
                    ?>
                    <div class="category list-border-bottom pt-20 pb-20">
                        <li class=""><span><i class="fas fa-arrow-right"></i>
                            </span><?= $item['category_name'] ?></li>
                    </div>


                    <?php
                }
                ?>
            </ul>
        </div>
    </div>

</div>