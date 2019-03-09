<article id="post-<?php the_ID();?>" class="xianlu">

    <header class="entry-header box">
        <?php xianlu_hdp();?>

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
    <div class="entry-fy box p-3 p-md-4 mt-3">
        <div class="box-header mb-4 pb-2">
            <h3 class="font-weight-bold">
                费用说明
            </h3>
        </div>
        <div class="entry-fy-content box-content">
            <div class="row">
                <div class="col-12 mb-3">
                    <h4 class="font-weight-bold mb-3">费用包含</h4>
                    <div class="entry-fy-content-item">
                        <?php
                        $baohan = get_post_meta(get_the_ID(), 'baohan');
                        $baohan = str_replace(PHP_EOL, '<br />', $baohan[0]);
                        echo $baohan;
                        ?>
                    </div>
                </div>
                <div class="col-12">
                    <h4 class="font-weight-bold mb-3">费用不包含</h4>
                    <div class="entry-fy-content-item">
                        <?php
                        $bubaohan = get_post_meta(get_the_ID(), 'bubaohan');
                        $bubaohan = str_replace(PHP_EOL, '<br />', $bubaohan[0]);
                        echo $bubaohan;
                        ?>
                    </div>
                </div>
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
            $xuzhi = get_post_meta(get_the_ID(), 'xuzhi', )[0];
            $xuzhi = str_replace(PHP_EOL, '<br />', $xuzhi);
            echo $xuzhi;
            ?>
        </div>
    </div>
    <?php endif;?>
</article>