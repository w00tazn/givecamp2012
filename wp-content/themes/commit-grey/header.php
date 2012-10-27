<?php
/**
 * The header template
*/
?>
<?php global $options;
foreach ($options as $value) {
	if (isset($value['id']) && get_option( $value['id'] ) === FALSE && isset($value['std'])) {
		$$value['id'] = $value['std'];
	}
	elseif (isset($value['id'])) { $$value['id'] = get_option( $value['id'] ); }
}?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php global $page, $paged;
	wp_title( '', true, 'right' );
	// Add the blog description for the home/front page.
	$site_name = get_bloginfo( 'name', 'display' );
	if ( $site_name && ( is_home() || is_front_page() ) )
		echo " $site_name";
	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'wplook' ), max( $paged, $page ) );
	?></title>
<?php wplook_meta_description();?>

<meta name="keywords" content="<?php echo $wpl_meta_keywords; ?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() ?>/images/apple-touch-icon.png" />
<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php echo stripslashes($wpl_ga_code); ?>

<link rel="stylesheet" type="text/css" media="screen" href="/wp-content/themes/commit-grey/scripts/ui.dropdownchecklist.standalone.css" />


<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/commit/ie.css" />
<![endif]-->

<?php wp_head(); ?>
</head>
<body <?php body_class('two-column right-sidebar'); ?>>

<div id="page">
	<header id="branding">
	<div class="tagline"></div>
<hgroup class="fleft">
	<h1 id="site-title"><a href="http://commit2dallas.org/" title="Commit! - &quot;Because every child is our responsibility&#8230;.and our future.&quot;" rel="home"><img src="/wp-content/themes/commit-grey/images/commit-logo.png"  alt="commit!" /></a></h1>
	<!--<h2 id="site-description">Working together to realize every student's potential, cradle to career.</h2>-->
</hgroup>

<div class="clear"></div>
<div class="social-icons fright">

<?php if ($wpl_twitter != '') { ?>
<a href="<?php echo $wpl_twitter; ?>" target="_blank"><img src="/wp-content/themes/commit-grey/images/twitter-icon.png" class="twitter-icon" alt="<?php echo $wpl_twitter; ?>" /></a>
<?php } ?>
<?php if ($wpl_facebook != '') { ?><a href="<?php echo $wpl_facebook; ?>" target="_blank"><img src="/wp-content/themes/commit-grey/images/facebook-icon.png" alt="<?php echo $wpl_facebook; ?>" /></a>
<?php } ?>
<?php if ($wpl_linkedin != '') { ?>
<a href="<?php echo $wpl_linkedin; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/linkedin.png" width="22" height="22" alt="<?php echo $wpl_linkedin; ?>" /></a>
<?php } ?>
<?php if ($wpl_tumblr != '') {	?>
<a href="<?php echo $wpl_tumblr; ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/images/icons/tumblr.png" width="22" height="22" alt="<?php echo $wpl_tumblr; ?>" /></a>
<?php } ?>
<?php if ($wpl_delicious != '') {	?>
<a href="<?php echo $wpl_delicious; ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/images/icons/delicious.png" width="22" height="22" alt="<?php echo $wpl_delicious; ?>" /></a>
<?php } ?>
<?php if ($wpl_digg != '') {	?>
<a href="<?php echo $wpl_digg; ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/images/icons/digg.png" width="22" height="22" alt="<?php echo $wpl_digg; ?>" /></a>
<?php } ?>	
<?php if ($wpl_stumbleupon != '') {	?>
<a href="<?php echo $wpl_stumbleupon; ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/images/icons/stumbleupon.png" width="22" height="22" alt="<?php echo $wpl_stumbleupon; ?>" /></a>
<?php } ?>
<?php if ($wpl_flickr != '') {	?>
<a href="<?php echo $wpl_flickr; ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/images/icons/flickr.png" width="22" height="22" alt="<?php echo $wpl_flickr; ?>" /></a>
<?php } ?>
<?php if ($wpl_picasa != '') {	?>
<a href="<?php echo $wpl_picasa; ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/images/icons/picasa.png" width="22" height="22" alt="<?php echo $wpl_picasa; ?>" /></a>
<?php } ?>	
<?php if ($wpl_youtube != '') {	?>
<a href="<?php echo $wpl_youtube; ?>" target="_blank"><img src="/wp-content/themes/commit-grey/images/youtube-icon.png"  alt="<?php echo $wpl_youtube; ?>" /></a>
<?php } ?>
<?php if ($wpl_dribbble != '') {	?>
<a href="<?php echo $wpl_dribbble; ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/images/icons/dribbble.png" width="22" height="22" alt="<?php echo $wpl_dribbble; ?>" /></a>
<?php } ?>
<?php if ($wpl_rss != '') { ?>
<a href="<?php echo $wpl_rss; ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/images/icons/rss.png" width="22" height="22" alt="<?php echo $wpl_rss; ?>" /></a>
<?php } ?>
</div><div class="clear"></div>
</header>

<?php  if ($wpl_menu == '' || $wpl_menu == 'Display') { ?> 
<div class="nav">
	<?php wp_nav_menu( array('theme_location' => 'header-menu', 'menu' => 'Commit Nav' )); ?>
	<?php /* wp_nav_menu( array('depth' => '3', 'theme_location' => 'primary' )); */?> 
	<div class="left-corner"></div>
	<div class="right-corner"></div>
</div>
<?php } ?>
<div id="main">