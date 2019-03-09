<article id="post-<?php the_ID();?>" class="post mb-4 col-12">
    <div class="row">
        <div class="col-lg-3 entry-img d-none d-lg-block">
            <?php 
            $st = get_post_meta(get_the_id(),'st')[0][0];
            if($st){
                echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">';
                echo '<img class="img-fluid" alt="'.get_the_title().'" src="'.wp_get_attachment_url($st).'?w=250&h=160" /></a>';
            }else{
                echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">';
                echo '<img src="'.get_template_directory_uri().'/img/404.jpg?w=200&h=150" /></a>';
            }
            ?>
        </div>

        <div class="col-12 col-lg-9 position-relative entry-box">

            <h2 class="entry-title text-nowrap text-truncate mb-1 mb-lg-2 font-weight-bold">
                <a href="<?php the_permalink();?>" title="<?php the_title();?>">
                    <?php the_title();?>
                </a>
            </h2>

            <div class="entry-content">
                <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 130,"..."); ?>
            </div>

            <div class="entry-meta mt-2 d-flex justify-content-between">
                <span class="data">
                    <?php echo get_the_date();?>
                </span>
                <span class="view">
                    <?php post_views('',' 浏览');?>
                </span>
            </div>

        </div>

    </div>
</article>