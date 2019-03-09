<?php

require get_template_directory() . '/ashuwp_framework/ashuwp_framework_core.php';
require get_template_directory() . '/ashuwp_framework/config.php';
require get_template_directory() . '/inc/dis.php';
require get_template_directory() . '/inc/functions-tag.php';

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

function content_str_replace($content = '')
{
    $content = str_replace('jpg', 'jpg?w=600', $content);
    $content = str_replace('<img', '<img class="img-fluid" ', $content);
    return $content;
}
add_filter('the_content', 'content_str_replace', 10);

function remove_width_attribute($html)
{
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}
add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
add_filter('image_send_to_editor', 'remove_width_attribute', 10);

function add_new_posts_columns($book_columns)
{
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['id'] = __('ID');
    $new_columns['title'] = _x('Title', 'column name');
    // $new_columns['author'] = __('Author');
    $new_columns['categories'] = __('Categories');
    $new_columns['tags'] = __('Tags');
    $new_columns['date'] = _x('Date', 'column name');
    return $new_columns;
}
add_filter('manage_posts_columns', 'add_new_posts_columns');

function manage_posts_columns($column_name, $id)
{
    global $wpdb;
    switch ($column_name) {
        case 'id':
            echo $id;
            break;
        default:
            break;
    }
}
add_action('manage_posts_custom_column', 'manage_posts_columns', 10, 2);

function add_new_pages_columns($book_columns)
{

    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['id'] = __('ID');
    $new_columns['title'] = _x('Title', 'column name');
    $new_columns['author'] = __('Author');
    $new_columns['date'] = _x('Date', 'column name');
    return $new_columns;
}
add_filter('manage_pages_columns', 'add_new_pages_columns');

function manage_pages_columns($column_name, $id)
{
    global $wpdb;
    switch ($column_name) {
        case 'id':
            echo $id;
            break;
        default:
            break;
    }
}
add_action('manage_pages_custom_column', 'manage_pages_columns', 10, 2);

// 第一张首图
function st()
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


// 订单页面 
function register_custom_menu_page()
{
    add_menu_page('订单', '订单', 'administrator', 'dingdan', 'dingdan', '', 2);
}
add_action('admin_menu', 'register_custom_menu_page');

function dingdan(){
    include get_template_directory() . '/dingdan.php';
}