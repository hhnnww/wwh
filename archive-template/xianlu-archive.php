<div id="post-<?php the_ID();?>" class="xianlu col-6 mb-3 mb-lg-4 col-lg-4">

    <?php if(get_post_meta(get_the_ID(),'zb')):?>
    <div class="carousel-tuijian">
        <?php echo get_post_meta(get_the_ID(), 'zb')[0][0];?>
    </div>
    <?php endif;?>
    <div class="img rounded mb-1">
        <a title="<?php the_title();?>" href="<?php the_permalink();?>">
            <img class="img-fluid" src="<?php echo wp_get_attachment_url(get_post_meta(get_the_ID(), 'st')[0][0]);?>?w=800&h=500"
                alt="<?php the_title();?>" />
        </a>
    </div>
    <div class="tag mb-1">
        <?php echo get_post_meta(get_the_ID(),'mudidi')[0];?>
    </div>
    <h2 class="title font-weight-bold mb-1">
    <a title="<?php the_title();?>" href="<?php the_permalink();?>">
        <?php the_title();?>
        </a>
    </h2>
    <div class="jiage">
        <b>￥<?php echo get_post_meta(get_the_ID(), 'price')[0];?></b>
        <span>起/人</span>
    </div>

</div>