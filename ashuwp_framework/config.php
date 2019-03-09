<?php
// 文章自定义字段
$meta_conf = array(
    'title' => '线路模块',
    'id' => 'cp_xx',
    'page' => array('post'),
    'context' => 'normal',
    'priority' => 'low',
    'tab' => true,
);

$w = array();

$w[] = array(
    'name' => '图片',
    'id' => 'st_open',
    'type' => 'open',
);

$w[] = array(
    'name' => '首图',
    'id' => 'st',
    'type' => 'gallery',
);

$w[] = array(
    'type' => 'close',
);
// 首图选项卡

$w[] = array(
    'name' => '基础信息',
    'id' => 'jc_open',
    'type' => 'open',
);

$w[] = array(
    'name' => '价格',
    'id' => 'price',
    'type' => 'text',
);

$w[] = array(
    'name' => '主标',
    'id' => 'zb',
    'subtype' => array(
        '本站精选' => '本站精选',
    ),
    'type' => 'checkbox',
);

$w[] = array(
    'name' => '标签',
    'id' => 'tag',
    'type' => 'text',
);

$w[] = array(
    'name' => '卖点',
    'id' => 'maidian',
    'type' => 'textarea',
    'desc' => '卖点必须换行，一行一个卖点',
);

$w[] = array(
    'type' => 'close',
);
// 基础信息选项卡

$w[] = array(
    'name' => '详细行程',
    'id' => 'xc_open',
    'type' => 'open',
);

$w[] = array(
    'name' => '行程',
    'id' => 'xc',
    'subtype' => array(
        array(
            'name' => '行程标题',
            'id' => 'title',
            'type' => 'text',
        ),
        array(
            'name' => '行程内容',
            'id' => 'content',
            'type' => 'tinymce',
        ),
        array(
            'name' => '餐',
            'id' => 'can',
            'type' => 'text',
        ),
        array(
            'name' => '住宿',
            'id' => 'zhu',
            'type' => 'text',
        ),
    ),
    'type' => 'group',
    'multiple' => true,
);

$w[] = array(
    'type' => 'close',
);
// 详细行程

$w[] = array(
    'name' => '附加信息',
    'id' => 'fj_open',
    'type' => 'open',
);

$w[] = array(
    'name' => '费用包含',
    'id' => 'baohan',
    'type' => 'textarea',
);

$w[] = array(
    'name' => '费用不包含',
    'id' => 'bubaohan',
    'type' => 'textarea',
);

$w[] = array(
    'name' => '预订须知',
    'id' => 'xuzhi',
    'type' => 'textarea',
);

$w[] = array(
    'id' => 'close',
);
$new_box = new ashuwp_postmeta_feild($w, $meta_conf);

/* ----------文章自定义字段结束---------- */

$page_info = array(
    'full_name' => '网站高级功能设置',
    'optionname' => 'wwh',
    'child' => false,
    'filename' => 'wwh-option',
    'tab' => true,
);

$ashu_options = array();

$ashu_options[] = array(
    'name' => '首页产品模块',
    'id' => 'cp_model_open',
    'type' => 'open',
);

$ashu_options[] = array(
    'name' => '首页巨幕',
    'id' => 'jumu',
    'subtype' => array(
        array(
            'name' => '标题第一行',
            'id' => 'bt1',
            'type' => 'text',
        ),
        array(
            'name' => '标题第二行',
            'id' => 'bt2',
            'type' => 'text',
        ),
        array(
            'name' => '文字介绍',
            'id' => 'desc',
            'type' => 'text',
        ),
        array(
            'name' => '背景图片',
            'id' => 'img',
            'type' => 'upload',
        ),
        array(
            'name' => '按钮本文',
            'id' => 'btn',
            'type' => 'text',
        ),
        array(
            'name' => '按钮链接',
            'id' => 'link',
            'type' => 'text',
        ),
    ),
    'type' => 'group',
);

$ashu_options[] = array(
    'name' => '首页第一个产品模块',
    'id' => 'home_cp_model_1',
    'subtype' => array(
        array(
            'name' => '标题',
            'id' => 'bt',
            'type' => 'text',
        ),
        array(
            'name' => '产品id',
            'id' => 'id',
            'type' => 'text',
            'desc' => '一个id中间打一个空格',
        ),
        array(
            'name' => '底部查看更多文字',
            'id' => 'more',
            'type' => 'text',
        ),
        array(
            'name' => '底部链接',
            'id' => 'link',
            'type' => 'text',
        ),
    ),
    'type' => 'group',
);

$ashu_options[] = array(
    'name' => '首页大图模块',
    'id' => 'home_dt_model',
    'subtype' => array(
        array(
            'name' => '标题',
            'id' => 'bt',
            'type' => 'text',
        ),
        array(
            'name'=>'本文',
            'id'=>'text',
            'type'=>'text'
        ),
        array(
            'name' => '图片',
            'id' => 'img',
            'type' => 'upload',
        ),
        array(
            'name' => '链接',
            'id' => 'link',
            'type' => 'text',
        ),
    ),
    'type' => 'group',
);

$ashu_options[] = array(
    'name' => '首页游记分类ID选择',
    'id' => 'home_yj_id',
    'subtype' => 'category',
    'type' => 'select',
);

$ashu_options[] = array(
    'name' => '首页攻略分类ID选择',
    'id' => 'home_gl_id',
    'subtype' => 'category',
    'type' => 'select',
);

$ashu_options[] = array(
    'name' => '首页问答分类ID选择',
    'id' => 'home_wd_id',
    'subtype' => 'category',
    'type' => 'select',
);

$ashu_options[] = array(
    'type' => 'close',
);

$ashu_options[] = array(
    'name' => '客服',
    'id' => 'cahnggui_open',
    'type' => 'open',
);

$ashu_options[] = array(
    'name' => '客服设置',
    'id' => 'kefu',
    'subtype' => array(
        array(
            'name' => '客服昵称',
            'id' => 'nicheng',
            'type' => 'text',
        ),
        array(
            'name' => '微信号',
            'id' => 'weixin',
            'type' => 'text',
        ),
        array(
            'name' => '手机',
            'id' => 'shouji',
            'type' => 'text',
        ),
        array(
            'name' => '二维码',
            'id' => 'erweima',
            'type' => 'upload',
        ),
    ),
    'type' => 'group',
);

$ashu_options[] = array(
    'type' => 'close',
);

$option_page = new ashuwp_options_feild($ashu_options, $page_info);
/* ----------设置页面自定义字段结束---------- */
