<?php

add_action('admin_menu','woopl_register_menus');

function woopl_register_menus(){
    add_menu_page(
        'fiter woo-words',
        'fiter woo-words',
        'manage_options',
        'woopl',
        'woopl_settings',
    );
    add_submenu_page(
        'woopl',
        'setting',
        'setting',
        'manage_options',
        'woopls',
        'woopl_sub_settings',
    );
}

function woopl_settings(){
   echo '<h1>insert words and links you wish to linkable on wp products cotent as -> </br></br> wordpress=wprdpress.com|woocommerce=woocommerce.com</h1>';
}
function woopl_sub_settings(){
    if(isset($_POST['btn-submit'])){
        $str = $_POST['filter-words'];
//        $utf8_decode_str = utf8_encode_deep($str);
        $array  = explode('|', $str );
//            echo '<pre>';
//            var_dump($array);
//            echo '</pre>';
//            exit;
        $final_array = [];
        foreach ($array as $value){
            $tmp = explode('=',$value);
            $final_array[$tmp[0]] = $tmp[1];

        }


        if (!get_option('_wl_word')) {
            add_option('_wl_word',$final_array);
        } else {
            update_option('_wl_word',$final_array);

        }
    }
   include  WOOPL_PLUGIN_VIEW . 'admin/settings.php';
}