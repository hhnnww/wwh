<?php get_header();?>
<div class="site-main mt-0 mt-lg-5">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-12 col-lg-8 mb-3 mb-lg-0 pr-0 pr-lg-4">
                <?php while(have_posts()):the_post();?>
                <?php get_template_part( 'single-template/post-single' );?>
                <?php endwhile;?>
            </div>
            <div class="col-12 col-lg-4">
                <?php get_sidebar();?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>