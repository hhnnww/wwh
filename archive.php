<?php get_header(); ?>
<div class="site-main" id="site-main">

    <div class="page-header py-3 mb-0 mb-lg-3 border-bottom border-light">

        <div class="container">
            <div class=" row justify-content-start align-items-center">

                <div class="col-12">
                    <h1 class="font-weight-bold mb-0">
                        <?php the_archive_title(); ?>
                    </h1>
                </div>

            </div>
        </div>

    </div>

    <div class="container my-4">
        <div class="row">
            <div class="col-12 col-lg-<?php if (in_category('线路')) {
                    echo '12';
                } else {
                    echo '8';
                } ?> box">
                <div class="row">
                    <?php while (have_posts()): the_post(); ?>
                    <?php if (in_category('线路')): ?>
                    <?php get_template_part('archive-template/xianlu-archive'); ?>
                    <?php else: ?>
                    <?php get_template_part('archive-template/post-archive'); ?>
                    <?php endif; ?>
                    <?php endwhile; ?>

                    <div class="col-12">
                        <div class="page-nav my-2 mb-4 font-weight-normal">
                            <?php the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => '上一页',
                            'next_text' => '下一页',
                        ));
                        ?>
                        </div>
                    </div>

                </div>
            </div>

            <?php if (!in_category('线路')): ?>
            <div class="col-12 col-lg-4 site-sidebar">
                <?php get_sidebar(); ?>
            </div>
            <?php endif; ?>

        </div>

    </div>
</div>


<?php get_footer(); ?>