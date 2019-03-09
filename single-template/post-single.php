<article id="post-<?php the_ID();?>" class="xianlu mt-lg-0">
    <div class="entry box p-3 p-md-4">
        <div class="entry-header pb-3">
            <h1 class="entry-title font-weight-bold mb-2">
                <?php the_title();?>
            </h1>
            <?php entry_meta();?>
        </div>
        <div class="entry-content mt-3">
            <?php the_content();?>
        </div>
    </div>
</article>