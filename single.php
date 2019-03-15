<?php get_header();?>
<div id="site-main" class="site-main my-0 my-sm-4 my-lg-4">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 mb-3 px-0">
                <?php while(have_posts()):the_post();?>
                <?php if(in_category('线路')):?>
                <?php get_template_part( 'single-template/xianlu-single' );?>
                <?php else:?>
                <?php get_template_part( 'single-template/post-single' );?>
                <?php endif;?>
                <?php endwhile;?>
            </div>
            <div class="col-12 col-lg-4 mb-3">
                <?php get_sidebar();?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>