<?php

// 加微弹出模态框
function modal_jiawei()
{;?>
<div class="modal fade modal-jiawei" id="jiawei" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content py-3">
            <div class="modal-body text-center d-block d-lg-none">
                <div class="item item-1 mb-3">
                    <p class="h5 font-weight-bold">1，长按复制导游微信号。</p>
                    <div class="item-content font-weight-bold">
                        <img width="30px;" class="mr-1" src="<?php echo get_template_directory_uri(); ?>/img/3.svg" />
                        <?php echo get_option('ashuwp_wwh')['kefu']['weixin']; ?>
                    </div>
                </div>
                <div class="item item-2">
                    <p class="h5 font-weight-bold">2，点击打开微信，添加好友。</p>
                    <div class="item-content font-weight-bold">
                        <img width="30px;" class="mr-1" src="<?php echo get_template_directory_uri(); ?>/img/2.svg" /><a
                            href="weixin://">打开微信</a>
                    </div>
                </div>
            </div>
            <div class="modal-body text-center d-none d-lg-block">
                <div class="item">
                    <p class="h5 font-weight-bold">手机扫码，添加导游
                        <?php echo get_option('ashuwp_wwh')['kefu']['nicheng']; ?>微信</p>
                    <div class="item-content-img">
                        <img alt="新疆导游<?php echo get_option('ashuwp_wwh')['kefu']['nicheng']; ?>微信二维码" src="<?php echo get_option('ashuwp_wwh')['kefu']['erweima']; ?>?w=300&h=300" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }

// 线路页幻灯片
function xianlu_hdp()
{;?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators d-none d-lg-flex">
        <?php
$st_list = get_post_meta(get_the_ID(), 'st', )[0];
    $count = count($st_list);
    $x = 1;
    while ($x <= $count) {
        if ($x == 1) {
            $a = 'active';
        } else {
            $a = '';
        }
        echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $x . '" class="' . $a . '"></li>';
        $x++;
    }
    ?>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-tuijian">
        <?php if (get_post_meta(get_the_ID(), 'zb')): ?>
            <?php echo get_post_meta(get_the_ID(), 'zb')[0][0]; ?>
        <?php else: ?>
            限时特惠
        </div>
        <?php endif;?>
        <?php

    $count = 1;
    foreach ($st_list as $i) {;?>
        <?php if ($count == 1) {
        $a = 'active';
    } else {
        $a = '';
    }
        $count++;
        ?>
        <div class="carousel-item <?php echo $a; ?>">
            <img alt="<?php the_title();?>" src="<?php echo wp_get_attachment_url($i); ?>?w=850&h=450" />
        </div>
        <?php }
    ?>
        <div class="carousel-tag">
            <?php echo get_post_meta(get_the_ID(), 'tag')[0]; ?>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<?php }

function entry_meta()
{?>
<div class="entry-meta">
    <span class="data mr-3">
        <?php the_date();?></span>
    <?php if (is_single()): ?>
    <!-- <span class="cate mr-3">分类：<?php the_category(' , ');?></span> -->
    <span class="tag mr-3">标签：
        <?php the_tags('');?></span>
    <?php endif;?>
    <span class="view">
        <?php post_views(' ', ' 浏览');?></span>
</div>
<?php }