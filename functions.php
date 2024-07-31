<?php
/**
 * Twenty Fourteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

// Email
/*

REMOVER

*/

add_theme_support( 'responsive-embeds' );

function remove_empty_p( $content ) {
  $content = force_balance_tags( $content );
  $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
  $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
  return $content;
}
add_filter('the_content', 'remove_empty_p', 20, 1);

function _remove_script_version( $src ){
$parts = explode( '?ver', $src );
return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );


//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


function wrap_embed_with_div($html, $url, $attr) {
     return '<div class="video-container">' . $html . '</div>';
}

add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3);


add_filter('show_admin_bar', '__return_false');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

if(function_exists('add_theme_support')){ 
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 150, 150, true );
 /* add_image_size( 'minioficineiro', 150, 150, true);
  add_image_size( 'oficineiro', 500, 500, true); */
}

add_filter(‘jpeg_quality’, function($arg){return 100;});



/*

POST TYPE

*/

add_action( 'init', 'posttype_timeline' );

function posttype_timeline() {
  $labels = array(
    'name'               => _x( 'Linha do tempo', 'post type general name', 'your-plugin-textdomain' ),
    'singular_name'      => _x( 'Evento', 'post type singular name', 'your-plugin-textdomain' ),
    'menu_name'          => _x( 'Timeline', 'admin menu', 'your-plugin-textdomain' ),
    'name_admin_bar'     => _x( 'Timeline', 'add new on admin bar', 'your-plugin-textdomain' ),
    'add_new'            => _x( 'Adicionar Novo', 'atuacao', 'your-plugin-textdomain' ),
    'add_new_item'       => __( 'Adicionar Novo Evento', 'your-plugin-textdomain' ),
    'new_item'           => __( 'Novo Evento', 'your-plugin-textdomain' ),
    'edit_item'          => __( 'Editar Evento', 'your-plugin-textdomain' ),
    'view_item'          => __( 'Ver Evento', 'your-plugin-textdomain' ),
    'all_items'          => __( 'Todos os Eventos', 'your-plugin-textdomain' ),
    'search_items'       => __( 'Procurar Eventos', 'your-plugin-textdomain' ),
    'parent_item_colon'  => __( 'Eventos:', 'your-plugin-textdomain' ),
    'not_found'          => __( 'Nenhum Evento encontrado.', 'your-plugin-textdomain' ),
    'not_found_in_trash' => __( 'Nenhum Evento encontrado no lixo.', 'your-plugin-textdomain' )
  );

  $args = array(
    'labels'             => $labels,
    'menu_icon'   => 'dashicons-backup',
        'description'        => __('Linha do tempo', 'timeline' ),
    'public'             => false,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'timeline' ),
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array('title', 'editor')
  );

  register_post_type('timeline', $args);
}



add_action( 'wp_enqueue_scripts', 'main_lab' );
 
function main_lab() {
 
  // I think jQuery is already included in your theme, check it yourself
  wp_enqueue_script('jquery');
 
  // just register for now, we will enqueue it below
  wp_register_script( 'mainjs', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), false, true);

  // let's pass ajaxurl here, you can do it directly in JavaScript but sometimes it can cause problems, so better is PHP
  wp_localize_script( 'mainjs', 'mainjs_params', array(
    'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', 'templateUrl' => get_stylesheet_directory_uri()
  ) );
 
  wp_enqueue_script( 'mainjs' );
}


/*

CONTATO

*/

function orca($nome, $email, $assunto, $comentarios){
$output = "
Nome: $nome / $email
Assunto: $assunto

$comentarios

Certifique-se de responder este email para $email. 
";

return $output;
} 

add_action( 'wp_ajax_siteWideMessage', 'wpse_sendmail' );
add_action( 'wp_ajax_nopriv_siteWideMessage', 'wpse_sendmail' );


function wpse_sendmail(){


$nome = $_POST['nome'];
$email = $_POST['email'];
$assunto = $_POST['assunto'];
$comentarios = $_POST['msg'];

$secure_check = sanitize_email($email);
if ($secure_check == false) { $response = false; } else {
  
/* EMAIL CÓPIA PARA IDEAÇÃO */
$subject2 = 'Contato de '. $nome .' | Zona de Propulsão';
$message2 = orca($nome, $email, $assunto, $comentarios);

$nomefinal = "Zona de Propulsão";
$emailfinal = "zonapropulsao@gmail.com";
 $sendTo = $emailfinal;
$headers = ""; 
$headers .= 'From: '. $nomefinal .' <'. $emailfinal .'>';
$headers .= 'Reply-to: '. $nome .' <'. $email .'>';


if(wp_mail($emailfinal, $subject2, $message2, $headers)){
    $response = true;
}else{
   $response = false;
}

}

echo json_encode($response);
 wp_die();

}


?>