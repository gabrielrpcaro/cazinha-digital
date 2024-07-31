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

/**
 * Set up the content width value based on the theme's design.
 *
 * @see twentyfourteen_content_width()
 *
 * @since Twenty Fourteen 1.0
 */

/**
* Returns ID of top-level parent category, or current category if you are viewing a top-level
*
* @param  string    $catid    Category ID to be checked
* @return   string    $catParent  ID of top-level parent category
*/


add_action( 'init', 'posttype_lugar' );

function posttype_lugar() {
  $labels = array(
    'name'               => _x( 'Lugares', 'post type general name', 'your-plugin-textdomain' ),
    'singular_name'      => _x( 'Lugar', 'post type singular name', 'your-plugin-textdomain' ),
    'menu_name'          => _x( 'Lugares', 'admin menu', 'your-plugin-textdomain' ),
    'name_admin_bar'     => _x( 'Lugar', 'add new on admin bar', 'your-plugin-textdomain' ),
    'add_new'            => _x( 'Adicionar Novo', 'atuacao', 'your-plugin-textdomain' ),
    'add_new_item'       => __( 'Adicionar Novo Lugar', 'your-plugin-textdomain' ),
    'new_item'           => __( 'Novo Lugar', 'your-plugin-textdomain' ),
    'edit_item'          => __( 'Editar Lugar', 'your-plugin-textdomain' ),
    'view_item'          => __( 'Ver Lugar', 'your-plugin-textdomain' ),
    'all_items'          => __( 'Todos os Lugares', 'your-plugin-textdomain' ),
    'search_items'       => __( 'Procurar Lugar', 'your-plugin-textdomain' ),
    'parent_item_colon'  => __( 'Lugares:', 'your-plugin-textdomain' ),
    'not_found'          => __( 'Nenhum Lugar encontrado.', 'your-plugin-textdomain' ),
    'not_found_in_trash' => __( 'Nenhum Lugar encontrado no lixo.', 'your-plugin-textdomain' )
  );

  $args = array(
    'labels'             => $labels,
    'menu_icon'   => 'dashicons-admin-site',
        'description'        => __('Lugares visitados', 'lugar' ),
    'public'             => false,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'lugar' ),
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array('title', 'permalink', 'editor', 'author', 'thumbnail')
  );

  register_post_type('lugar', $args);
}

add_action( 'init', 'posttype_livros' );

function posttype_livros() {
  $labels = array(
    'name'               => _x( 'Livros', 'post type general name', 'your-plugin-textdomain' ),
    'singular_name'      => _x( 'Livro', 'post type singular name', 'your-plugin-textdomain' ),
    'menu_name'          => _x( 'Livros', 'admin menu', 'your-plugin-textdomain' ),
    'name_admin_bar'     => _x( 'Livro', 'add new on admin bar', 'your-plugin-textdomain' ),
    'add_new'            => _x( 'Adicionar Novo', 'atuacao', 'your-plugin-textdomain' ),
    'add_new_item'       => __( 'Adicionar Novo Livro', 'your-plugin-textdomain' ),
    'new_item'           => __( 'Novo Livro', 'your-plugin-textdomain' ),
    'edit_item'          => __( 'Editar Livro', 'your-plugin-textdomain' ),
    'view_item'          => __( 'Ver Livro', 'your-plugin-textdomain' ),
    'all_items'          => __( 'Todos os Livros', 'your-plugin-textdomain' ),
    'search_items'       => __( 'Procurar Livro', 'your-plugin-textdomain' ),
    'parent_item_colon'  => __( 'Livros:', 'your-plugin-textdomain' ),
    'not_found'          => __( 'Nenhum Livro encontrado.', 'your-plugin-textdomain' ),
    'not_found_in_trash' => __( 'Nenhum Livro encontrado no lixo.', 'your-plugin-textdomain' )
  );

  $args = array(
    'labels'             => $labels,
    'menu_icon'   => 'dashicons-book',
        'description'        => __('Livros da sidebar', 'livros' ),
    'public'             => false,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'livros' ),
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array('title', 'editor', 'author', 'thumbnail')
  );

  register_post_type('livros', $args);
}



add_theme_support( 'infinite-transporter', array('container' => 'autopost', 'post_order' => 'true', 'footer' => false) );

// DIY Popular Posts @ https://digwp.com/2016/03/diy-popular-posts/
function shapeSpace_popular_posts($post_id) {
  $count_key = 'popular_posts';
  $count = get_post_meta($post_id, $count_key, true);
  if ($count == '') {
    $count = 0;
    delete_post_meta($post_id, $count_key);
    add_post_meta($post_id, $count_key, '0');
  } else {
    $count++;
    update_post_meta($post_id, $count_key, $count);
  }
}
function shapeSpace_track_posts($post_id) {
  if (!is_single()) return;
  if (empty($post_id)) {
    global $post;
    $post_id = $post->ID;
  }
  shapeSpace_popular_posts($post_id);
}
add_action('wp_head', 'shapeSpace_track_posts');

function jeherve_custom_tiled_gallery_width() {
    return '683';
}
add_filter( 'tiled_gallery_content_width', 'jeherve_custom_tiled_gallery_width' );


// Add Custom Quicktags to Text Editor
function smackdown_add_quicktags() {

  if ( wp_script_is( 'quicktags' ) ) { ?>
    <script type="text/javascript">
      QTags.addButton( 'span_tag', 'span', '<span class="marcado">', '</span>', '', '', 1 );
    </script>
  <?php }

}
add_action( 'admin_print_footer_scripts', 'smackdown_add_quicktags' );

add_filter( 'the_content', 'attachment_image_link_remove_filter' );
function attachment_image_link_remove_filter( $content ) {
 $content =
 preg_replace(
 array('{<a(.*?)(wp-att|wp-content\/uploads)[^>]*><img}',
 '{ wp-image-[0-9]*" /></a>}'),
 array('<img','" />'),
 $content
 );
 return $content;
 }
 

function wpb_imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );
     
    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);


function wrap_embed_with_div($html, $url, $attr) {
     return '<div class="video-container">' . $html . '</div>';
}

add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3);




function getThumb($id = number, $size = 'retan'){

echo get_post_thumbnail_id($id);
if($size){ $sizeName = $size; }else{ $sizeName = ""; }
echo $sizeName;
$get = wp_get_attachment_image_src(get_post_thumbnail_id($id), $sizeName);
var_dump($get);
if($get[0] == ""){

  $args = array(
  'posts_per_page'=> '1',
    'post_type' => 'attachment',
    'numberposts' => null,
    'post_status' => null,
  'orderby' => 'id',
    'post_parent' => $id
);
$attachments = get_posts($args);

foreach ($attachments as $attachment){
  $img = wp_get_attachment_image_src($attachment->ID, "medium");
}

if($img[0] != ""){
  $thumbnail = $img[0];
}else{
  if($size){ $defaultThumb = $size; }else{ $defaultThumb = "thumb"; }
  $thumbnail = "". get_template_directory_uri() ."/images/". $defaultThumb .".jpg";
}

}else{
  $thumbnail = $get[0];
}

echo $thumbnail;
}




function add_categories_menu() {
  register_nav_menu('categorias',__( 'Categorias' ));
}
add_action( 'init', 'add_categories_menu' );

function add_mobile_menu() {
  register_nav_menu('mobilemenu',__( 'Menu Mobile' ));
}
add_action( 'init', 'add_mobile_menu' );

/*
function full_comment_count() {
global $post;
$url = get_permalink($post->ID);
 
$filecontent = file_get_contents("https://graph.facebook.com/?ids=" . $url);
$json = json_decode($filecontent);
$count = $json->$url->share->comment_count;
$wpCount = get_comments_number();
$realCount = $count + $wpCount;
if ($realCount == 0 || !isset($realCount)) {
    $realCount = 0;
}
return $realCount;
}
*/

function full_comment_count() {
global $post;
$url = get_permalink($post->ID);
 
$urle="https://graph.facebook.com/?ids=" . $url;
$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_URL,$urle);
$result = curl_exec($ch);
curl_close($ch);
$json = json_decode($result); 

$count = $json->$url->share->comment_count;

$wpCount = get_comments_number();
$realCount = $count + $wpCount;
if ($realCount == 0 || !isset($realCount)) {
    $realCount = 0;
}
return $realCount;
}



function get_deep_child_category( $categories )
{
    $maxId = 0;
    $maxKey = 0;
    foreach ( $categories as $key => $value )
    {
        if ( $value->parent > $maxId )
        {
            $maxId = $value->term_id;
            $maxKey = $key;
        }
    }
    return $categories[$maxKey];
}

register_sidebar( array(
'name' => 'Publicidade Sidebar',
'id' => 'anun1',
'description' => 'Adicione aqui vários images widgets com anuncios.',
'before_widget' => '<div class="box anuncio">',
'after_widget' => '</div>',
'before_title' => '<span>',
'after_title' => '</span>'
) );

register_sidebar( array(
'name' => 'Mapa',
'id' => 'wewerehere',
'description' => 'Deixe aqui apenas o widget do We Were Here.',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<span>',
'after_title' => '</span>'
) );



function my_file_get_contents( $site_url ){ $ch = curl_init();  $timeout = 10;  curl_setopt ($ch, CURLOPT_URL, $site_url);  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  $file_contents = curl_exec($ch);  curl_close($ch);  return $file_contents;}

function json_cached_api_results($url, $cache_file = NULL, $expires = NULL ) {
  global $request_type, $purge_cache, $limit_reached, $request_limit;

  if( !$cache_file ) $cache_file = dirname(__FILE__) . '/api-cache.json';
  if( !$expires) $expires = time() - 2*60*60;

if($cache_file){ $cache_file = dirname(__FILE__) . '/'. $cache_file .''; }

  if( !file_exists($cache_file) ) die("Cache file is missing: $cache_file");

  // Check that the file is older than the expire time and that it's not empty
  if ( filectime($cache_file) < $expires || file_get_contents($cache_file)  == '' || $purge_cache && intval($_SESSION['views']) <= $request_limit ) {
    // File is too old, refresh cache
    $api_results = @my_file_get_contents($url);
    $json_results = json_encode($api_results);
 
    // Remove cache file on error to avoid writing wrong xml
    if ( $api_results && $json_results )
      file_put_contents($cache_file, $json_results);
    else
      $vari = "nada";
  } else {
    // Check for the number of purge cache requests to avoid abuse
    if( intval($_SESSION['views']) >= $request_limit ) 
      $limit_reached = " <span class='error'>Request limit reached ($request_limit). Please try purging the cache later.</span>";
    // Fetch cache
    $json_results = file_get_contents($cache_file);
    $request_type = 'JSON';
  }
  return json_decode($json_results);
}
 
add_filter('show_admin_bar', '__return_false');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

if(function_exists('add_theme_support')){ 
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size(756, 447, true);
  add_image_size( 'retan', 718, 458, true);
  add_image_size( 'square', 500, 500, true);
  add_image_size( 'wish', 800, 0, true);
  add_image_size( 'livro', 300, 453, true);
}

add_filter(‘jpeg_quality’, function($arg){return 100;});

function wpse_allowedtags() {
    // Add custom tags to this string
        return '<br>,<em>,<i>,<a>,<p>,<b>,<strong>,<span>'; 
    }

if ( ! function_exists( 'wpse_custom_wp_trim_excerpt' ) ) : 

    function wpse_custom_wp_trim_excerpt($wpse_excerpt) {
    global $post;
    $raw_excerpt = $wpse_excerpt;
        if ( '' == $wpse_excerpt ) {

            $wpse_excerpt = get_the_content('');
            $wpse_excerpt = strip_shortcodes( $wpse_excerpt );
            $wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
            $wpse_excerpt = str_replace(']]>', ']]&gt;', $wpse_excerpt);
            $wpse_excerpt = strip_tags($wpse_excerpt, wpse_allowedtags()); /*IF you need to allow just certain tags. Delete if all tags are allowed */

            //Set the excerpt word count and only break after sentence is complete.
                $excerpt_word_count = 300;
                $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
                $tokens = array();
                $excerptOutput = '';
                $count = 0;

                // Divide the string into tokens; HTML tags, or words, followed by any whitespace
                preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens);

                foreach ($tokens[0] as $token) { 

                    if ($count >= $excerpt_word_count && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) { 
                    // Limit reached, continue until , ; ? . or ! occur at the end
                        $excerptOutput .= trim($token);
                        break;
                    }

                    // Add words to complete sentence
                    $count++;

                    // Append what's left of the token
                    $excerptOutput .= $token;
                }

            $wpse_excerpt = trim(force_balance_tags($excerptOutput));

                //$pos = strrpos($wpse_excerpt, '</');
                //if ($pos !== false)
                // Inside last HTML tag
                //$wpse_excerpt = substr_replace($wpse_excerpt, $excerpt_end, $pos, 0); /* Add read more next to last word */
                //else
                // After the content
                $wpse_excerpt .= $excerpt_end; /*Add read more in new paragraph */

            return $wpse_excerpt;   

        }
        return apply_filters('wpse_custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt);
    }

endif; 

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wpse_custom_wp_trim_excerpt');

function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);

      if (count($excerpt) >= $limit) {
          array_pop($excerpt);
          $excerpt = implode(" ", $excerpt) . '<span class="ret">•••</span> <a href="'. get_permalink() .'"><span class="continue">Continue Lendo</span></a>';
      } else {
          $excerpt = implode(" ", $excerpt);
      }

      $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

      return $excerpt;
}

function new_excerpt_more($more) { return '...'; }
add_filter('excerpt_more', 'new_excerpt_more');

function catIcon($category){
  return z_taxonomy_image_url($category->term_id);
}

function comentario($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
$comentario_resposta = '';
if ($comment->comment_parent > 0) {
  $comentario_resposta = ' <span class="respondeu">respondeu</span> <span class="nome">'.get_comment_author_link($comment->comment_parent).'</span>';
  }
?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>" class="comment">
<div class="comentario-autor <?php global $post; if($comment->user_id === $post->post_author) {echo"admcomment";} ?>">
 
<div class="comentario-avatar">
<div class="arrow"><div class="seta"></div></div>
  <?php echo get_avatar($comment,80); ?>
     <?php if($args['max_depth']!=$depth) { ?>
        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
      <?php } ?>
      
     
    </div>
    
    <div class="comentario-texto">
    <div class="balao">
    <div class="autor"> <span class="nome"><?php comment_author_link(); ?></span> <?php echo $comentario_resposta; ?> <span class="data"><?php comment_date('d/m/Y'); ?></span></div>
  <?php comment_text(); if ($comment->comment_approved == '0') { ?> <br /><em>Seu comentário precisa ser aprovado.</em><?php } ?></div>
  </div>
    
    <div class="clear"></div>
  </div>
<?php
}

?>