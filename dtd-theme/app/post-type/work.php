<?php

function register_work_post_type() {

    $labels = array(
        'name'               => __('新一代'),
        'singular_name'      => __('新一代'),
        'add_new'            => __('新增作品'),
        'add_new_item'       => __('新建作品'),
        'edit_item'          => __('編輯文章'),
        'new_item'           => __('新文章'),
        'all_items'          => __('所有作品'),
        'view_item'          => __('觀看文章'),
        'search_items'       => __('搜尋文章'),
        'not_found'          => __('找不到相關文章'),
        'not_found_in_trash' => __('垃圾桶裡無此文章'),
        'parent_item_colon'  => '',
        'menu_name'          => '新一代',
    );

    $args = array(
        'labels'        => $labels,
        'description'   => '網站中的作品',
        'taxonomies'    => array('work_type'),
        'public'        => true,
        'menu_position' => 2,
        'has_archive'   => true,
        'rewrite'       => array('slug' => 'works', 'with_front' => false),
        'supports'      => array('title', 'editor', 'thumbnail')
    );
    
    register_post_type( 'work', $args ); //post type name
}

add_action( 'init', 'register_work_post_type' );

function work_taxonomies() {
    $labels = [
        'name'              => __('作品分類'),
        'singular_name'     => __('作品分類'),
        'search_items'      => __('搜尋作品'),
        'all_items'         => __('所有作品'),
        'parent_item'       => __('該作品的上層分類'),
        'parent_item_colon' => __('該作品的上層分類：'),
        'edit_item'         => __('編輯作品分類'),
        'update_item'       => __('更新作品分類'),
        'add_new_item'      => __('新增分類'),
        'new_item_name'     => __('新作品'),
        'menu_name'         => __('作品分類'),
    ];

    $args = [
        'labels' => $labels,
        'show_admin_column' => true,
        'hierarchical' => true
    ];

    register_taxonomy( 'work_type', 'work', $args );
}
add_action( 'init', 'work_taxonomies', 0 );


/** 將 custom post type 註冊至index page主循環 **/


// function add_work_post_types_to_query( $query ) {
//   if ( is_home() && $query->is_main_query() )
//     $query->set( 'post_type', array( 'work' ) );
//   return $query;
// }
// add_action( 'pre_get_posts', 'add_work_post_types_to_query' );
