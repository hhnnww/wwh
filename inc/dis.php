<?php
function disable_embeds_init() {
/* @var WP $wp */
global $wp;
// Remove the embed query var.
$wp->public_query_vars = array_diff( $wp->public_query_vars, array(
'embed',
) );
// Remove the REST API endpoint.
remove_action( 'rest_api_init', 'wp_oembed_register_route' );
// Turn off
add_filter( 'embed_oembed_discover', '__return_false' );
// Don't filter oEmbed results.
remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
// Remove oEmbed discovery links.
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
// Remove oEmbed-specific JavaScript from the front-end and back-end.
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
// Remove all embeds rewrite rules.
add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
}
 
add_action( 'init', 'disable_embeds_init', 9999 );
 
/**
* Removes the 'wpembed' TinyMCE plugin.
*
* @since 1.0.0
*
* @param array $plugins List of TinyMCE plugins.
* @return array The modified list.
*/
function disable_embeds_tiny_mce_plugin( $plugins ) {
return array_diff( $plugins, array( 'wpembed' ) );
}
 
/**
* Remove all rewrite rules related to embeds.
*
* @since 1.2.0
*
* @param array $rules WordPress rewrite rules.
* @return array Rewrite rules without embeds rules.
*/
function disable_embeds_rewrites( $rules ) {
foreach ( $rules as $rule => $rewrite ) {
if ( false !== strpos( $rewrite, 'embed=true' ) ) {
unset( $rules[ $rule ] );
}
}
return $rules;
}
 
/**
* Remove embeds rewrite rules on plugin activation.
*
* @since 1.2.0
*/
function disable_embeds_remove_rewrite_rules() {
add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
flush_rewrite_rules();
}
 
register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );
 
/**
* Flush rewrite rules on plugin deactivation.
*
* @since 1.2.0
*/
function disable_embeds_flush_rewrite_rules() {
remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
flush_rewrite_rules();
}
 
register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );

// 移除多余的head代码
// add_filter( 'show_admin_bar', '__return_false' ); //移除adminbar

remove_action('wp_head', 'rest_output_link_wp_head', 10 ); // 移除json
remove_action('template_redirect', 'rest_output_link_header', 11 ); // 移除json

remove_action('wp_head','rsd_link'); // 移除head中的rel="EditURI" 
remove_action('wp_head','wlwmanifest_link'); // 移除head中的rel="wlwmanifest" 

remove_action('wp_head', 'print_emoji_detection_script', 7); // 移除emoji
remove_action('wp_print_styles', 'print_emoji_styles'); // 移除emoji

remove_action( 'wp_head', 'wp_resource_hints', 2 ); // 移除dns

remove_action( 'wp_head', 'wp_generator'); // 移除wordpress版本信息

add_action( 'wp_enqueue_scripts', 'fanly_remove_block_library_css', 100 );
function fanly_remove_block_library_css() {
	wp_dequeue_style( 'wp-block-library' );
}

// 移除文章编辑界面默认的Meta模块
function remove_my_post_metaboxes() {
	remove_meta_box( 'authordiv','post','normal' ); // 作者模块
	remove_meta_box( 'commentstatusdiv','post','normal' ); // 评论状态模块
	remove_meta_box( 'commentsdiv','post','normal' ); // 评论模块
	remove_meta_box( 'postcustom','post','normal' ); // 自定义字段模块
	remove_meta_box( 'postexcerpt','post','normal' ); // 摘要模块
	remove_meta_box( 'revisionsdiv','post','normal' ); // 修订版本模块
	remove_meta_box( 'slugdiv','post','normal' ); // 别名模块
	remove_meta_box( 'trackbacksdiv','post','normal' ); // 引用模块
	 
	//remove_meta_box( 'categorydiv','post','normal' ); // 分类模块
	remove_meta_box( 'formatdiv','post','normal' ); // 文章格式模块
	//remove_meta_box( 'submitdiv','post','normal' ); // 发布模块
	//remove_meta_box( 'tagsdiv-post_tag','post','normal' ); // 标签模块
	}
	add_action('admin_menu','remove_my_post_metaboxes');
	 
	//移除特色图像模块
	add_action('do_meta_boxes', 'remove_thumbnail_box');
	function remove_thumbnail_box() {
		remove_meta_box( 'postimagediv','post','side' );
	}

	function disable_srcset( $sources ) {
		return false;
		}
		add_filter( 'wp_calculate_image_srcset', 'disable_srcset' );