<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"  content="pt-br"> <!--<![endif]-->
<?php
/* 
// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(-1);
*/
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="robots" content="all" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="HandheldFriendly" content="true" />
    <?php $themeUrl = get_template_directory_uri(); ?>
	<title> <?php if (!is_home()){ echo get_the_title(); ?> — <?php bloginfo('name'); }else{ bloginfo('name'); ?> — <?php bloginfo('description'); } ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    
<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="manifest" href="site.webmanifest">
<link rel="mask-icon" href="safari-pinned-tab.svg" color="#4fb364">
<meta name="msapplication-TileColor" content="#000000">
<meta name="theme-color" content="#000000">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,900;1,400&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/normalize.css"/>
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/swiper/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="<?php echo $themeUrl; ?>/style.css"/>


  <script type="text/javascript" src="<?php echo $themeUrl; ?>/js/jquery-3.2.1.min.js"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php include"loading.php"; ?>








