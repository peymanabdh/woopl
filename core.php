<?php
/*
Plugin Name:  woopl
Plugin URI: https://www.linkedin.com/in/peyman-rahmani/
Description: woocommerce product words linkable
Author: peyman rahmani
Version: 1.0.0
License: GPLv2 or later
Author URI: https://www.linkedin.com/in/peyman-rahmani/
*/
defined('ABSPATH') || exit;
define('WOOPL_PLUGIN_DIR',plugin_dir_path(__FILE__));
define('WOOPL_PLUGIN_URL',plugin_dir_url(__FILE__));

const WOOPL_PLUGIN_INC =WOOPL_PLUGIN_DIR.'/_inc/';
const WOOPL_PLUGIN_ASSETS =WOOPL_PLUGIN_DIR.'/assets/';
const WOOPL_PLUGIN_VIEW =WOOPL_PLUGIN_DIR.'/view/';
//echo '<pre>';
//var_dump(get_option('_wl_word'));
//echo '</pre>';
//exit;

function convert_word_to_link($content){
    global $post;
    if ($post->post_type == 'product') {
        //$words = ['wordpress'=>'وردپرس','php'=>'php'];
        $words = get_option('_wl_word');
        var_dump($words);
        $cat = 'category';
        /*foreach ($words as $word){
            $replace =  '<a href="http://develop-wp.local/'. $cat .'/'. $word .' ">'. $word .'</a>';
            $content = str_replace($word,$replace,$content);
        }*/
        foreach ($words as $key=>$value){
//        $replace =  '<a href="http://develop-wp.local/'. $cat .'/'. $key .' ">'. $value .'</a>';
            $replace =  '<a href="'.$value .'">'. $key .'</a>';
            $content = str_replace($key,$replace,$content);
        }
    }
    return $content;
//    $words = ['وردپرس','php'];

}
add_filter('the_content','convert_word_to_link');

if (is_admin()){
    include WOOPL_PLUGIN_INC.'/admin/menus.php';
}else{
    include WOOPL_PLUGIN_INC.'/front/form.php';
}


