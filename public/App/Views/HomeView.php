

    <!--Blog Contents-->
    <section class="blog-container">
            <?php foreach ($posts as $post) : ?>
                <a class="blog-card-link" href="/post?id=<?php echo $post['id'];?>">
                    <article class="blog-card">
                        <header class="blog-card__header">
                            <div class="blog-card__heading">
                                <h2><?= $post['title'] ?></h2>
                                <time datetime="<?php echo date('d/m/Y', strtotime($post['date_publication'])); ?>"><?php echo date('d/m/Y', strtotime($post['date_publication'])); ?></time>
                            </div>
                            <?php if ($isAdmin) { ?>
                                <div class="blog-card__actions">
                                    <a  href="/post/edit?id=<?php echo $post['id'];?>">Edit</a>
                                    <a  href="/post/delete?id=<?php echo $post['id'];?>">Delete</a>
                                </div>
                            <?php } ?>
                        </header>
                        <div class="blog-fake-img">Image</div>
                    </article>
                </a>
            <?php endforeach; ?>
    </section>

    <!--Image Strips-->
    <!-- <div class="blog-card">
        <h3>Popular Post</h3>
        <div class="blog-fake-img">Image</div>
        <br />
        <div class="blog-fake-img">Image</div>
        <br />
        <div class="blog-fake-img">Image</div>
    </div> -->

