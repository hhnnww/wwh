<article id="post-<?php the_ID();?>" class="xianlu">

    <header class="entry-header box">
        <div class="img">
            <div class="tuijian">
                限时特惠
            </div>
            <img src="<?php echo get_st();?>?w=850&h=400" width="850" height="400" class="img-fluid" />    
        </div>

        <div class="entry-header-content p-3 p-md-4">
            <h1 class="entry-title font-weight-bold">
                <?php the_title();?>
            </h1>
            <div class="entry-maidian ml-1 mt-3">
                <?php
                $maidian = get_post_meta(get_the_ID(), 'maidian')[0];
                $maidian = explode(PHP_EOL, $maidian);
                foreach ($maidian as $m) {
                    echo '<li class="mb-2">' . $m . '</li>';
                }
                ?>
            </div>

            <div class="xianlu-shuxing mt-3 border-top border-bottom border-light py-3 small">
                <div class="row">

                    <div class="col-4 mb-3">
                        <div class="title text-muted">出发地</div>
                        <div class=""><?php echo get_post_meta(get_the_ID(),'chufadi')[0];?></div>
                    </div>

                    <div class="col-4 mb-3">
                        <div class="title text-muted">目的地</div>
                        <div class=""><?php echo get_post_meta(get_the_ID(),'mudidi')[0];?></div>
                    </div>

                    <div class="col-4 mb-3">
                        <div class="title text-muted">购物</div>
                        <div class=""><?php echo get_post_meta(get_the_ID(),'gouwu')[0];?></div>
                    </div>

                    <div class="col-4">
                        <div class="title text-muted">天数</div>
                        <div class=""><?php echo get_post_meta(get_the_ID(),'tianshu')[0];?></div>
                    </div>

                    <div class="col-4">
                        <div class="title text-muted">玩法</div>
                        <div class=""><?php echo get_post_meta(get_the_ID(),'wanfa')[0];?></div>
                    </div>

                    <div class="col-4">
                        <div class="title text-muted">交通</div>
                        <div class=""><?php echo get_post_meta(get_the_ID(),'jiaotong')[0];?></div>
                    </div>
                    


                    
                </div>
            </div>

        </div>
    </header>

    <?php if (!empty(get_the_content())): ?>
    <div class="entry-content mt-3 p-3 p-md-4 box">
        <div class="entry-content-header pb-2 box-header">
            <h3 class="font-weight-bold">产品详情</h3>
        </div>
        <div class="entry-content-content mt-3">
            <?php the_content();?>
        </div>
    </div>
    <?php endif;?>
    
    <?php if (get_post_meta(get_the_ID(), 'xc')): ?>
    <div class="entry-xc">
        <?php
        $xc_list = get_post_meta(get_the_ID(), 'xc')[0];
        $count = 1;
        foreach ($xc_list as $x) {
            echo '<div class="box entry-xc-item mt-3 p-3 p-md-4">';
            if ($count == 1) {
                echo '<div class="box-header pb-2 mb-3"><h3 class="font-weight-bold">行程详情</h3></div>';
            }
            echo '<div class="entry-xc-title mb-3 font-weight-bold"><span>D' . $count . '</span>' . $x['title'] . '</div>';
            $content = str_replace(PHP_EOL, '<br />', $x['content']);
            echo '<div class="entry-xc-content pb-3">' . $content . '<div class="line"></div></div>';
            echo '<div class="entry-xc-can pb-3">' . $x['can'] . '<div class="line"></div></div>';
            echo '<div class="entry-xc-zhu">' . $x['zhu'] . '</div>';
            echo '</div>';
            $count++;
        }
        ?>
    </div>
    <?php endif;?>

    <?php if (get_post_meta(get_the_ID(), 'baohan')): ?>
    <div class="entry-xuzhi box p-3 p-md-4 mt-3">
        <div class="box-header mb-3 pb-2">
            <h3 class="font-weight-bold">费用包含</h3>
        </div>
        <div class="entry-xuzhi-content">
            <?php
            $xuzhi = get_post_meta(get_the_ID(), 'baohan')[0];
            $xuzhi = str_replace(PHP_EOL, '<br />', $xuzhi);
            echo $xuzhi;
            ?>
        </div>
    </div>
    <?php endif;?>

    <?php if (get_post_meta(get_the_ID(), 'bubaohan')): ?>
    <div class="entry-xuzhi box p-3 p-md-4 mt-3">
        <div class="box-header mb-3 pb-2">
            <h3 class="font-weight-bold">费用不包含</h3>
        </div>
        <div class="entry-xuzhi-content">
            <?php
            $xuzhi = get_post_meta(get_the_ID(), 'bubaohan')[0];
            $xuzhi = str_replace(PHP_EOL, '<br />', $xuzhi);
            echo $xuzhi;
            ?>
        </div>
    </div>
    <?php endif;?>

    <?php if (get_post_meta(get_the_ID(), 'zifei')): ?>
    <div class="entry-xuzhi box p-3 p-md-4 mt-3">
        <div class="box-header mb-3 pb-2">
            <h3 class="font-weight-bold">自费项目</h3>
        </div>
        <div class="entry-xuzhi-content">
            <?php
            $xuzhi = get_post_meta(get_the_ID(), 'zifei')[0];
            $xuzhi = str_replace(PHP_EOL, '<br />', $xuzhi);
            echo $xuzhi;
            ?>
            <div class="text-muted small mt-3">
                *所有自费项目自愿参加，如有强制消费，按消费金额1比10进行赔偿
            </div>
        </div>
    </div>
    <?php endif;?>

    <?php if (get_post_meta(get_the_ID(), 'xuzhi')): ?>
    <div class="entry-xuzhi box p-3 p-md-4 mt-3">
        <div class="box-header mb-3 pb-2">
            <h3 class="font-weight-bold">预订须知</h3>
        </div>
        <div class="entry-xuzhi-content">
            <?php
            $xuzhi = get_post_meta(get_the_ID(), 'xuzhi')[0];
            $xuzhi = str_replace(PHP_EOL, '<br />', $xuzhi);
            echo $xuzhi;
            ?>
        </div>
    </div>
    <?php endif;?>
</article>