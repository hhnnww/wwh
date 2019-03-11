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