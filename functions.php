<?php

require get_template_directory() . '/ashuwp_framework/ashuwp_framework_core.php';
require get_template_directory() . '/ashuwp_framework/config.php';
require get_template_directory() . '/inc/dis.php';
require get_template_directory() . '/inc/functions-tag.php';
require get_template_directory() . '/inc/wp_baidu_submit.php';

function wwh_setup()
{
    add_theme_support('title-tag');

    register_nav_menus(array(
        'primary' => __('首页顶部菜单', 'twentysixteen'),
    ));
}
add_action('after_setup_theme', 'wwh_setup');

function wwh_scripts()
{
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/bootcss/css/bootstrap.min.css');
    wp_enqueue_style('wwh-style', get_stylesheet_uri());
    wp_enqueue_script('jqu', get_template_directory_uri() . '/bootcss/jquery-3.3.1.slim.min.js');
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/bootcss/js/bootstrap.min.js');
    wp_enqueue_script('pin', get_template_directory_uri() . '/bootcss/jquery.pin.min.js');
}
add_action('wp_enqueue_scripts', 'wwh_scripts');

// 添加文章的浏览次数统计功能
function record_visitors()
{
    if (is_singular()) {
        global $post;
        $post_ID = $post->ID;
        if ($post_ID) {
            $post_views = (int) get_post_meta($post_ID, 'views', true);
            if (!update_post_meta($post_ID, 'views', ($post_views + 1))) {
                add_post_meta($post_ID, 'views', 1, true);
            }
        }
    }
}
add_action('wp_head', 'record_visitors');

// 浏览次数统计输出
function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
    global $post;
    $post_ID = $post->ID;
    $views = (int) get_post_meta($post_ID, 'views', true);
    if ($echo) {
        echo $before, number_format($views), $after;
    } else {
        return $views;
    }

}

// 前端替换图片的class值
function content_str_replace($content = '')
{
    if (in_category('线路')) {
        $content = preg_replace('/\.(jpg|png)/', '.$1?w=800', $content);
    } else {
        $content = preg_replace('/\.(jpg|png)/', '.$1?w=600', $content);
    }
    // 替换图片的class值
    $content = str_replace('<img', '<img class="img-fluid" ', $content);

    return $content;
}
add_filter('the_content', 'content_str_replace', 10);

//保存日志时清除高度与宽度
function wcc_replace_yupoo_url($post_id)
{
    global $post_type;
    if ($post_type == 'post') {
        if (wp_is_post_revision($post_id)) {
            return false;
        }

        remove_action('save_post', 'wcc_replace_yupoo_url');
        $content = get_post($post_id)->post_content;
        $content = preg_replace('/alt=""(.*?)<figcaption>(.*?)<\/figcaption>/', 'alt="$2"$1<figcaption>$2</figcaption>', $content);

        //保存日志时执行操作
        wp_update_post(array('ID' => $post_id, 'post_content' => $content));
        add_action('save_post', 'wcc_replace_yupoo_url');
    }
}
add_action('save_post', 'wcc_replace_yupoo_url', 10, 2);

// 第一张首图
function get_st()
{
    if (get_post_meta(get_the_ID(), 'st')[0][0]) {
        return wp_get_attachment_url(get_post_meta(get_the_ID(), 'st')[0][0]);
    } else {
        return get_template_directory_uri() . '/img/404.jpg';
    }
}

// 本文裁剪
function ex($width)
{
    return mb_strimwidth(strip_tags(apply_filters('the_content', get_the_content())), 0, $width, "...");
}

// 加载订单页面
function register_custom_menu_page()
{
    add_menu_page('订单', '订单', 'administrator', 'dingdan', 'dingdan', '', 2);
}
add_action('admin_menu', 'register_custom_menu_page');

function dingdan()
{
    include get_template_directory() . '/dingdan.php';
}

// 返回文章字段
function get_field($meta)
{
    return get_post_meta(get_the_ID(), $meta);
}