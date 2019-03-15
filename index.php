<?php get_header();?>

<?php 
    $wwh = get_option('ashuwp_wwh')['jumu'];
    $jumu_bg = $wwh['img'];
    $bt1 = $wwh['bt1'];
    $bt2 = $wwh['bt2'];
    $p = $wwh['desc'];
    $btn = $wwh['btn'];
    $link = $wwh['link'];
?>
<!-- 巨幕模块 -->
<div class="jumbotron jumbotron-fluid" style="background:url(<?php echo $jumu_bg; ?>?w=1900&h=800) no-repeat center center;background-size:cover;">
    <div class="container">

        <h1 class="font-weight-bold">
            <?php echo $bt1; ?>
            <br />
            <?php echo $bt2; ?>
        </h1>

        <p>
            <?php echo $p; ?>
        </p>

        <div class="jum-btn">
            <a class="btn-wwh hvr-sweep-to-right" href="#" data-toggle="modal" data-target="#jiawei">
                <?php echo $btn; ?></a>
        </div>

    </div>
</div>


<!-- 吹牛模块 -->
<div class="home-maidian py-3 py-lg-3 border-bottom border-light">
    <div class="container">
        <div class="row">
            <div class="col-4 d-flex align-items-center">
                <div class="img">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/15.svg" />
                </div>
                <div class="pl-2">
                    <div class="title font-weight-bold">
                        价格保护
                    </div>
                    <div class="desc d-none d-lg-block">
                        全产品价格保护，未出行结束若有产品价格调整，全额退差价。
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center">
                <div class="img">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/16.svg" />
                </div>
                <div class="pl-2">
                    <div class="title font-weight-bold">
                        金牌服务
                    </div>
                    <div class="desc d-none d-lg-block">
                        全产品免费提供专业线上导游，带团8年以上线下导游服务。
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center">
                <div class="img">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/17.svg" />
                </div>
                <div class="pl-2">
                    <div class="title font-weight-bold">
                        无忧售后
                    </div>
                    <div class="desc d-none d-lg-block">
                        24H*7应急响应处理，提前或中途退团，不扣除任何未产生费用，全额退款。
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 产品模块 -->
<?php $home_cp_list = get_option('ashuwp_wwh')['home_cp_model_1'];?>
<div class="home-cp-box mt-3 mt-lg-5 home-cp-cp-box border-bottom border-light pb-3 pb-lg-5">
    <div class="container px-2">
        <!-- 标题 -->
        <div class="row mx-0">
            <div class="col px-1 mx-0">
                <h3 class="font-weight-bold mb-3">
                    <?php echo $home_cp_list['bt']; ?>
                </h3>
            </div>
        </div>
        <div class="row home-cp-content no-gutters">
            <!-- 循环内 -->
            <?php
            $cp_list = explode(' ', $home_cp_list['id']);
            foreach ($cp_list as $c) {
                echo '<div class="col-12 col-mb-6 mb-3 mb-lg-4 col-lg-4 home-cp-item">';
                $the_query = new WP_Query(array('p' => $c));
                $the_query->the_post();
                $img = get_post_meta(get_the_ID(), 'st')[0][0];
                $img = wp_get_attachment_url($img);
                echo '<a title="' . get_the_title() . '" target="_blank" href="' . get_the_permalink() . '">';
                echo '<div class="img mb-2">';
                if (get_post_meta(get_the_ID(), 'zb')) {
                    echo '<div class="tuijian">' . get_post_meta(get_the_ID(), 'zb')[0][0] . '</div>';
                }
                echo '<img alt="'.get_the_title().'" class="img-fluid" src="' . $img . '?w=800&h=450" />';
                echo '<div class="tag">' . get_post_meta(get_the_ID(), 'tianshu')[0] . '</div>';
                echo '</div>';
                echo '<div class="small text-muted">'.get_post_meta(get_the_ID(),'mudidi')[0].'</div>';
                echo '<div class="title font-weight-bold mb-1">' . get_the_title() . '</div>';
                echo '<div class="jiage"><b class="mr-1">￥' . get_post_meta(get_the_ID(), 'price')[0] . '</b><span>起/人</span></div>';
                wp_reset_query();
                echo '</a>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="row pl-1">
            <div class="col">
                <h4 class="font-weight-bold"><a class="btn-wwh hvr-sweep-to-right" href="<?php echo $home_cp_list['link']; ?>">
                        <?php echo $home_cp_list['more']; ?></a></h4>
            </div>
        </div>

    </div>
</div>

<!-- 包车模块 -->
<?php $home_dt_model = get_option('ashuwp_wwh')['home_dt_model'];?>
<div class="home-cp-box home-dt-model mt-3 mt-lg-5 border-bottom border-light pb-3 pb-lg-5">
    <div class="container">
        <div class="row mb-2">
            <div class="col">
                <h3 class="font-weight-bold">
                    轻奢包车定制游
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="jumbotron jumbotron-fluid pl-5" style="background:url(<?php echo $home_dt_model['img']; ?>?w=1500&h=600) no-repeat center center;background-size:cover;">
                    <h1 class="display-3 font-weight-bold"><?php echo $home_dt_model['bt'];?></h1>
                    <p class="lead font-weight-bold"><?php echo $home_dt_model['text'];?></p>
                    <a href="<?php echo $home_dt_model['link'];?>" class="btn-wwh hvr-sweep-to-right" data-toggle="modal" data-target="#jiawei">开始定制</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 
    wp_query的用法

    $args = array();
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            /*** 内容 ***/
        }
    }
    wp_reset_query();
 -->

<!-- 
    首页获取模块分类ID
    游记:home_yj_id
    攻略:home_gl_id
    问答:home_wd_id
  -->


<!-- 首页游记模块 -->
<?php 
$yj_id = get_option('ashuwp_wwh')['home_yj_id'];
$wd_id = get_option('ashuwp_wwh')['home_wd_id'];
$gl_id = get_option('ashuwp_wwh')['home_gl_id'];
?>

<div class="home-yj-model home-model mt-3 mt-lg-5 border-bottom border-light pb-3 pb-lg-5">
    <div class="container">

        <div class="row mb-3 home-model-header">
            <div class="col px-1">
                <h3 class="home-title font-weight-bold">新疆游记</h3>
            </div>
        </div>

        <div class="row mb-3 home-model-content">
            <?php 
            $the_query = new WP_Query(array('cat'=>$yj_id,'posts_per_page'=>8));
            while($the_query->have_posts()){
                $the_query->the_post();?>
                <div class="col-6 col-lg-3 mb-3 home-model-item">
                    <a title="<?php the_title();?>" target="_blank" href="<?php the_permalink();?>">
                        <div class="img rounded position-relative mb-2">
                            <img alt="<?php echo get_the_title();?>" src="<?php echo st();?>?w=800&h=480" />
                            <div class="view position-absolute rounded font-weight-bold"><?php echo post_views('',' 浏览');?></div>
                        </div>
                        <div class="meta small text-muted font-weight-bold">
                            <span class="date"><?php echo get_the_date();?></span>
                        </div>
                        <div class="title mb-1 font-weight-bold"><?php the_title();?></div>
                        <div class="content small text-muted"><?php echo ex('60');?></div>
                        
                    </a>
                </div>
            <?php } wp_reset_query()?>
        </div>
        
        <div class="row more home-model-foter">
            <div class="col px-1">
                <a href="<?php echo get_category_link($yj_id);?>" title="查看更多游记" class="btn-wwh hvr-sweep-to-right">查看更多游记</a>
            </div>
        </div>

    </div>
</div>


<div class="home-yj-model home-model mt-3 mt-lg-5 border-bottom border-light pb-3 pb-lg-5">
    <div class="container">

        <div class="row mb-3 home-model-header">
            <div class="col px-1">
                <h3 class="home-title font-weight-bold">新疆旅游攻略</h3>
            </div>
        </div>

        <div class="row mb-3 home-model-content">
            <?php 
            $the_query = new WP_Query(array('cat'=>$gl_id,'posts_per_page'=>8));
            while($the_query->have_posts()){
                $the_query->the_post();?>
                <div class="col-6 col-lg-3 mb-3 home-model-item">
                    <a title="<?php the_title();?>" target="_blank" href="<?php the_permalink();?>">
                        <div class="img rounded position-relative mb-2">
                            <img alt="<?php the_title();?>" src="<?php echo st();?>?w=800&h=480" />
                            <div class="view position-absolute rounded font-weight-bold"><?php echo post_views('',' 浏览');?></div>
                        </div>
                        <div class="meta small text-muted font-weight-bold">
                            <span class="date"><?php echo get_the_date();?></span>
                        </div>
                        <div class="title mb-1 font-weight-bold"><?php the_title();?></div>
                        <div class="content small text-muted"><?php echo ex('60');?></div>
                        
                    </a>
                </div>
            <?php } wp_reset_query()?>
        </div>
        
        <div class="row more home-model-foter">
            <div class="col px-1">
                <a href="<?php echo get_category_link($gl_id);?>" class="btn-wwh hvr-sweep-to-right" title="查看更多攻略">查看更多攻略</a>
            </div>
        </div>

    </div>
</div>

<!-- 首页问答和攻略模块 -->
<div class="home-model home-wd-model mt-3 mt-lg-5 pb-3 pb-lg-5">
    <div class="container">
        
    <div class="row mb-3 home-model-header">
            <div class="col">
                <h3 class="home-title font-weight-bold">新疆旅游问答</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <?php 
                $the_query = new WP_Query(array('cat'=>$wd_id,'posts_per_page'=>10));
                while($the_query->have_posts()){
                    $the_query->the_post();?>
                    <div class="home-model-item row pb-2 mb-2 mb-lg-3 pb-lg-3 no-gutters border-bottom border-light">

                        <div class="img rounded col-3 d-none d-md-block">
                            <a target="_blank" title="<?php the_title();?>" href="<?php the_permalink();?>">
                                <img alt="<?php the_title();?>" src="<?php echo st();?>?w=500&h=350" />
                            </a>
                        </div>

                        <div class="col-12 pl-0 pl-md-3 col-md-9">
                            <div class="date small font-weight-normal "><?php echo get_the_date();?></div>
                            <div class="title font-weight-bold mb-0 mb-xl-2">
                                <a target="_blank" title="<?php the_title();?>" href="<?php the_permalink();?>">
                                    <?php the_title();?>
                                </a>
                            </div>

                            <div class="content mb-2 small text-muted d-none d-md-block"><?php echo ex('180');?></div>
                            <div class="meta small d-none d-md-flex">                                
                                <div class="cate"><?php the_category();?></div>
                                <div class="tag"><?php the_tags('',',','');?></div>
                                <div class="view"><?php post_views('',' 浏览');?></div>
                            </div>
                        </div>

                    </div>
                <?php }?>
            </div>
            
            <div class="col-12 col-lg-4">
                <?php get_sidebar();?>
            </div>

        </div>
    </div>
</div>


<?php get_footer();?>