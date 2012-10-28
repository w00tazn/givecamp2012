<?php /** The header template **/
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
		<meta name="keywords" content="Dallas County, Education, Texas, Backbone Organization, Schools, Students, Teachers, Public Interest, Future, K-12, Higher Ed, Cradle-to-Career, Advancement" />
		<meta name="description" content="<?php bloginfo('description'); ?>" />


		<title><?php global $page, $paged;

			wp_title( '|', true, 'right' ); ?> Commit!

			<?php // Add the blog description for the home/front page.

			$site_name = get_bloginfo( 'name', 'display' ); 

			if ( $site_name && ( is_home() || is_front_page() ) )

				echo "";

			?> 
		</title>

		<link rel="shortcut icon" href="" />
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() ?>/images/apple-touch-icon.png" />

		<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>

		<?php if ( is_page('community-assets') ) { ?>

     		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style2.css" type="text/css" media="screen" />

		<?php } else { ?>

     		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

		<?php } ?>

		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/js/jquery-ui-1.9.1.custom.min.css" />
		<script src='<?php echo get_template_directory_uri() ?>/js/jquery-1.8.2.min.js' type='text/javascript'></script>
		<script src='<?php echo get_template_directory_uri() ?>/js/jquery-ui-1.9.1.custom.min.js' type='text/javascript'></script>




		<?php wp_head(); ?>

	</head>

	<body <?php body_class('two-column right-sidebar'); ?>>

		<div id="page">

			<header id="branding">

				<hgroup class="fleft">
					<h1 id="site-title">
						<a href="http://commit2dallas.org/" title="Commit! - &quot;Because every child is our responsibility&#8230;.and our future.&quot;" rel="home">
							<img width="400" src="<?php echo get_bloginfo('template_directory');?>/images/commit-logo-white-4inches.png"  alt="commit!" />
						</a>
					</h1>
				</hgroup>

				<div class="social-icons fright">
					<a href="http://twitter.com/Commit2Dallas" target="_blank"><img src="<?php echo get_bloginfo('template_directory');?>/images/twitter-icon.png" class="twitter-icon" alt="twitter" /></a>
					<a href="https://www.facebook.com/pages/Commit/321638557862608" target="_blank"><img src="<?php echo get_bloginfo('template_directory');?>/images/facebook-icon.png" alt="facebook" /></a>
					<a href="http://www.youtube.com/user/Commit2Dallas" target="_blank"><img src="<?php echo get_bloginfo('template_directory');?>/images/youtube-icon.png"  alt="YouTube" /></a>
				</div>

				<div class="clear"></div>

			</header>

			<div class="nav">

				<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'menu' ) ); ?>

<!-- 				<div class="left-corner"></div>

				<div class="right-corner"></div>
 -->
			</div>

			<div id="main">