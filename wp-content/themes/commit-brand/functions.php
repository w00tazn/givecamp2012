<?php function my_init() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js', false, '1.6.1', true);
		wp_enqueue_script('jquery');

		
		wp_enqueue_script('ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js', array('jquery'), '1.8.13', true);
		wp_enqueue_script('ddcl', get_bloginfo('template_url') . '/js/ui.dropdownchecklist-1.4.js', array('jquery'), '1.4', true);
		wp_enqueue_script('slider', get_bloginfo('template_url') . '/js/jquery.anythingslider.min.js', array('jquery'), '1.4', true);
		wp_enqueue_script('fancybox', get_bloginfo('template_url') . '/js/jquery.fancybox.pack.js', array('jquery'), '1.4', true);
	}
}
add_action('init', 'my_init');


function register_my_menus() {
  register_nav_menus(
    array( 'header-menu' => __( 'Header Menu' ) )
  );
}
add_action( 'init', 'register_my_menus' );


?>