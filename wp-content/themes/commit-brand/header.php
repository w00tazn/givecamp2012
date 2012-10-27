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
	wp_title( '|', true, 'right' ); ?> Commit!
	<?php // Add the blog description for the home/front page.
	$site_name = get_bloginfo( 'name', 'display' ); 
	if ( $site_name && ( is_home() || is_front_page() ) )
		echo "";
	?> </title>

<meta name="keywords" content="Dallas County, Education, Texas, Backbone Organization, Schools, Students, Teachers, Public Interest, Future, K-12, Higher Ed, Cradle-to-Career, Advancement" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<link rel="shortcut icon" href="" />
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() ?>/images/apple-touch-icon.png" />
<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<?php if ( is_page('community-assets') ) { ?>
     <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style2.css" type="text/css" media="screen" />
<?php } else { ?>
     <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php } ?>

<!--<link rel="stylesheet" href="/wp-content/themes/commit/js/theme/default/default.css" type="text/css" media="screen" />-->
<!--<link rel="stylesheet" type="text/css" media="screen" href="/wp-content/themes/commit/js/ui.dropdownchecklist.standalone.css" />-->

<?php wp_head(); ?>
</head>
<body <?php body_class('two-column right-sidebar'); ?>>

<div id="page">
	<header id="branding">
	
<hgroup class="fleft">
	<h1 id="site-title"><a href="http://commit2dallas.org/" title="Commit! - &quot;Because every child is our responsibility&#8230;.and our future.&quot;" rel="home"><img src="/wp-content/themes/commit-brand/images/commit-logo.png"  alt="commit!" /></a></h1>
	<!--<h2 id="site-description">Working together to realize every student's potential, cradle to career.</h2>-->
</hgroup>

<div class="social-icons fright">


<a href="http://twitter.com/Commit2Dallas" target="_blank"><img src="/wp-content/themes/commit-grey/images/twitter-icon.png" class="twitter-icon" alt="twitter" /></a>

<a href="https://www.facebook.com/pages/Commit/321638557862608" target="_blank"><img src="/wp-content/themes/commit-grey/images/facebook-icon.png" alt="facebook" /></a>

<a href="http://www.youtube.com/user/Commit2Dallas" target="_blank"><img src="/wp-content/themes/commit-grey/images/youtube-icon.png"  alt="YouTube" /></a>
</div>
<div class="clear"></div>
</header>


<div class="nav">
	<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'menu' ) ); ?>
	<div class="left-corner"></div>
	<div class="right-corner"></div>
</div>

<div id="main">